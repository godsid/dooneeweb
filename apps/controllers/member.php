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
    public function addHistory(){
        header("Content-type: Application/json; charset:utf8;");
        $movieID = $this->input->post('movie_id');
        $episodeID = $this->input->post('episode_id');
        $last_time = $this->input->post('last_time');
        if(!$this->memberLogin){
            $status = 'error';
            $message = 'คุณยังไม่ได้เข้าสู่ระบบค่ะ';
        }else{
            if($history_id = $this->mMember->setMemberHistory($this->memberLogin['user_id'],$movieID,$episodeID,$last_time)){
                $status = 'success';
                $message = '';
                $items = array('history_id'=>$history_id,'movie_id'=>$movieID,'episode_id'=>$episodeID);
            }else{
                $status = 'error';
                $message = 'เกิดข้อผิดพลาดกรุณาลองใหม่ค่ะ';
            }
        }
        
        $resp = array(
                    'status'=>$status,
                    'message'=>$message
                );
        echo json_encode($resp);
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
    public function isFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($movie_id = $this->input->get('movie_id')){
            $favorites = $this->mMember->isMemberFavorites($this->memberLogin['user_id'],$movie_id);
            echo json_encode(array('status'=>'success','message'=>'','items'=>$favorites));
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid movie_id'));
        }
    }
    public function addFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($movie_id = $this->input->get('movie_id')){
            if($favorite_id = $this->mMember->setMemberFavorite($this->memberLogin['user_id'],$movie_id)){
                echo json_encode(array('status'=>'success','message'=>'','favorite_id'=>$favorite_id));    
            }else{
                echo json_encode(array('status'=>'error','message'=>'Insert fail'));    
            }
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid movie_id'));
        }
    }
    public function deleteFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($favorite_id = $this->input->get('favorite_id')){
            if($this->mMember->deleteMemberFavorite($this->memberLogin['user_id'],$favorite_id)){
                echo json_encode(array('status'=>'success','message'=>''));    
            }else{
                echo json_encode(array('status'=>'error','message'=>'Delete fail'));
            }
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid favorite_id'));
        }
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
        $member['email'] = strtolower($member['email']);
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
                
                /* Promotion New Member to Package ID 5 ดูนี่ทีวีโปรโมชั่นดูฟรี 3วัน */
                $this->promotionRegister($member_id);

                
                /* End Promotion */


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
                $this->promotionRegister($member_id);
            }
        }
        $user = $this->mMember->login($member['email'],$member['password']);
        //if($device_code = $this->checkFirstLogin($user['user_id'])){
            //$user['device'] = $device_code;
            $this->session->set_userdata(array('user_data'=>$user));
            header("Content-type: Application/json; charset:utf8;");
            echo json_encode($user);
        //}else{
            //header("Content-type: Application/json; charset:utf8;");
            //echo json_encode(array('message'=>'บัญชีนี้ถูกใช้งานจากเครื่องอื่นอยู่'));
        //}
        
        
    }
    public function changepassword(){
        $this->load->view('web/member_changepassword');
    }

    public function forgotpassword($option=""){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();

        if($option=='submit'){
            $email = $this->input->post('email');
            $headers = "MIME-Version: 1.0 ".
            "From: ".$this->config->item('email_contact')." \r\n" .
            "Reply-To: ".$this->config->item('email_contact')." \r\n" .
            "Content-type: text/html; charset=utf-8 \r\n".
            "X-Mailer: PHP/" . phpversion();
            $message= "


            ";
            mail($email,"แจ้งลืมรหัสผ่าน DooneeTV",$message,$headers);
        }

        $this->load->view('web/member_forgotpassword',$view);
    }
    public function auth($option=""){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['reurl'] = $this->input->get('reurl');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $autologin = $this->input->post('remember');
        if($email&&$password){
            if($user = $this->mMember->login(strtolower($email),md5($password))){
                //if($device_code = $this->checkFirstLogin($user['user_id'])){
                    //$user['device'] = $device_code;
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
                //}else{
                    $view['message'] = 'บัญชีนี้ถูกใช้งานจากเครื่องอื่นอยู่';
                //    $this->load->view('web/member_login',$view); 
                //}
            }else{
                $this->load->view('web/member_login',$view); 
            }
        }else{
            $this->load->view('web/member_login',$view);
        }
    }

    public function logout(){
        $user = $this->session->userdata('user_data');
        $this->mMember->deleteMemberDevice($user['user_id']);
        $this->input->set_cookie('remember','',strtotime('-1 day'));
        $this->session->sess_destroy();
        redirect(home_url());
    }
    private function checkFirstLogin($user_id){
        $device = $this->mMember->getMemberDevice($user_id);
        $device_code = $this->mMember->deviceEncode($user_id);
        if($device){
            if($device['last_active'] < date('Y-m-d H:i:s',time()-1800)){
                $data = array(
                            'device'=>$device_code,
                            'device_detail'=>$this->agent->agent_string(),
                            'ip_address'=>$this->input->ip_address(),
                            'last_active'=>date('Y-m-d H:i:s')
                        );
                $this->mMember->updateMemberDevice($user_id,$data);
                return $device_code;
            }else{
                return false;
            }
        }else{
            $data = array(
                        'user_id'=>$user_id,
                        'device'=>$device_code,
                        'device_detail'=>$this->agent->agent_string(),
                        'ip_address'=>$this->input->ip_address(),
                        'last_active'=>date('Y-m-d H:i:s')
                    );
            $this->mMember->setMemberDevice($data);
            return $device_code;
        }
    }
    private function promotionRegister($member_id){
        /*
        $this->load->model('package_model','mPackage');
        if($package = $this->mPackage->getPackage(5)){
            $now = date('Y-m-d H:i:s');
            if($package['status']=='ACTIVE'&&$package['start_date'] < $now && $package['end_date'] > $now){
                $this->mMember->setMemberPackage($member_id,5,date('Y-m-d H:i:s',strtotime('+'.$package['dayleft'].' day')));
            }
            
        }
        */
    }
    
}