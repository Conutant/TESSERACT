<?php
/**
 * This file is full of utility functions that don't fit elsewhere.
 */

function tesseract_get_packages() {
	$content = file_get_contents( TESSERACT_PACKAGES_FILE );

	if ( empty( $content ) ) {
		return array();
	}

	$data = json_decode( $content, true );

	if ( NULL === $data ) {
		return array();
	}

	$packages = $data['data']['packages'];

	return $packages;
}


function tesseract_get_previously_imported_packages() {
	return get_option( Tesseract_Importer_Options::IMPORTED_PACKAGES, array() );
}