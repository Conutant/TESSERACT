<?php
/**
 * This file is full of utility functions that don't fit elsewhere.
 */

function tesseract_get_packages() {
	$content = file_get_contents( TESSERACT_PACKAGES_FILE );

	if ( empty( $content ) ) {
		tesseract_add_error_message( 'There was an error loading the packages.' );
		return array();
	}

	$data = json_decode( $content, true );

	if ( NULL === $data ) {
		tesseract_add_error_message( 'There was an error loading the packages.' );
		return array();
	}

	$packages = $data['data']['packages'];

	return $packages;
}

function tesseract_add_error_message( $message ) {
	global $tesseract_messages;

	if ( empty( $tesseract_messages ) ) {
		$tesseract_messages = array();
	}

	if ( empty( $tesseract_messages['error'] ) ) {
		$tesseract_messages['error'] = array();
	}

	$tesseract_messages['error'][] = $message;
}

function tesseract_add_success_message( $message ) {
	global $tesseract_messages;

	if ( empty( $tesseract_messages ) ) {
		$tesseract_messages = array();
	}

	if ( empty( $tesseract_messages['error'] ) ) {
		$tesseract_messages['success'] = array();
	}

	$tesseract_messages['success'][] = $message;
}

function tesseract_has_error_messages() {
	$messages = tesseract_get_messages( 'error' );
	return ! empty( $messages );
}

function tesseract_has_success_messages() {
	$messages = tesseract_get_messages( 'success' );
	return ! empty( $messages );
}

function tesseract_get_messages( $key ) {
	global $tesseract_messages;

	if ( empty( $tesseract_messages ) || empty( $tesseract_messages[$key] ) ) {
		return array();
	} else {
		return $tesseract_messages[$key];
	}
}