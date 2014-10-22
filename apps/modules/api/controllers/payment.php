<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(APPPATH.'libraries/REST_Controller.php');
class Payment extends CI_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('api/package_model','mPackage');
		$this->load->model('api/member_model','mMember');
	}
	public function index($package_id=""){
		$view = array();
		if(is_numeric($package_id)){
			$package = $this->mPackage->getPackage($package_id);
		}
		$view['package'] = $package;
		$this->load->view('package',$view);
	}

	public function creditcard(){
		$view = array();

		$this->load->view('payment_creditcard',$view);
	}
	public function atm(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function paypoint(){
		$view = array();
		
		$this->load->view('payment_paypoint',$view);
	}
	public function bankcounter(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function ibanking(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function prepaidcard(){
		$view = array();
		
		$this->load->view('payment_prepaidcard',$view);
	}

	public function success(){

	}
	public function error(){

	}
}