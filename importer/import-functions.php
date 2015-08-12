<?php

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

	$public_post_types = get_post_types( array( 'public' => true ) );

	$results['post_ids'] = tesseract_import_package_posts( $package_array['posts'] );
	$results['options'] = tesseract_import_package_options( $package_array['options'] );
	// No return value from plugin data importing
	tesseract_import_package_plugin_data( $package_array['plugin_data'] );

	// Clear out the option for 'required plugins', because the package has completed importing.
	// All plugins should have been installed/activated by now.
	delete_option( 'tesseract_required_plugins' );
	delete_option( 'tesseract_plugin_install_return_url' );

	// This foces the fonts plugin to display imported values. Kinda hacky. Works.
	delete_transient( 'tt_font_theme_options' );

	$imported_packages = get_option( Tesseract_Importer_Options::IMPORTED_PACKAGES, array() );

	// The list of imported packages is stored as an array with the slug as key
	$imported_packages[$package_slug] = array(
		'slug' => $package_slug,
		'version' => $package_version
	);

	update_option( Tesseract_Importer_Options::IMPORTED_PACKAGES, $imported_packages );

	return $results;
}

function tesseract_import_package_posts( $posts ) {
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
					update_post_meta( $post_id, '_imported_content_block', 1 );
				}

				// Only show results for public post types
				if ( in_array( $post['post_type'], $public_post_types ) ) {
					$post_ids[] = $post_id;
				}
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