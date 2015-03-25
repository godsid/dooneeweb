<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class movie extends CI_Controller {
    var $categories;
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
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('movie_model','mMovie');
        $this->categories = $this->mCategory->getCategoriesMenu();        
        $this->page = $this->input->get('page'); $this->page = $this->page?$this->page:1;
        $this->limit = $this->input->get('limit'); $this->limit = $this->limit?$this->limit:30;

    }

    public function index($movieId="",$episodeId=""){
        if(is_numeric($movieId)){
            $this->detail($movieId,$episodeId);
        }else{
            $this->archive();
        }
    }
    private function detail($movieId,$episodeId=""){
        $this->load->model('episode_model','mEpisode');
        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)||$view['movie']['is_free']=='YES') ;
            $is_favorite = $this->mMember->isMemberFavorites($view['memberLogin']['user_id'],$movieId);
            if(is_array($is_favorite)&&sizeof($is_favorite)){
                $view['memberLogin']['is_favorite'] = array_pop($is_favorite);
            }
            unset($is_favorite);
        }
        $view['categories'] = $this->categories;

        //Series Episode
        if($view['movie']['is_series']=='YES'){
            $episodes = $this->mMovie->getMovieEpisode($movieId);
            $view['episodes'] = $episodes['items'];
            unset($episodes);
            if(is_numeric($episodeId)){
                $view['thisEpisode'] = $this->mEpisode->getEpisode($episodeId);
            }else{
                
                $view['thisEpisode'] = $this->mEpisode->getEpisode($view['episodes'][0]['episode_id']);
            }
        }
        //Movie Relate
        $relates = $this->mMovie->getMovieRelate($movieId,1,10);
        if($relates['pageing']['allItem']){
            $view['relates'] = $relates['items'];
        }
        unset($relates);
        $this->load->view('web/movie_detail',$view);
    }

    private function archive(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);

        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
        
    }
    public function cate($category_id){

        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesCategory($category_id,$this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function hot(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesHot($this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function series(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesSeries($this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function search(){
        $q = $this->input->get('q');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['search'] = $q;
        $view['movies'] = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
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
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function player($movieId="",$episodeId=""){
        $this->load->library('user_agent');
        $this->load->model('episode_model','mEpisode');
        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)) ;
        }else{
			redirect(home_url('/'));
		}

        //Series Episode
        if($view['movie']['is_series']=='YES'){
            $episodes = $this->mMovie->getMovieEpisode($movieId);
            $view['episodes'] = $episodes['items'];
            unset($episodes);
            if(is_numeric($episodeId)){
                $view['thisEpisode'] = $this->mEpisode->getEpisode($episodeId);
            }else{
                $view['thisEpisode'] = $this->mEpisode->getEpisode($view['episodes'][0]['episode_id']);
            }
            $view['moviePath'] = 'series/'.$view['thisEpisode']['path'];
        }else{
            $view['moviePath'] = 'movies/'.$view['movie']['path'];
        }
        
        if($this->agent->is_mobile()){
            $this->load->view('web/player_mobile',$view);
        }else{
            $this->load->view('web/player',$view);
        }
        
    }
    public function ios($movieId="",$episodeId=""){
        $this->load->model('episode_model','mEpisode');
        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)||$view['movie']['is_free']=='YES') ;
        }

        //Series Episode
        if($view['movie']['is_series']=='YES'){
            $episodes = $this->mMovie->getMovieEpisode($movieId);
            $view['episodes'] = $episodes['items'];
            unset($episodes);
            if(is_numeric($episodeId)){
                $view['thisEpisode'] = $this->mEpisode->getEpisode($episodeId);
            }else{
                $view['thisEpisode'] = $this->mEpisode->getEpisode($view['episodes'][0]['episode_id']);
            }
            $view['moviePath'] = 'series/'.$view['thisEpisode']['path'];
        }else{
            $view['moviePath'] = 'movies/'.$view['movie']['path'];
        }
        

        $this->load->view('web/player_mobile',$view);
    }
}