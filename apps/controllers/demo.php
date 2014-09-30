<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demo extends CI_Controller {
    var $categories;
    var $memberLogin;
    var $package;
    public function __construct(){
        parent::__construct();
        $this->load->library('One23Payment');
        $this->load->library('Twoc2pPayment');
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('package_model','mPackage');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();
        //if(!$this->memberLogin){
        //    redirect(home_url());
        //}
    }

    public function index(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }
    public function creditcard($package_id=""){
        

        $xml = "";
        if($encryptedCardInfo = $this->input->post('encryptedCardInfo')){
            $this->validate($package_id);
            $messageID = $this->getMessageID();
            if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,'CREDITCARD','',$this->package['price'],$this->package['title'],"")){
                $view['form'] = $this->twoc2ppayment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$encryptedCardInfo);
                //var_dump($view);
                $this->load->view('web/payment_submit',$view);
            }
        }else{
            redirect('/package');
        }
    }

    public function ip(){
        $this->load->library('geoip_lib');
        echo $this->input->ip_address();
        var_dump($this->geoip_lib->InfoIP($this->input->ip_address()));

        var_dump($this->geoip_lib->result_country_code());
    }
}