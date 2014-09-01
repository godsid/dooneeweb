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
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        $this->load->view('web/member_register',$view);
    }

    public function favorite(){
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        $this->load->view('web/member_register',$view);
    }

    public function package(){
        $this->load->model('package_model','mPackage');
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['package'] = $this->mPackage->getMemberPackage($this->memberLogin['user_id']);
        $this->load->view('web/member_package',$view);
    }

    public function register($option=""){
        if($this->memberLogin&&$option!="success"){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();
        if($option=="success"){
            $this->load->view('web/member_register_success',$view);    
        }else{
            $this->load->view('web/member_register',$view);    
        }
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
        }elseif(!preg_match("#^[a-z][a-z0-9_\-\.]+@[a-z0-9_\.\-]+\.\w#",$member['email'])){
            $error = true;
            $message['email'] = "อีเมล์ ไม่ถูกต้อง exp:xxx@email.com"; 
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
        }elseif(strlen($member['password'])<4){
            $error = true;
            $message['password'] = "รหัสผ่านน้อยกว่า 4 ตัวอักษร"; 
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
                //Auto Login
                if($this->auth('afterRegister')){
                    redirect(base_url('/register/success'));
                }else{
                    redirect(base_url('/login?formregister'));    
                }
                
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

    public function facebookLogin(){
        $data = $this->input->post();
        $member = $this->mMember->facebookLogin($data['id'],$data['email']);
        if($member){
            if($member['facebook_id']==$data['id']){
                //Registered with facebook
                //redirect(home_url());
            }elseif($member['email'] == $data['email']){
                //Match facebook_id
                if($this->mMember->updateMember($member['user_id'],array('facebook_id'=>$data['id']))){
                }
            }    
        }else{
            //New User Register by facebook
            $member_id = $this->mMember->setMember(array(
                    'email'=>$data['email'],
                    'firstname'=>$data['first_name'],
                    'lastname'=>$data['last_name'],
                    'facebook_id'=>$data['id'],
                    'password'=>md5($data['id']),
                    'create_date'=>date('Y-m-d H:i:s')
                    ));
            if($member_id){
                $member = $this->mMember->getMember($member_id);
            }
        }
        $user = $this->mMember->login($member['email'],$member['password']);
        $this->session->set_userdata(array('user_data'=>$user));
        header("Content-type: Application/json; charset:utf8;");
        echo json_encode($user);
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
    public function auth($option=""){
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
                if($option=="afterRegister"){
                    return true;
                }
                if($reurl = $this->input->get('reurl')){
                    redirect($reurl);
                }else{
                    redirect(home_url());
                }
                
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