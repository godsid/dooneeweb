<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');
class Movie extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('movie_model','mMovie');
	}

	public function index_get($movieID=""){
		
		$this->mMovie->getMovie($movieID);
		$this->response(array(), 200);
	}
}

/* End of file movie.php */
/* Location: ./application/controllers/movie.php */