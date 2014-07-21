<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->breadcrumb[] = array('title'=>'Package','url'=>backoffice_url('/package'));
	}

	public function index($packageID=""){

		if($packageID){
				$this->profile();
				exit;
		}
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package',$data);
	}
	public function profile($packageID=""){
		$this->breadcrumb[] = array('title'=>'Profile','url'=>backoffice_url('/package/profile'));
		$this->breadcrumb[] = array('title'=>'PackageName','url'=>backoffice_url('/package/profile/'.$packageID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_detail',$data);
	}
	public function edit($packageID=""){
		$this->breadcrumb[] = array('title'=>'PackageName','url'=>backoffice_url('/package/profile/'.$packageID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/package/edit/'.$packageID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_form',$data);
	}
}

/* End of file package.php */
/* Location: ./application/modeules/backoffice/controllers/package.php */