<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    var $categories;
    var $memberLogin;
    var $page;
    var $limit;
	public function __construct(){
        parent::__construct();
        $allow = array('127.0.0.1');
        if(!in_array($this->input->ip_address(),$allow)){
            if($this->geoip_lib->InfoIP($this->input->ip_address())){
                if($this->geoip_lib->result_country_code()!="TH"){
                    show_404();
                }
            }else{
                show_404();
            }
        }
        

       // if($_SERVER['HTTP_HOST']=='doonee.tv'||$_SERVER['HTTP_HOST']=='www.doonee.tv')){
        //    redirect('');
       // }

        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();
        $this->page = $this->input->get('page'); $this->page = $this->page?$this->page:1;
        $this->limit = $this->input->get('limit'); $this->limit = $this->limit?$this->limit:30;
    }

    public function index(){
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');
        $this->load->model('movie_model','mMovie');

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['banners'] = $this->mBanner->getBanners();
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
        $this->load->view('web/home',$view);


    }
}