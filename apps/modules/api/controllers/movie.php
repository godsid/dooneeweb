<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');
class Movie extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('api/movie_model','mMovie');
	}

	public function index_get($movieID="",$episodeID=""){
		if(is_numeric($movieID)){
			$this->movie($movieID,$episodeID);
		}else{
			$this->movies();
		}
	}

	private function movie($movieID,$episodeID=""){
		$data = array('status'=>false);

		$data['movie'] = $this->mMovie->getMovie($movieID);
		if($data['movie']){
			$data['status'] = true;
			$this->mMovie->rewiteData($data['movie']);
			$data['episode'] = $this->mMovie->getMovieEpisode($movieID,$episodeID);
			$data['episode'] = $data['episode']['items'];
			$this->mMovie->rewriteEpisode($data['episode'],$data['movie']);

		}else{
			$data['status'] = false;
		}
		
		$this->response($data);

	} 
	private function movies(){
		$data = $this->mMovie->getMovies($this->page,$this->limit);
		$this->mMovie->rewiteData($data['items']);
		$this->response($data);
	}
	public function hot_get(){
		$data = $this->mMovie->getHotMovies($this->page,$this->limit);
		$this->mMovie->rewiteData($data['items']);
		$this->response($data);
	}

	public function search_get(){
		$q = $this->input->get('q');
		$data = $this->mMovie->getSearchMovie($q,$this->page,$this->limit);
		$this->mMovie->rewiteData($data['items']);
		$this->response($data);
	}

	public function suggestion_get(){
		$q = $this->input->get('q');
		$data = $this->mMovie->getSuggestion($q,$this->page,$this->limit);
		$this->mMovie->rewiteData($data['items']);
		$this->response($data);
	}

	public function category_get($category_id){
		$data = $this->mMovie->getCategoryMovie($category_id,$this->page,$this->limit);
		$this->mMovie->rewiteData($data['items']);
		$this->response($data);
	}

	public function episode_get($movie_id=""){
		$data = array('status'=>false);

		$data['movie'] = $this->mMovie->getMovie($movie_id);
		if($data['movie']){
			$data['status'] = true;
			$this->mMovie->rewiteData($data['movie']);
			$data['episode'] = $this->mMovie->getMovieEpisode($movie_id);
			$data['episode'] = $data['episode']['items'];
			$this->mMovie->rewriteEpisode($data['episode'],$data['movie']);

		}else{
			$data['status'] = false;
		}
		
		$this->response($data);
	}
}

/* End of file movie.php */
/* Location: ./application/controllers/movie.php */