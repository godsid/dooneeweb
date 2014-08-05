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
        $this->load->view('web/member_register');
    }
    public function register_submit(){
        $member = $this->input-post();
        $error = false;
        $message = array();
        if($member['email']){
            $error = true;
            $message['email_error'] = "ยังไม่ได้ระบุ Email"; 
        }
        if($member['password']){
            $error = true;
            $message['password_error'] = "ยังไม่ได้ระบุ Email"; 
        }
        if($member['password']!=$member['rpassword']){
            $error = true;
            $message['password_error'] = "รหัสผ่านไม่ตรงกัน"; 
        }

        if($member['email']&&$member['password']&&$member['rpassword']){
            //Check Duplicate Email
            if($this->mMember->isDuplicateEmail($member['email'])){
                $error = true;
                $message['email_error'] = "Email นี้ถูกใช้งานแล้ว";
            }
        }

        if(!$error){
            if($member_id = $this->mMember->setMember($member)){
                redirect(base_url('/login'));
            }else{
                $error = true;
                $view['error_message']['unknow'] = "เกิดความผิดพลาดกรุณาลองใหม่: 501";
            }
        }

        $view['member'] = $member;
        $view['error'] = $error;
        $view['error_message'] = $message;
        $this->load->view('web/member_register',$view['member']);
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