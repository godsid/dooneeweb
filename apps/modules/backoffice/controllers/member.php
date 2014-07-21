<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('page');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Members','url'=>backoffice_url('/member'));
		$this->load->model('user_model','mUser');
	}

	public function index($memberID=""){
		if($memberID){
			$data['member'] = $this->mUser->getUser($memberID);
			$this->breadcrumb[] = array('title'=>$data['member']['username'],'url'=>'');
			$data['breadcrumb'] = $this->breadcrumb;	
			$this->load->view('member_detail',$data);
		}else{
			$data['members'] = $this->mUser->getUsers($this->page,$this->limit);
			$data['members']['pageing']['url'] = base_url('/member');
			$data['pageing'] = $this->load->view('pageing',$data['members']['pageing'],true);
			$data['breadcrumb'] = $this->breadcrumb;
			$this->load->view('member',$data);
		}
	}
	public function profile($memberID=""){
		$this->breadcrumb[] = array('title'=>'Profile','url'=>backoffice_url('/member/profile'));
		$this->breadcrumb[] = array('title'=>'MemberName','url'=>backoffice_url('/member/profile/'.$memberID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('member_detail',$data);
	}

	public function active($userID){
		if(is_numeric($userID)){
			$this->mUser->updateUser($userID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/member'));
	}
	public function inactive($userID){
		if(is_numeric($userID)){
			$this->mUser->updateUser($userID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/member'));
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