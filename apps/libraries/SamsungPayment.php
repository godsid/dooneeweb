<?php defined('BASEPATH') or exit('No direct script access allowed');
class SamsungPayment{
	$errorCode = array(
				"20100"=>"success",
				"20903"=>"invalid appId",
				"20904"=>"invalid contentId",
				"20905"=>"invalid price"
		);
	public function __construct(){
			
	}

	public function prepareCharging($uId,$command,$transactionId,$appId,$cId,$price,$status,$description){

		$resp = array(
					"status"=>"ok",
					"statusCode"=>"20100",
					"description"=>"success"
				);
		return $resp;
	}

	public function confirmCharging($uId,$command,$transactionId,$appId,$cId,$price,$status,$description){
		$resp = array(
					"status"=>"ok",
					"statusCode"=>"20100",
					"description"=>"success"
				);
		return $resp;
	}

	public function checkTransactionId($uId,$transactionId,$appId,$cId,$price){
		$resp = array(
					"status"=>"ok",
					"description"=>"success"
				);
		return $resp;
	}

	public function checkUserId($uId){
		$resp = array(
					"status"=>"ok",
					"description"=>"success"
				);
		return $resp;
	}


}