<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Package_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getPackage($packageID){
		$sql = "SELECT * 
				FROM ".$this->table('package')."
				WHERE package_id = ".$packageID." ";
		return $this->adodb->GetRow($sql);
	}

	public function getPackages($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('package')." 
				ORDER BY package_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function setPackage($data){
		return $this->adodb->AutoExecute($this->table('package'),$data,'INSERT');
	}

	public function updatePackage($package_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('package'),$data,'UPDATE',"package_id='".$package_id."'");
	}
	
	public function delete($package_id){
		return $this->adodb->AutoExecute($this->table('package'),array('status'=>'INACTIVE'),'UPDATE',"package_id='".$package_id."'");	
	}
}

/* End of file package_model.php */
/* Location: ./application/models/package_model.php */