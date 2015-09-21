<?php

add_action( 'after_switch_theme', 'tesseract_do_import_packages' );

function tesseract_do_import_packages() {
	$doing_import = get_option( 'tesseract_doing_import', false );

	if ( ! $doing_import ) {
		try {
			update_option( 'tesseract_doing_import', true );
			$packages = tesseract_get_packages();
			tesseract_import_packages( $packages );
			delete_option( 'tesseract_doing_import' );
		} catch ( Exception $e ) {
			delete_option( 'tesseract_doing_import' );
			throw $e;
		}
	}
}

function tesseract_import_packages( $packages ) {
	if ( empty( $packages ) ) {
		return;
	}

	$current_package_slugs_to_versions = array();

	foreach ( $packages as $package ) {
		$slug = $package['details']['slug'];
		$version = $package['details']['version'];

		$current_package_slugs_to_versions[$slug] = $version;
	}

	$existing_packages = tesseract_get_previously_imported_packages();

	// Get packages that need to be totally deleted
	$packages_for_deletion = array();
	foreach ( $existing_packages as $slug => $existing_package ) {
		if ( empty( $current_package_slugs_to_versions[$slug] ) ) {
			$packages_for_deletion[] = $slug;
		}
	}

	// Get packages that need to be added/updated
	$packages_for_importing = array();
	$packages_for_updating = array();
	foreach ( $current_package_slugs_to_versions as $slug => $version ) {
		// Check to see if this package slug & version have been imported.
		if ( empty( $existing_packages[$slug] ) ) {
			// If not, do the import
			$packages_for_importing[] = $slug;
		} elseif ( $existing_packages[$slug] != $version ) {
			$packages_for_updating[] = $slug;
		}
	}

	foreach ( $packages as $package ) {
		$slug = $package['details']['slug'];
		if ( in_array( $slug, $packages_for_importing ) ) {
			tesseract_import_package( $package );
		} elseif ( in_array( $slug, $packages_for_updating ) ) {
			tesseract_delete_package_with_slug( $slug );
			tesseract_import_package( $package );
		}
	}

	foreach ( $existing_packages as $slug => $existing_package ) {
		if ( in_array( $slug, $packages_for_deletion ) ) {
			tesseract_delete_package_with_slug( $slug );
		}
	}
}

function tesseract_delete_package_with_slug( $slug ) {
	$imported_posts = tesseract_get_tracked_posts_from_package_slug( $slug );

	foreach ( $imported_posts as $post ) {
		wp_delete_post( $post->ID );
	}

	$imported_packages = get_option( Tesseract_Importer_Constants::$IMPORTED_PACKAGES_OPTION_NAME, array() );

	unset( $imported_packages[$slug] );

	update_option( Tesseract_Importer_Constants::$IMPORTED_PACKAGES_OPTION_NAME, $imported_packages );
}

/**
 * On success, returns an array with details about the import results.
 * On failure, returns a WP_Error
 */
function tesseract_import_package( $package_array ) {
	$package_slug = $package_array['details']['slug'];
	$package_version = $package_array['details']['version'];

	if ( empty( $package_slug) || empty( $package_version ) ) {
		return;
	}

	$results = array(
		'post_ids' => array(),
		'options' => array(),
		'name' => $package_array['name']
	);


	if ( ! empty( $package_array['posts'] ) ) {
		$results['post_ids'] = tesseract_import_package_posts( $package_array['posts'], $package_slug );
	}

	if ( ! empty( $package_array['options'] ) ) {
		$results['options'] = tesseract_import_package_options( $package_array['options'] );
	}

	if ( ! empty( $package_array['plugin_data'] ) ) {
		// No return value from plugin data importing
		tesseract_import_package_plugin_data( $package_array['plugin_data'] );
	}

	// Clear out the option for 'required plugins', because the package has completed importing.
	// All plugins should have been installed/activated by now.
	delete_option( 'tesseract_required_plugins' );
	delete_option( 'tesseract_plugin_install_return_url' );

	// This foces the fonts plugin to display imported values. Kinda hacky. Works.
	delete_transient( 'tt_font_theme_options' );

	$imported_packages = get_option( Tesseract_Importer_Constants::$IMPORTED_PACKAGES_OPTION_NAME, array() );

	// The list of imported packages is stored as an array with the slug as key
	$imported_packages[$package_slug] = array(
		'slug' => $package_slug,
		'version' => $package_version
	);

	update_option( Tesseract_Importer_Constants::$IMPORTED_PACKAGES_OPTION_NAME, $imported_packages );

	return $results;
}

