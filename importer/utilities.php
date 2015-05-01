<?php
/**
 * This file is full of utility functions that don't fit elsewhere.
 */

function tesseract_get_packages() {
	if ( false === ( $packages = get_transient( 'tesseract_package_list' ) ) ) {
		$response = wp_remote_get( TESSERACT_PACKAGE_LIST_URL );
		$loaded_local_file = false;

		if ( is_wp_error( $response ) ) {
			$content = false;
		} else {
			$content = $response['body'];
		}

		if ( false === $content ) {
			$content = file_get_contents( dirname( __FILE__ ) . '/data/packages.json' );
			$loaded_local_file = true;
		}

		if ( empty( $content ) ) {
			tesseract_add_error_message( 'There was an error fetching the packages.' );
			return array();
		}

		$data = json_decode( $content, true );

		// One last chance at grabbing the local data
		if ( NULL === $data && ! $loaded_local_file ) {
			$content = file_get_contents( dirname( __FILE__ ) . '/data/packages.json' );
			$loaded_local_file = true;

			if ( ! empty( $content ) ) {
				$data = json_decode( $content, true );
			}
		}

		if ( NULL === $data ) {
			tesseract_add_error_message( 'There was an error loading the packages. Try refreshing the packages using the button at the top of this page.' );
			return array();
		}

		$packages = $data['data']['packages'];

		set_transient( 'tesseract_package_list', $packages, 60 * 15 ); // Expires in 15 mins
	}

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