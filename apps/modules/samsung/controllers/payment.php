<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends SAMSUNG_Controller {
	public function __construct(){
		header("Content-type: Application/json; Charset:utf8;");
		parent::__construct();
		$this->load->config('samsung');
		$this->load->library('samsungPayment');
		$this->load->model('payment_model','mPayment');
		$this->load->model('package_model','mPackage');
		$this->load->model('user_model','mUser');

	}
	public function respBack_8GMF8NGz(){

		if($this->input->get_post('command')=='prepareCharging'){
			$this->prepareCharging();
		}elseif($this->input->get_post('command')=='confirmCharging'){
			$this->confirmCharging();
		}else{
			echo json_encode($this->samsungpayment->getCode("20907"));
			exit;
		}
	}
	private function prepareCharging(){
		$data = $this->input->get();
		$data['time'] = date('Y-m-d H:i:s');
		$this->samsungpayment->log(print_r($data,true));
		$this->mPayment->log($data);
		
		$this->validateData($data);
		if($package = $this->mPackage->getPackageByName($data['cId'])){
			$data['cId'] = $package['package_id'];
		}
		
		$this->mPayment->insertTransection($data);
		echo json_encode($this->samsungpayment->getCode("20100"));
		exit;
	}

	private function confirmCharging(){
		$this->load->model('user_model','mUser');
		$data = $this->input->get();
		$data['time'] = date('Y-m-d H:i:s');

		$this->samsungpayment->log(print_r($data,true));
		$this->mPayment->log($data);
		$this->validateData($data);
		if($package = $this->mPackage->getPackageByName($data['cId'])){
			$data['cId'] = $package['package_id'];
		}
		if($prePayment = $this->mPayment->checkTransection($data['transactionId'],$data['uId'],$data['cId'],$data['price'])){
			$transectionData = array(
					'command'=>$data['command'],
					'status'=>$data['status'],
					'description'=>$data['description']
				);
			$this->mPayment->updateTransection($data['transactionId'],$transectionData);
			if($data['status']==200){
				$userData = $this->mUser->getUser($data['uId']);
				$packageData = $this->mPackage->getPackageByName($data['cId']);

				$data = array(
						'user_id'=>$userData['user_id'],
						'package_id'=>$packageData['package_id'],
						'create_date'=>date('Y-m-d H:i:s'),
						'expire_date'=>date('Y-m-d H:i:s',strtotime('+'.$packageData['dayleft'].' day'))
					);
				$this->mPackage->setUserPackage($data);	
			}
			
			echo json_encode($this->samsungpayment->getCode("20100"));
			exit;
		}else{
			
			echo json_encode($this->samsungpayment->getCode("20907"));
			exit;
		}
	}

	private function validateData($data){

		if(!isset($data['appId'])||$this->config->item('samsung_appid')!=$data['appId']){
			echo json_encode($this->samsungpayment->getCode("20903"));
			exit;
		}
		$package = $this->mPackage->getPackageByName($data['cId']);
		if(!$package){
			echo json_encode($this->samsungpayment->getCode("20904"));
			exit;
		}elseif($package['price']!=$data['price']){
			echo json_encode($this->samsungpayment->getCode("20905"));
			exit;
		}
		if(!$this->samsungpayment->checkUserId($data['uId'])){
			echo json_encode($this->samsungpayment->getCode("20906"));
			exit;
		}
		//if(!$this->samsungpayment->checkTransactionId($data['uId'],$data['transactionId'],$data['cId'],$data['price'])){
		//	echo json_encode($this->samsungpayment->getCode("20907"));
		//	exit;
		//}

	}
}
