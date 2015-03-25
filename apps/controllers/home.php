<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    var $categories;
    var $memberLogin;
    var $page;
    var $limit;
	public function __construct(){
        parent::__construct();

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
    	if($_SERVER['HTTP_HOST']=='www.dooneetv.com'){
    		header('location:https://www.doonee.com');
			return;
    	}
		
    	//check android device
    	/*$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') !== false) { 
            // && stripos($ua,'mobile') !== false) {
		    header("location:https://play.google.com/store/apps/details?id=th.co.mediaplex.dooneetvmobile");
			return;
		}*/
		
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');
        $this->load->model('movie_model','mMovie');
		$this->load->model('article_model','mArticle');

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['banners'] = $this->mBanner->getBanners();
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
		$view['moviesFree'] = $this->mMovie->getMoviesFree(1,20);
        $view['moviesFree'] = $view['moviesFree']['items'];
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
		$view['article'] = $this->mArticle->getLatestNews();
        $this->load->view('web/home',$view);
    }
	
	public function index2(){
    	if($_SERVER['HTTP_HOST']=='www.dooneetv.com'){
    		header('location:https://www.doonee.com');
			return;
    	}
		
    	//check android device
    	/*
         $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'android') !== false) { 
        // && stripos($ua,'mobile') !== false) {
		    header("location:https://play.google.com/store/apps/details?id=th.co.mediaplex.dooneetvmobile");
			return;
		}
        */
		
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');
        $this->load->model('movie_model','mMovie');
		$this->load->model('article_model','mArticle');

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['banners'] = $this->mBanner->getBanners();
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
		$view['moviesFree'] = $this->mMovie->getMoviesFree(1,20);
        $view['moviesFree'] = $view['moviesFree']['items'];
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
		$view['article'] = $this->mArticle->getLatestNews();
        $this->load->view('web/home2',$view);
    }
}