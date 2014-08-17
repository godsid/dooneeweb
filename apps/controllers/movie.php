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
        $this->load->model('movie_model','mMovie');
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
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movie'] = $this->mMovie->getMovie($movieId);
        $view['relates'] = $this->mMovie->getMovieRelate($movieId,5);
        $this->load->view('web/movie_detail',$view);
    }

    private function archive(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
        $this->load->view('web/movie',$view);
    }
    public function cate($category_id){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesCategory($category_id,$this->page,$this->limit);
        $this->load->view('web/movie',$view);
    }
    public function series(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesSeries($this->page,$this->limit);
        $this->load->view('web/movie',$view);   
    }
    public function search(){
        $q = $this->input->get('q');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['search'] = $q;
        $view['movies'] = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);

        $this->load->view('web/movie',$view);   
    }
    public function suggestion(){
        $q = $this->input->get('q');
        $movies = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);
        $resp['allItem'] = $movies['pageing']['allItem'];
        $resp['items'] = array();
        $movies = $movies['items'];
        for($i=0,$j=count($movies);$i<$j;$i++){
            $resp['items'][] = array(
                'movie_id'=>$movies[$i]['movie_id'],
                'title'=>$movies[$i]['title'],
                'title_en'=>$movies[$i]['title_en'],
                'cover'=>static_url($movies[$i]['cover'])
                );
        }
        unset($movies);
        echo json_encode($resp);
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