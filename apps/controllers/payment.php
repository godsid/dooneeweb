<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {
    var $categories;
    var $memberLogin;
	public function __construct(){
        parent::__construct();
        $this->load->library('one23payment');
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
    public function creditcard(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();

        $view['payment'] = array(
                                'type'=>'creditcard'
                            );

        $this->load->view('web/payment_submit',$view);
    }
    public function ibanking($package_id=""){
        //$view['memberLogin'] = $this->memberLogin;
        //$view['categories'] = $this->categories;
        if(!is_numeric($package_id)){
            redirect(base_url('/package'));
        }
        $package = $this->mPackage->getPackage($package_id);
        if(!$package){
            redirect(base_url('/package'));
        }
        if($invoice_id = $this->createInvoice($this->memberLogin['user_id'],'IBANKING',$package['price'],$package['title'],"")){
            $items[] = array('id'=>$package['package_id'],'name'=>$package['title'],'price'=>$package['price'],'quantity'=>1);

            $view['form'] = $this->one23payment->createForm("2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH",$invoice_id,$package['price'],$package['title'],$items,$this->memberLogin['firstname'].' '.$this->memberLogin['lastname'],$this->memberLogin['email'],"IBANKING");
            $this->load->view('web/payment_submit',$view);

        }else{
            $this->load->view('web/payment',$view);
        }
    }
    public function paypoint(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }
    public function atm(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }
    public function bankcounter(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }

    public function submit(){
        //$messgaeID,$invoiceID,$amount,$description,$items=array(),$payerName="",$payerEmail="",$payerMobile="",$shippingAddress=""
        $items[] = array('id'=>1,'name'=>"item1",'price'=>100,'quantity'=>1);
        $view['form'] = $this->one23payment->createForm("2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH",10,100,'description',$items,'developer','developer@dooneetv.com','66864785412','Bangkok');
        //var_dump($view['form']);
        $this->load->view('web/payment_submit',$view);
    }


    public function fontResponse(){
        $respData = $this->input->post('OneTwoThreeRes');
        $invoice = $this->input->get('invoice');
        var_dump($this->one23payment->decrypt($invoice,$respData));
    }

    private function createInvoice($user_id,$channel,$amount,$title,$description){
        $this->load->model('invoice_model','mInvoice');
        return $this->mInvoice->setInvoice(array(
                                    'user_id'=>$user_id,
                                    'channel'=>$channel, 
                                    'amount'=>$amount,
                                    'title'=>$title,
                                    'description'=>$description
                                ));
    }

}