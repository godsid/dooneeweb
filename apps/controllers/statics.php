<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statics extends CI_Controller {
    var $categories;
    var $memberLogin;
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('page_model','mPage');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();

    }
    public function aboutus(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['page'] = $this->mPage->getPage('aboutus');
        $this->load->view('web/page',$view);
    }
    public function help(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['page'] = $this->mPage->getPage('help');
        $this->load->view('web/page',$view);   
    }
    public function conditions(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['page'] = $this->mPage->getPage('condition');
        $this->load->view('web/page',$view);
    }
    public function privacy(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['page'] = $this->mPage->getPage('privacy');
        $this->load->view('web/page',$view);
    }
    public function contactus($option=""){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;

        if($option=='submit'){
            $error = $this->sendmail();
            if(is_array($error)){
                $view['error'] = $error;
                $view['data'] = $this->input->post();
            }else{
                redirect(base_url('/contactus/success'));
            }
        }elseif($option=="success"){
            $view['success'] = true;
        }
        $this->load->view('web/statics_contactus',$view);   
    }

    private function sendmail(){
        $data = $this->input->post();
        $error = array();
        if(!isset($data['topic'])||empty($data['topic'])){
            $error['topic'] = "คุณไม่ได้เลือกหัวข้อการติดต่อ";
        }
        if(!isset($data['name'])||empty($data['name'])){
            $error['name'] = "คุณไม่ได้ชื่อ";   
        }
        if(!isset($data['email'])||empty($data['email'])){
            $error['email'] = "คุณไม่ได้ระบุอีเมล์";
        }
        if(!isset($data['telephone'])||empty($data['telephone'])){
            $error['telephone'] = "คุณไม่ได้เบอร์โทรศัพท์";
        }
        if(!isset($data['feedback'])||empty($data['feedback'])){
            $error['feedback'] = "คุณไม่ได้ระบุรายละเอียด";
        }
        if(count($error)){
            return $error;
        }else{
            // Additional headers
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'To: Webmaster DooneeTV <webmaster@doonee.tv>' . "\r\n";
            $headers .= 'From: '.$data['name'].' <'.$data['email'].'>' . "\r\n";
            $message = "ถึง Webmaster \r\n\r\n
                        เรื่อง ".$data['topic']." \r\n\r\n
                        ".$data['feedback']."\r\n\r\n\r\n

                        จาก: ".$data['name']."\r\n
                        อีเมล์: ".$data['email']."\r\n
                        โทรศัพย์: ".$data['telephone']."\r\n    
                        ";
            mail($this->config->item('email_contact'),$data['topic'],nl2br($message),$headers);

            return true;
        }

    }


}