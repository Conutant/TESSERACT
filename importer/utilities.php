<?php
/**
 * This file is full of utility functions that don't fit elsewhere.
 */

function tesseract_get_packages( $filename = null ) {
	if ( $filename ) {
		$content = file_get_contents( $filename );
	} else {
		$content = file_get_contents( TESSERACT_PACKAGES_FILE );
	}

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
	return get_option( Tesseract_Importer_Constants::$IMPORTED_PACKAGES_OPTION_NAME, array() );
}

/* this fixes the issue where content blocks were not being updated because of the missing taxonomy */
if ( ! taxonomy_exists( 'fl-builder-template-type' ) ) {
	register_taxonomy( 'fl-builder-template-type', array( 'fl-builder-template' ), array(
		'label'             => _x( 'Type', 'Custom taxonomy label.', 'fl-builder' ),
		'hierarchical'      => false,
		'public'            => false,
		'show_admin_column' => true
	));
}