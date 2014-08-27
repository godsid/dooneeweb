<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends SAMSUNG_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('samsungPayment');
		$this->load->model('payment_model','mPayment');
	}

	public function prepareCharging(){
		$data = $this->input->post();

		$this->mPayment->checkUserId($data['uId']);
		$this->mPayment->checkTransactionId($data['transactionId']);
		
		$this->mPayment->samsungPrepareCharging($data['uId'],$data['transactionId'],$data['appId'],$data['cId'],$data['price']);

		$this->mPayment->insertTransection($data);

	}

	public function confirmCharging(){
		$this->load->model('user_model','mUser');
		$data = $this->input->post();

		$this->samsungPayment->confirmCharging();
		$this->mPayment->checkTransactionId($data['transactionId']);
		$this->mPayment->updateTransection($data);
		$this->mUser->insertPackage();
	}
}
