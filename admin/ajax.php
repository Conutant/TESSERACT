<?php
/**
 * Hides the after-update notification until the next update for a specific user.
 */
 
function tesseract_apinotification_callback() {
	if ( ! current_user_can( 'manage_options' ) ) {
		die( '-1' );
	}

	check_ajax_referer( 'tesseract-apinotification-ajax','nonceval' );

	require_once get_template_directory() . '/admin/class-tesseract-notification-center.php';
	
	set_transient( Tesseract_Notification_Center::TRANSIENT_KEY_STATUS, 'dismiss', ( HOUR_IN_SECONDS * 24 ) );

	die( '1' );
}

add_action( 'wp_ajax_tesseract_apinotification', 'tesseract_apinotification_callback' );
