<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Banner_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}

	public function getBanner($bannerID=false){
		$sql = "SELECT * 
				FROM ".$this->table('banner')." 
				WHERE banner_id = ".$bannerID." 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}
	public function getBanners($page,$limit){
		$sql = "SELECT * 
				FROM ".$this->table('banner')." 
				WHERE status = 'ACTIVE' ";
		return $this->adodb->GetAll($sql);
	}
	public function rewiteData(&$data){
		if(isset($data['cover'])){
			$data['cover'] = static_url($data['cover']);
			
		}else{
			for($i=0,$j=count($data);$i<$j;$i++){
				$data[$i]['cover'] = static_url($data[$i]['cover']);
			}
		}
	}
}

/* End of file banner_model.php */
/* Location: ./application/model/banner_model.php */