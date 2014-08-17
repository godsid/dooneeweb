<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {
    var $categories;
    var $memberLogin;
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('package_model','mPackage');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();

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
        $this->load->view('web/payment',$view);
    }
    public function ibanking(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
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

}