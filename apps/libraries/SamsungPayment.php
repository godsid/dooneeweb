<?php defined('BASEPATH') or exit('No direct script access allowed');
class SamsungPayment{
	var $errorCode = array(
				"20100"=>array("status"=>"ok","statusCode"=>"20100","description"=>"success"),
				"20903"=>array("status"=>"error","statusCode"=>"20903","description"=>"invalid appId"),
				"20904"=>array("status"=>"error","statusCode"=>"20904","description"=>"invalid contentId"),
				"20905"=>array("status"=>"error","statusCode"=>"20905","description"=>"invalid price"),
				"20906"=>array("status"=>"error","statusCode"=>"20906","description"=>"invalid uId"),
				"20907"=>array("status"=>"error","statusCode"=>"20907","description"=>"invalid transactionId"),
				"20908"=>array("status"=>"error","statusCode"=>"20908","description"=>"invalid Command")
		);
	var $timeout = 10;
	var $config;
	var $CI;
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('samsung');
	}

	public function checkTransactionId($uId,$transactionId,$cId,$price){
		$data = array(
				'uId'=>$uId,
				'transactionId'=>$transactionId,
				'appId'=>$this->CI->config->item('samsung_appid'),
				'cId'=>$cId,
				'price'=>$price
				);
		if($resp = $this->call($this->CI->config->item('samsung_checktransactionid_url'),$data)){
			$resp = json_decode($resp,true);
			if($resp['status']=='ok'){
				return true;
			}
		}
		return false;
	}

	public function checkUserId($uId){
		$data = array('uId'=>$uId);
		if($resp = $this->call($this->CI->config->item('samsung_checkuserid_url'),$data)){
			$resp = json_decode($resp,true);
			if($resp['status']=='ok'){
				return true;
			}
		}
		return false;	
	}
	public function getCode($code){
		return $this->errorCode[$code];
	}

	public function log($message=""){
		error_log($message,3,$this->CI->config->item('samsung_payment_log'));
	}
	private function call($url,$param){
		$ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_TIMEOUT,$this->timeout);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch,CURLOPT_POST,true); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($param));
        $resp = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 
        if($info['http_code']<400){
        	return $resp;
        }else{
        	error_log(print_r(array($info,$resp)),3,$this->CI->config->item('samsung_connection_log'));
        	return false;
        }
	}
}