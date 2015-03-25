<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Util {
	public function __construct(){
	}
	
	/*--------------------------------*/
	function generateRandomString($length = 32, $number_only = false) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if($number_only) {
			$characters = '0123456789';
		}
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	/*--------------------------------*/
	public function array_to_xml(array $arr, SimpleXMLElement $xml)
	{
	    foreach ($arr as $k => $v) {
	        is_array($v)
	            ? $this->array_to_xml($v, $xml->addChild($k))
	            : $xml->addChild($k, $v);
	    }
	    return $xml;
	}
	
	/*---------------------------------*/
	function post($url,$fields_string){
		//open connection
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		//execute post
		$result = curl_exec($ch); //close connection
		curl_close($ch);
		return $result;
	}
	
	/*---------------------------------*/
	function post_xml($url, $xml_data){
		$ch = curl_init();
		  curl_setopt( $ch, CURLOPT_URL, $url );
		  curl_setopt( $ch, CURLOPT_POST, true );
		  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		  curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml_data );
		  $result = curl_exec($ch);
		  curl_close($ch);
  
		return $result;
	}
}
?>