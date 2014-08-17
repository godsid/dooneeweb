<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'libraries/REST_Controller.php');
class Home extends REST_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index_get()
	{
		$this->load->model('api/movie_model','mMovie');
		$this->load->model('api/banner_model','mBanner');
		$data = array();
		$data['banner']['items'] = $this->mBanner->getBanners(1,5);
		$this->mBanner->rewiteData($data['banner']['items']);
		$data['movieHot'] = $this->mMovie->getHotMovies(1,20);
		unset($data['movieHot']['pageing']);
		$this->mMovie->rewiteData($data['movieHot']['items']);
		$data['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
		$this->mMovie->rewiteData($data['movies']['items']);
		
		$this->response($data);
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */