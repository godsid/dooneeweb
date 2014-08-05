<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
    }

    public function index(){

    }

    public function register(){

    }

    public function login(){
        $this->auth();
    }

    public function auth(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email&&$password){
            if($user = $this->mMember->login($email,md5($password))){
                $this->session->set_userdata(array('user_data'=>$user));
                redirect(base_url('/home'));
            }else{
                $this->load->view('web/member_login'); 
            }
        }else{
            $this->load->view('web/member_login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('/'));
    }

}