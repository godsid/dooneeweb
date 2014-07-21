<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->breadcrumb[] = array('title'=>'Banner','url'=>backoffice_url('/banner'));
	}

	public function index($bannerID=""){

		if($memberID){
				$this->profile();
				exit;
		}
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('banner',$data);
	}
	public function edit($bannerID=""){
		$this->breadcrumb[] = array('title'=>'MemberName','url'=>backoffice_url('/banner/edit/'.$bannerID));
		$data['breadcrumb'] = $this->breadcrumb;
		//$this->load->view('member_edit',$data);
	}
}

/* End of file member.php */
/* Location: ./application/modeules/backoffice/controllers/member.php */