<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {
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
        if(!$this->memberLogin){
            redirect(home_url());
        }
    }

    public function index(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }
    public function creditcard($package_id=""){
        
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

    public function ibanking($package_id="",$agent=""){
        //$view['memberLogin'] = $this->memberLogin;
        //$view['categories'] = $this->categories;
        $this->validate($package_id);
        $messageID = $this->getMessageID();
        if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],'IBANKING',strtoupper($agent),$this->package['price'],$this->package['title'],"")){
            $items[] = array('id'=>$this->package['package_id'],'name'=>$this->package['title'],'price'=>$this->package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],'IBANKING',strtoupper($agent));
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }
    public function paypoint($package_id="",$agent=""){
        //$view['memberLogin'] = $this->memberLogin;
        //$view['categories'] = $this->categories;
        $this->validate($package_id);
        $messageID = $this->getMessageID();
        if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,'PAYPOINT',strtoupper($agent),$this->package['price'],$this->package['title'],"")){
            $items[] = array('id'=>$this->package['package_id'],'name'=>$this->package['title'],'price'=>$this->package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],'PAYPOINT',strtoupper($agent));
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }
    public function atm($package_id="",$agent=""){
        //$view['memberLogin'] = $this->memberLogin;
        //$view['categories'] = $this->categories;
        $this->validate($package_id);
        $messageID = $this->getMessageID();
        if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,'ATM',strtoupper($agent),$this->package['price'],$this->package['title'],"")){
            $items[] = array('id'=>$this->package['package_id'],'name'=>$this->package['title'],'price'=>$this->package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],'ATM',strtoupper($agent));
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }
    public function bankcounter($package_id="",$agent=""){
        //$view['memberLogin'] = $this->memberLogin;
        //$view['categories'] = $this->categories;
        $this->validate($package_id);
        $messageID = $this->getMessageID();
        if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,'BANKCOUNTER',strtoupper($agent),$this->package['price'],$this->package['title'],"")){
            $items[] = array('id'=>$this->package['package_id'],'name'=>$this->package['title'],'price'=>$this->package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],'BANKCOUNTER',strtoupper($agent));
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }

    public function card($package_id=""){
        $this->validate($package_id);
         if($invoice_id = $this->createInvoice('',$this->memberLogin['user_id'],$package_id,'CARD','',$this->package['price'],$this->package['title'],"")){

            $this->load->view('web/payment_submit',$view);

        }
    }

    public function inquiry($package_id="",$channel="",$agent=""){
        $this->validate($package_id);
        $messageID = $this->getMessageID();
        if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,strtoupper($channel),strtoupper($agent),$this->package['price'],$this->package['title'],"")){
            $items[] = array('id'=>$this->package['package_id'],'name'=>$this->package['title'],'price'=>$this->package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->inquiry($messageID,$invoice_id,$this->package['price'],$this->package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],strtoupper($channel),strtoupper($agent));
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }

    /*public function submit(){
        //$messgaeID,$invoiceID,$amount,$description,$items=array(),$payerName="",$payerEmail="",$payerMobile="",$shippingAddress=""
        $items[] = array('id'=>1,'name'=>"item1",'price'=>100,'quantity'=>1);
        $view['form'] = $this->one23payment->createForm("2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH",10,100,'description',$items,'developer','developer@dooneetv.com','66864785412','Bangkok');
        //var_dump($view['form']);
        $this->load->view('web/payment_submit',$view);
    }*/

    public function response($type="",$invoiceID=""){
        $view = array();
        if($type=='creditcard3d'){
            $resp = $this->twoc2ppayment->decrypt($this->input->post('paymentResponse'));
            if(preg_match('#<respCode>([0-9]+)</respCode>#',$resp,$respCode)){
                $respCode = $respCode[0];
            }

            //echo($this->twoc2ppayment->decrypt($this->input->post('paymentResponse')));

            $this->load->view('web/payment',$view);
        }else{

        }
        //var_dump($_POST);
        //"paymentResponse"
    }
    public function fontResponse(){
        $respData = $this->input->post('OneTwoThreeRes');
        $invoice = $this->input->get('invoice');
        //var_dump($this->one23payment->decrypt($invoice,$respData));
        $this->load->view('web/payment');
    }

    private function createInvoice($messageID,$user_id,$package_id,$channel,$agent,$amount,$title,$description){
        $this->load->model('invoice_model','mInvoice');
        return $this->mInvoice->setInvoice(array(
                                    'message_id'=>$messageID,
                                    'user_id'=>$user_id,
                                    'package_id'=>$package_id,
                                    'channel'=>$channel,
                                    'agent'=>$agent, 
                                    'amount'=>$amount,
                                    'title'=>$title,
                                    'description'=>$description
                                ));
    }
    private function getMessageID(){
        return strtoupper('dooneetv'.random_string('alnum',32));
    }
    private function validate($package_id=""){
        if(!is_numeric($package_id)){
            redirect(base_url('/package'));
        }
        $this->package = $this->mPackage->getPackage($package_id);
        if(!$this->package){
            redirect(base_url('/package'));
        }
    }

}