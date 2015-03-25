<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'libraries/REST_Controller.php');
class Init extends REST_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index_get(){

		$this->getSetting();
		
	}

	private function getCategory(){
		
	} 
	private function getSetting(){
		$this->load->model('api/category_model','mCategory');
		$this->load->model('api/package_model','mPackage');

		$data = array();
		$data['settings'] = array(
								'iosinapp'=>true,
								'iosCreditCard'=>true,
								'iosPrepaid'=>true,
								'iosFacebookAuth'=>true,

								'androidInApp'=>false,
								'androidCreditCard'=>true,
								'androidPrepaid'=>true,
								'checkCountry'=>true,
								'countryAllow'=>$this->checkAllowCountry()
								);
		$data['categories'] = $this->mCategory->getCategoriesMenu();
		unset($data['categories']['pageing']);
		$data['package'] = $this->mPackage->getPackages();
		$this->mPackage->rewiteData($data['package']['items']);
		unset($data['package']['pageing']);
		$this->response($data);
	}

	private function checkAllowCountry(){
		if($this->get('xxxx')){
			return false;
		}
		
		if($this->geoip_lib->InfoIP($this->input->ip_address())){
            $country_code = $this->geoip_lib->result_country_code();
            if(($country_code =="TH")){
            	return true;
            }
        }
		return false;
	}
}

/* End of file init.php */
/* Location: ./application/controllers/init.php */