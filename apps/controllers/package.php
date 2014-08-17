<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Package extends CI_Controller {
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
        /*
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');
        $this->load->model('movie_model','mMovie');

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['banners'] = $this->mBanner->getBanners();
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
        $view['movies'] = $this->mMovie->getMoviesHot(1,20);
        */
        
        $view['memberLogin'] = $this->memberLogin;
        $view['packages'] = $this->mPackage->getPackages();
        $view['categories'] = $this->categories;
        $this->load->view('web/package',$view);


    }
}