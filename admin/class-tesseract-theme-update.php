<?php
/**
 * Handles notifications storage and display.
 */

require_once get_template_directory() . '/admin/class-tesseract-notification.php';


final class Tesseract_Theme_Update{
	
	const TRANSIENT_KEY_VERSION_CHECK = 'tesseract_version_check';
	const TRANSIENT_THEME_NOTICE = 'tesseract_theme_notice';
	const TRANSIENT_THEME_NOTICE_STATUS = 'tesseract_theme_notice_STATUS';
	const VERSION_OPTION_KEY = 'tesseract_automator_version';
	
	/**
	 * Checks to see if update logic needs to run.
	 *
	 * @since 1.0
	 * @return void
	 */
	static public function init(){
	
		// Get the saved version number.
		$saved_version = get_option( self::VERSION_OPTION_KEY, '0' );
		
		// Don't update for dev versions.
		if ( '{TESSERACT_THEME_VERSION}' == TESSERACT_THEME_VERSION ) {
			return;
		}
		
		// Don't update if the saved version matches the current version.
		if ( version_compare( $saved_version, TESSERACT_THEME_VERSION, '=' ) ) {
			return;
		}
		
		// Update the saved version number.
		update_option( self::VERSION_OPTION_KEY, TESSERACT_THEME_VERSION );
		
	}
	
	static public function upgrade_info($transient){
		
		$response = Tesseract_Update_Api::doaction(array('action'=>'theme','subaction'=>'version'));
		
		if($response == false)	return $transient;

		set_transient( self::TRANSIENT_KEY_VERSION_CHECK, $response['new_version'], ( HOUR_IN_SECONDS * 10 ) );

		//check server version against current installed version
		if( version_compare( $transient->checked[TESSERACT_THEME_NAME], $response['new_version'], '<' ) ){
		
 			$transient->response[TESSERACT_THEME_NAME] = (array) json_decode(json_encode($response['upgradeinfo']));
				
		}
		
	   return $transient;
		
	}
	

}
