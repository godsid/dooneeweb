<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller {
    var $memberLogin;
    var $categories;

	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->memberLogin = $this->mMember->getMemberLogin();
        $this->load->model('category_model','mCategory');
        $this->categories = $this->mCategory->getCategoriesMenu();
    }

    public function history(){
        if($this->memberLogin){
            redirect(base_url('/login'));
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        $this->load->view('web/member_register',$view);
    }

    public function favorite(){
        if($this->memberLogin){
            redirect(base_url('/login'));
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        $this->load->view('web/member_register',$view);
    }

    public function register(){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        $this->load->view('web/member_register',$view);
    }
    public function register_submit(){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $member = $this->input->post();
        $error = false;
        $message = array();
        if(empty($member['email'])){
            $error = true;
            $message['email'] = "ยังไม่ได้ระบุ อีเมล์"; 
        }
        if(empty($member['firstname'])){
            $error = true;
            $message['firstname'] = "ยังไม่ได้ระบุ ชื่อ"; 
        }
        if(empty($member['lastname'])){
            $error = true;
            $message['lastname'] = "ยังไม่ได้ระบุ นามสกุล"; 
        }
        if(empty($member['phone'])){
            $error = true;
            $message['phone'] = "ยังไม่ได้ระบุ เบอร์โทรศัพท์"; 
        }
        if(empty($member['gender'])){
            $error = true;
            $message['gender'] = "ยังไม่ได้ระบุ เพศ"; 
        }
        if(empty($member['password'])){
            $error = true;
            $message['password'] = "ยังไม่ได้ระบุ รหัสผ่าน"; 
        }
        if($member['password']!=$member['rpassword']){
            $error = true;
            $message['password'] = "รหัสผ่านไม่ตรงกัน"; 
        }

        if($member['email']){
            //Check Duplicate Email
            if($this->mMember->isDuplicateEmail($member['email'])){
                $error = true;
                $message['email'] = "อีเมล์ นี้ถูกใช้งานแล้ว";
            }
        }
        if(!$error){
            $member['password'] = md5($member['password']);
            if($member_id = $this->mMember->setMember($member)){
                redirect(base_url('/login?formregister'));
            }else{
                $error = true;
                $view['error_message']['unknow'] = "เกิดความผิดพลาดกรุณาลองใหม่: 501";
            }
        }

        $view['member'] = $member;
        $view['error'] = $error;
        $view['error_message'] = $message;
        $this->load->view('web/member_register',$view);
    }

    public function login(){
        if($this->memberLogin){
            redirect(home_url());
        }
        $this->auth();
    }
    public function forgotpassword($option=""){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        if($option=='submit'){
            
        }

        $this->load->view('web/member_forgotpassword',$view);
    }
    public function auth(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $autologin = $this->input->post('remember');
        
        if($email&&$password){
            if($user = $this->mMember->login($email,md5($password))){
                $this->session->set_userdata(array('user_data'=>$user));
                if($autologin=='yes'){
                    $rememberCode = $user['user_id']."|".md5($user['email'].md5($password));
                    $this->input->set_cookie('remember',$rememberCode,strtotime('+1 year'),$this->config->item('cookie_domain'),'/');
                }
                redirect(home_url());
            }else{
                $this->load->view('web/member_login',$view); 
            }
        }else{
            $this->load->view('web/member_login',$view);
        }
    }

    public function logout(){
        $this->input->set_cookie('remember','',strtotime('-1 day'));
        $this->session->sess_destroy();
        redirect(home_url());
    }

}