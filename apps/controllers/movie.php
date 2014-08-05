<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class movie extends CI_Controller {
    var $categories;
    var $page;
    var $limit;
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->categories = $this->mCategory->getCategoriesMenu();        
        $this->page = $this->input->get('page'); $this->page = $this->page?$this->page:1;
        $this->limit = $this->input->get('limit'); $this->limit = $this->limit?$this->limit:30;


    }

    public function index($movieId=""){
        if(is_numeric($movieId)){
            $this->detail($movieId);
        }else{
            $this->archive();
        }
        /*$view['categories'] = $this->categories;
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
        $view['movies'] = $this->mMovie->getMoviesHot(1,20);
        $this->load->view('web/home',$view);
        */
    }
    private function detail($movieId){
        $this->load->model('movie_model','mMovie');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movie'] = $this->mMovie->getMovie($movieId);
        $view['relates'] = $this->mMovie->getMovieRelate($movieId,5);
        $this->load->view('web/movie_detail',$view);
    }
    private function archive(){
        $this->load->model('movie_model','mMovie');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
        $this->load->view('web/movie',$view);
    }
    public function cate($category_id){
        $this->load->model('movie_model','mMovie');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
        $this->load->view('web/movie',$view);
    }
    public function search(){
        $q = $this->input->get('q');
        $this->load->model('movie_model','mMovie');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['search'] = $q;
         $view['movies'] = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);

        $this->load->view('web/movie',$view);   
    }
    public function letter($alphabet=""){
        $this->load->model('movie_model','mMovie');

        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['letter'] = $alphabet;
        $view['movies'] = $this->mMovie->getMoviesLetter($alphabet,$this->page,$this->limit);
        $this->load->view('web/movie',$view);   

    }
}