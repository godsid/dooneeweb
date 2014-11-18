<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();

		$this->load->model('user_model','mUser');
		if(!$this->mUser->auth()){
			redirect(backoffice_url('/user/login'));
		}

		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:50;

		$this->breadcrumb[] = array('title'=>'Members','url'=>backoffice_url('/member'));

	}

	public function index($memberID=""){
		$this->mUser->auth();
		if($memberID){
			$data['member'] = $this->mUser->getUser($memberID);
			$this->breadcrumb[] = array('title'=>$data['member']['username'],'url'=>'');
			$data['breadcrumb'] = $this->breadcrumb;	
			$this->load->view('member_detail',$data);
		}else{
			$filter = array();
			if($type = $this->input->get('type')){
				$filter['type'] = $type;
			}
			$data['members'] = $this->mUser->getUsers($this->page,$this->limit,$filter);
			$data['members']['pageing']['url'] = backoffice_url('/member').(isset($filter['type'])?"?type=".$filter['type']:"");
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

	public function ruleSubmit($memberID){
		if(is_numeric($memberID)){
			$this->mUser->updateUser($memberID,array('permission'=>$_POST['permission']));
		}
		redirect(backoffice_url('/member/edit/'.$memberID));
	}

	public function edit($memberID=""){
		if($memberID=='me'){
			$memberID = $this->session->userdata('user_id');
		}
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/member/edit/'.$memberID));
		$data['breadcrumb'] = $this->breadcrumb;
		$data['member'] = $data['members'] = $this->mUser->getUser($memberID);
		$data['historys'] = $this->mUser->getMovieHistory($memberID);
		$data['packages'] = $this->mUser->getUserPackage($memberID);
		$data['invoices'] = $this->mUser->getUserInvoice($memberID);
		$this->load->view('member_detail',$data);
	}
	public function search(){
		
		$q = $this->input->get('q');
		$data['members'] = $this->mUser->searchUser($q,$this->page,$this->limit);
		$data['members']['pageing']['url'] = base_url('/member/search?q='.$q);
		$data['pageing'] = $this->load->view('pageing',$data['members']['pageing'],true);
		$data['q'] = $q;
		$this->breadcrumb[] = array('title'=>'Search','url'=>backoffice_url('/member/search/?q='.$q));
		$this->breadcrumb[] = array('title'=>$q);
		$data['breadcrumb'] = $this->breadcrumb;

		$this->load->view('member',$data);
	}

}

/* End of file member.php */
/* Location: ./application/modeules/backoffice/controllers/member.php */