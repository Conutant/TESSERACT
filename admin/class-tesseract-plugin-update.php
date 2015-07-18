<?php
/**
 * Handles notifications storage and display.
 */

require_once get_template_directory() . '/admin/class-tesseract-notification.php';


final class Tesseract_Plugin_Update{
	
	static public function upgrade_info($transient,$pluginslug,$cur_version){
		
		$transient_version = get_transient('tesseract_version_check_'.$pluginslug);
		
		if(false !== $transient_version){
		
			if ( version_compare( $transient_version, $cur_version, '=' ) ) {
			
				return $transient;
			
			}	
			
		}	
		
		$response = Tesseract_Update_Api::doaction(array('action'=>'plugin','subaction'=>'version'));
		
		if($response == false)	return $transient;

		set_transient('tesseract_version_check_'.$pluginslug, $response['new_version'], ( HOUR_IN_SECONDS * 10 ) );

		//check server version against current installed version
		if( version_compare( $transient->checked[$pluginslug], $response['new_version'], '<' ) ){
		
			$transient->response[$pluginslug] = (array) json_decode(json_encode($response['upgradeinfo']));
				
		}
		
	   return $transient;
		
	}
	

}
