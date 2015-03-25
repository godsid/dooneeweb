<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(APPPATH.'libraries/REST_Controller.php');
class Package extends CI_controller {

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
}