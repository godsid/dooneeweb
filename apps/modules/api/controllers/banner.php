<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'libraries/REST_Controller.php');
class Banner extends REST_Controller {

	public function index_get($bannerID = false){
		$this->load->model('banner_model','mBanner');

		$items = $this->mBanner->getBanner($bannerID);
		$this->response($items, 200);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */