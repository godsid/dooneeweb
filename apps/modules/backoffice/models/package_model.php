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
	public function getPackageCategory($packageID){
		$sql = "SELECT c.category_id,c.title 
				FROM ".$this->table('package_category','pc')." 
				LEFT JOIN ".$this->table('category','c')." ON pc.category_id = c.category_id
				WHERE pc.package_id = ".$packageID." 
				ORDER BY c.sort ASC
				";
		return $this->adodb->Execute($sql)->GetAll();
	}
	public function setPackageCategory($packageID,$categories){
		$insert = " (".$packageID.", ".implode("),(".$packageID.",",$categories).") ";
		$sql = "INSERT INTO ".$this->table('package_category')." (package_id,category_id)VALUES ".$insert;
		return $this->adodb->Execute($sql);
	}

	public function deletePackageCategory($packageID,$categories){
		$sql = "DELETE FROM ".$this->table('package_category')." WHERE package_id = ".$packageID." AND category_id IN (".implode(',',$categories).") LIMIT ".count($categories)." ";
		return $this->adodb->Execute($sql);
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