<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->breadcrumb[] = array('title'=>'Member','url'=>backoffice_url('/member'));
	}

	public function index($memberID=""){

		if($memberID){
				$this->profile();
				exit;
		}
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('member',$data);
	}
	public function profile($memberID=""){
		$this->breadcrumb[] = array('title'=>'Profile','url'=>backoffice_url('/member/profile'));
		$this->breadcrumb[] = array('title'=>'MemberName','url'=>backoffice_url('/member/profile/'.$memberID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('member_detail',$data);
	}
	public function edit($memberID=""){
		$this->breadcrumb[] = array('title'=>'MemberName','url'=>backoffice_url('/member/profile/'.$memberID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/member/edit/'.$memberID));
		$data['breadcrumb'] = $this->breadcrumb;
		//$this->load->view('member_edit',$data);
	}
	public function search(){
		$this->breadcrumb[] = array('title'=>'Search','url'=>backoffice_url('/member/search'));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('member',$data);
	}

}

/* End of file member.php */
/* Location: ./application/modeules/backoffice/controllers/member.php */