<?php

add_action( 'after_switch_theme', 'tesseract_import_packages' );

function tesseract_import_packages() {
	$packages = tesseract_get_packages();

	if ( empty( $packages ) ) {
		return;
	}

	$current_package_slugs_to_versions = array();

	foreach ( $packages as $package ) {
		$slug = $package['details']['slug'];
		$version = $package['details']['version'];

		$current_package_slugs_to_versions[$slug] = $version;
	}

	$existing_packages = get_option( Tesseract_Importer_Options::IMPORTED_PACKAGES, array() );

	// Get packages that need to be totally deleted
	$packages_for_deletion = array();
	foreach ( $existing_packages as $slug => $existing_package ) {
		if ( empty( $current_package_slugs_to_versions[$slug] ) ) {
			$packages_for_deletion[] = $slug;
		}
	}

	// Get packages that need to be added/updated
	$packages_for_importing = array();
	foreach ( $current_package_slugs_to_versions as $slug => $version ) {
		// Check to see if this package slug & version have been imported.
		if ( empty( $existing_packages[$slug] ) || $existing_packages[$slug] != $version ) {
			// If not, do the import
			$packages_for_importing[] = $slug;
		}
	}
}