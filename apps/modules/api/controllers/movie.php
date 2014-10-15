<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');
class Movie extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('api/movie_model','mMovie');
	}

	public function index_get($movieID=""){
		if(is_numeric($movieID)){
			$this->movie($movieID);
		}else{
			$this->movies();
		}
	}

	public function movie($movieID){
		$data = $this->mMovie->getMovie($movieID);
		$this->mMovie->rewiteData($data);
		$this->response($data);
	} 
	public function movies(){
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
}

/* End of file movie.php */
/* Location: ./application/controllers/movie.php */