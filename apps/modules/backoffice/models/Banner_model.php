<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class banner_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getBanner($bannerID){
		$sql = "SELECT * 
				FROM ".$this->table('banner')."
				WHERE banner_id = ".$bannerID." ";
		return $this->adodb->GetRow($sql);
	}

	public function getBanners($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('banner')." 
				ORDER BY sort ASC,banner_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function setBanner($data){
		return $this->adodb->AutoExecute($this->table('banner'),$data,'INSERT');
	}

	public function updateBanner($banner_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('banner'),$data,'UPDATE',"banner_id='".$banner_id."'");
	}
	
	public function delete($banner_id){
		return $this->adodb->AutoExecute($this->table('banner'),array('status'=>'INACTIVE'),'UPDATE',"banner_id='".$banner_id."'");	
	}
}

/* End of file banner_model.php */
/* Location: ./application/models/banner_model.php */