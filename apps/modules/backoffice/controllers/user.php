<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function login(){
		if($this->session->userdata('email') && $this->session->userdata('permission')=='ADMIN'){
			redirect(backoffice_url('/dashboard'));
		}else{
			$this->load->view('login');	
		}
	}
	public function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username&&$password){
			$this->load->model('user_model','mUser');
			if($user = $this->mUser->login($username,$password)){
				$this->session->set_userdata($user);
				redirect(backoffice_url('/dashboard'));
			}else{
				$this->load->view('login');	
			}
		}else{
			$this->load->view('login');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(backoffice_url('/user/login'));
	}
}