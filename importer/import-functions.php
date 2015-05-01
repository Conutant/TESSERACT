<?php

/**
 * On success, returns an array with details about the import results.
 * On failure, returns a WP_Error
 */
function tesseract_import_package( $package_array ) {
	$results = array(
		'post_ids' => array(),
		'options' => array(),
		'name' => $package_array['name']
	);

	$public_post_types = get_post_types( array( 'public' => true ) );

	if ( ! empty( $package_array['posts'] ) ) {
		foreach ( $package_array['posts'] as $post ) {
			$post_id = wp_insert_post( $post, true );
			if ( is_wp_error( $post_id ) ) {
				return $post_id;
			} else {
				if ( ! empty( $post['meta'] ) ) {
					foreach ( $post['meta'] as $meta_key => $meta_value ) {
						update_post_meta( $post_id, $meta_key, maybe_unserialize( $meta_value[0] ) );
					}
				}

				// Only show results for public post types
				if ( in_array( $post['post_type'], $public_post_types ) ) {
					$results['post_ids'][] = $post_id;
				}
			}
		}
	}

	if ( ! empty( $package_array['options'] ) ) {
		foreach ( $package_array['options'] as $option_array ) {
			if ( NULL != $option_array['option_name'] && NULL != $option_array['option_value'] ) {
				update_option( $option_array['option_name'], maybe_unserialize( $option_array['option_value'] ) );
				$results['options'][] = $option_array;
			}
		}
	}

	if ( ! empty( $package_array['plugin_data'] ) ) {
		// We don't need to import into any of these (WP default) tables
		$blacklisted_tables = array(
			'users', 'usermeta', 'terms', 'term_relationships', 'comments',
			'commentmeta', 'links', 'term_taxonomy', 'options', 'posts', 'postmeta'
		);

		global $wpdb;

		// Iterate through all of the custom data and insert/overwrite existing data
		foreach ( $package_array['plugin_data'] as $unprefixed_table_name => $rows ) {
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

	// Clear out the option for 'required plugins', because the package has completed importing.
	// All plugins should have been installed/activated by now.
	delete_option( 'tesseract_required_plugins' );
	delete_option( 'tesseract_plugin_install_return_url' );

	delete_transient( 'tt_font_theme_options' );

	update_option( 'tesseract_imported_package_' . intval( $package_array['id'] ), 1 );

	return $results;
}