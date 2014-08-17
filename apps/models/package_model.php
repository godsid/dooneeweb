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
}

/* End of file package_model.php */
/* Location: ./application/models/package_model.php */