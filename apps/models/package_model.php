<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Package_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getPackage($packageID){
		$sql = "SELECT * 
				FROM ".$this->table('package')."
				WHERE package_id = ".$packageID." 
				AND status = 'ACTIVE'
				";

		return $this->adodb->GetRow($sql);
	}

	public function getPackages($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('package')." 
				WHERE status = 'ACTIVE'
				ORDER BY package_id DESC";
		return $this->adodb->GetAll($sql);
	}

	public function getMemberPackage($user_id){
		$sql =" SELECT p.* 
				FROM ".$this->table('user_package','up')."
				LEFT JOIN ".$this->table('package','p')." ON up.package_id = p.package_id 
				WHERE up.status = 'ACTIVE'
				AND expire_date > NOW() 
				AND p.status = 'ACTIVE' 
				ORDER BY p.package_id DESC";
		return $this->adodb->GetRow($sql);
	}
}

/* End of file package_model.php */
/* Location: ./application/models/package_model.php */