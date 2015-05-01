<?php

function tesseract_add_admin_menu() {
	add_menu_page( 'Tesseract', 'Tesseract', 'manage_options', 'tesseract-importer', 'tesseract_display_admin_page' );
}

add_action( 'admin_menu', 'tesseract_add_admin_menu' );

function tesseract_display_admin_page() {
	if ( tesseract_is_import_package_page() ) {
		load_template( dirname( __FILE__ ) . '/templates/importer-display-import.php' );
	} elseif ( tesseract_is_plugin_install_page() ) {
		update_option( 'tesseract_plugin_install_return_url', tesseract_get_plugin_install_url( $_GET['package'] ) );
		load_template( dirname( __FILE__ ) . '/templates/importer-plugin-install.php' );
	} else {
		load_template( dirname( __FILE__ ) . '/templates/importer-home.php' );
	}
}

function tesseract_handle_package_import() {
	if ( tesseract_is_valid_package_import() ) {
		$packages = tesseract_get_packages();
		$package_id = intval( $_POST['package'] );

		if ( empty( $packages[$package_id] ) ) {
			tesseract_add_error_message( "Error: Invalid package. Try another?" );
			return;
		}

		if ( tesseract_needs_plugins_installed() ) {
			wp_redirect( tesseract_get_plugin_install_url( $package_id ) );
			exit;
		}

		$result = tesseract_import_package( $packages[$package_id] );

		if ( is_wp_error( $result ) ) {
			tesseract_add_error_message( "Error: Package import was incomplete: " . $result->get_error_message() );
		} else {
			// After a package is imported, we redirect the user to the results page to prevent re-importing on page refresh.
			// We have to store the import result temporarily, until the next request.
			// See tesseract_load_import_result() for what happens after import.
			update_option( 'tesseract_import_result', $result );
			wp_redirect( tesseract_get_import_package_url() );
			exit;
		}
	}
}

/**
 * If a package has been successfully imported, we need to display the results of the import.
 */
function tesseract_load_import_result() {
	// Are we on the import package page?
	if ( tesseract_is_import_package_page() ) {
		$result = get_option( 'tesseract_import_result' );
		// If so, and we have the results of an import, we set that up for display here.
		if ( ! empty( $result ) ) {
			global $tesseract_import_result;
			$tesseract_import_result = $result;
			tesseract_add_success_message( "Success! Imported '{$result['name']}' Package." );
			delete_option( 'tesseract_import_result' );
		} elseif ( tesseract_is_valid_package_import() ) {
			// If this is an import (with POST data), do the import!
			tesseract_handle_package_import();
		} else {
			// Otherwise, if this isn't a package import and we don't have a result, we shouldn't be here...redirect!
			wp_redirect( tesseract_get_import_home_url() );
			exit;
		}

	}
}

// Attach to current screen to make sure everything we need is loaded
add_action( 'current_screen', 'tesseract_load_import_result' );

function tesseract_refresh_packages() {
	if ( tesseract_is_an_import_admin_page() && ! empty( $_GET['refresh-packages'] ) ) {
		delete_transient( 'tesseract_package_list' );
		$url = add_query_arg( 'refresh-successful', 1, tesseract_get_import_home_url() );
		wp_redirect( $url );
		exit;
	}
}

add_action( 'init', 'tesseract_refresh_packages' );

function tesseract_load_messages() {
	if ( tesseract_is_an_import_admin_page() && ! empty( $_GET['refresh-successful'] ) ) {
		tesseract_add_success_message( "Successfully refreshed the package lists." );
	}
}

add_action( 'init', 'tesseract_load_messages' );