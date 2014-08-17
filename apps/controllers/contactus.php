<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus extends CI_Controller {
    var $categories;
	public function __construct(){
        parent::__construct();
        $this->load->model('category_model','mCategory');
        $this->categories = $this->mCategory->getCategoriesMenu();        
    }

    public function index(){
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');

        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        
        $this->load->view('web/contactus',$view);


    }
}