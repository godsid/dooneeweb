<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Package_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}


	public function getPackageByName($packageName){
		$sql = "SELECT * 
				FROM ".$this->table('package')."
				WHERE name='".$packageName."' 
				AND status = 'ACTIVE' ";

		return $this->adodb->GetRow($sql);
	}
	public function getPackagePartner($partner=''){
		$sql = "SELECT * 
				FROM ".$this->table('package')." 
				WHERE partner = '".$partner."' 
				AND price > 0 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetAll($sql);
	}
	public function setUserpackage($data){
		
		if($this->adodb->AutoExecute($this->table('user_package'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}

}