function tesseract_import_package_posts( $posts, $package_slug ) {
	$post_ids = array();

	if ( ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			if ( tesseract_is_builder_template( $post ) && tesseract_does_builder_template_exist( $post ) ) {
				continue; // If this builder template has already been imported
			}

			$post_id = wp_insert_post( $post, true );
			if ( is_wp_error( $post_id ) ) {
				return $post_id;
			} else {
				if ( ! empty( $post['meta'] ) ) {
					foreach ( $post['meta'] as $meta_key => $meta_value ) {
						update_post_meta( $post_id, $meta_key, maybe_unserialize( $meta_value[0] ) );
					}
				}

				// Mark all content blocks as being imported by the theme
				if ( tesseract_is_builder_template( $post ) ) {
					update_post_meta( $post_id, Tesseract_Importer_Constants::$CONTENT_BLOCK_META_KEY, 1 );
				}

				if ( in_array( $post['post_type'], Tesseract_Importer_Constants::$TRACKED_POST_TYPES ) ) {
					update_post_meta( $post_id, Tesseract_Importer_Constants::$IMPORTED_BY_PACKAGE_META_KEY, $package_slug );
				}

				$post_ids[] = $post_id;
			}
		}
	}

	return $post_ids;
}

function tesseract_import_package_options( $option_arrays ) {
	$option_results = array();

	if ( ! empty( $option_arrays ) ) {
		foreach ( $option_arrays as $option_array ) {
			if ( NULL != $option_array['option_name'] && NULL != $option_array['option_value'] ) {
				update_option( $option_array['option_name'], maybe_unserialize( $option_array['option_value'] ) );
				$option_results[] = $option_array;
			}
		}
	}

	return $option_results;
}

function tesseract_import_package_plugin_data( $plugin_data ) {
	if ( ! empty( $plugin_data ) ) {
		// We don't need to import into any of these (WP default) tables
		$blacklisted_tables = array(
			'users', 'usermeta', 'terms', 'term_relationships', 'comments',
			'commentmeta', 'links', 'term_taxonomy', 'options', 'posts', 'postmeta'
		);

		global $wpdb;

		// Iterate through all of the custom data and insert/overwrite existing data
		foreach ( $plugin_data as $unprefixed_table_name => $rows ) {
			if ( in_array( $unprefixed_table_name, $blacklisted_tables ) ) {
				continue;
			}

			$table_name = $wpdb->prefix . $unprefixed_table_name;

			foreach ( $rows as $row ) {
				// Warning: 'replace' will overwrite existing data, which is required for plugins
				// that reference the unique ID of a row (e.g. in shortcodes)
				$wpdb->replace( $table_name, $row );
			}
		}
	}
}

function tesseract_is_builder_template( $post ) {
	return $post['post_type'] == 'fl-builder-template';
}

function tesseract_does_builder_template_exist( $post ) {
	global $wpdb;

	$ids_matching_content = $wpdb->get_col( $wpdb->prepare(
		"SELECT `ID` FROM $wpdb->posts WHERE `post_content` = %s", $post['post_content']
	) );

	if ( empty( $ids_matching_content ) ) {
		return false;
	}

	$search_results = get_posts( array(
		'post_type' => 'fl-builder-template',
		'name' => $post['post_name'],
		'post__in' => $ids_matching_content
	) );

	return ! empty( $search_results );
}

function tesseract_get_tracked_posts_from_package_slug( $slug ) {
	$posts = get_posts( array(
			'meta_key' => Tesseract_Importer_Constants::$IMPORTED_BY_PACKAGE_META_KEY,
			'meta_value' => $slug,
			'post_type' => Tesseract_Importer_Constants::$TRACKED_POST_TYPES
		)
	);

	return $posts;
}