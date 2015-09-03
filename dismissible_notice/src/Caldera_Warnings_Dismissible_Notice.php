<?php
/**
 * Creates a dismissible--via AJAX--admin nag
 *
 * @package   @Caldera_Warnings_Dismissible_Notice
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @copyright 2015 Josh Pollock
 */
/**
 * Version 0.1.0
 */

if ( class_exists( 'Caldera_Warnings_Dismissible_Notice' ) ) {
	return;

}

/**
 * Class Caldera_Warnings_Dismissible_Notice
 *
 * @package   @Caldera_Warnings_Dismissible_Notice
 */
class Caldera_Warnings_Dismissible_Notice {

	/**
	 * The action for the nonce
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected static $nonce_action = 'caldera_admin_nag';

	/**
	 * The counce field
	 *
	 * @since 0.3.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected static $nonce_field  = '';

	/**
	 * The ignore key
	 *
	 * @since 0.3.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected static $ignore_key   = '';

	/**
	 * Output the message
	 *
	 * @since 0.1.0
	 *
	 * @param string $message The text of the message.
	 * @param bool $error Optional. Whether to show as error or update. Default is error.
	 * @param string $cap_check Optional. Minimum user capability to show nag to. Default is "activate_plugins"
	 * @param string|bool $ignore_key Optional. The user meta key to use for storing if this message has been dismissed by current user or not. If false, it will be generated.
	 *
	 * @return string|void Admin notice if is_admin() and not dismissed.
	 */
	public static function notice( $message,  $error = true, $cap_check = 'activate_plugins', $ignore_key = false ) 
  {
		if ( !current_user_can( $cap_check ) ) return;
		$user_id = get_current_user_id();
		if ( ! is_string( $ignore_key ) ) {
			// cal_wd_ig_3911b2583433f696e5813a503bbb2e65
			$ignore_key = 'cal_wd_ig_' . substr( md5( $ignore_key ), 0, 40 );
		}

		self::$ignore_key = sanitize_key( $ignore_key );

		$dissmised = time() - get_user_meta( $user_id, self::$ignore_key, time() ) < (60*60*24*30); // Nag every 30 days

		if ( $dissmised ) return;
    
		if ( $error ) {
			$class = 'error';
		} else {
			$class = 'update-nag';
		}

		self::$nonce_field = wp_nonce_field( self::$nonce_action );

		$out[] = sprintf( '<div id="%1s" data-key="%2s" class="%3s notice is-dismissible">', self::$ignore_key, self::$ignore_key, $class );
		$out[] = $message;
		$out[] = self::$nonce_field;
		$out[] = '</div>';

		return implode( '', $out );
	}

	/**
	 * Enqueue JavaScript and CSS for dismiss button.
	 *
	 * @since 0.1.0
	 *
	 * @uses "admin_enqueue_scripts"
	 * @global string $wp_version The current WordPress version.
	 */
	public static function js_css() {
		global $wp_version;
		$is_less_42 = version_compare( $wp_version, '4.2', '>' );
		if ( ! $is_less_42 ) {
			wp_enqueue_style( 'caldera-wdn-style', get_stylesheet_directory_uri() . '/dismissible_notice/src/css/style.css' );
		}
		wp_enqueue_script( 'caldera-wdn-common', get_stylesheet_directory_uri() . '/dismissible_notice/src/js/common.js' );
		wp_localize_script( 'caldera-wdn-common', 'caldera_commonL10n', array(
			'nonce'      => wp_create_nonce( self::$nonce_action ),
			'wp_version' => $is_less_42,
			'dismiss'    => __( 'Dismiss this notice.', apply_filters( 'caldera_wdn_text_domain', 'caldera-wdn-common' ) ),
		) );
	}

	/**
	 * AJAX callback to mark the message dismissed.
	 *
	 * @since 0.1.0
	 *
	 * @uses "wp_ajax_caldera_warnings_dismissible_notice"
	 *
	 * @return bool
	 */
	public static function ajax_cb() {
		if (  ! isset( $_POST[ 'nonce' ] ) || ! wp_verify_nonce( $_POST[ 'nonce' ], self::$nonce_action ) ) {
			return false;
		}

		$nag = sanitize_key( $_POST[ 'nag' ] );
		if ( $nag === $_POST[ 'nag' ] ) {
			update_user_meta( get_current_user_id(), $nag, time() );
		}
	}
}
