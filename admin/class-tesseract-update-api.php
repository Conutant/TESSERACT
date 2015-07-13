<?php
 
class Tesseract_Update_Api {
	
	const API_URL = 'http://updates.tyler.com/api';
	
	const API_KEY = 'K-+t9M8+$XP=ssMp';
	
	static function doaction($param){
		
		
		$arr_postdata = array();			
		
		$arr_postdata = $param;
		
		$arr_postdata['accesskey'] = self::API_KEY;					
 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_URL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr_postdata));
		$response = curl_exec($ch);
 
		if(curl_errno($ch)) {
		
			$arr_error_msg['curl_error_no'] = curl_errno($ch) ;
			
			$arr_error_msg['curl_error_msg']= curl_error($ch);		
				
		}else{
	
	
			$resArray = json_decode($response,true);
	
			 $ack = strtoupper($resArray["ack"]);
			 
			if( $ack != "SUCCESS" ){
			
				if(isset($resArray['errors'])){
	
					$resArray['errors'] = is_array($resArray['errors']) ? $resArray['errors'] : array($resArray['errors']);
					
					foreach($resArray['errors'] as $error){
					
						array_push($arr_error_msg,$error);
						
					}
				}
				
			}else{
		
				return $resArray['response'];
		
			}
		
		}
 
		curl_close($ch);
			
	}
}
