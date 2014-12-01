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
				AND partner = 'DOONEE' 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}

	public function getPackages($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('package')." 
				WHERE status = 'ACTIVE'
				AND partner = 'DOONEE' 
				AND package_id != 5 
				ORDER BY package_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function rewiteData(&$data){
		if(isset($data['banner'])){
			$data['banner'] = static_url($data['banner']);
			
		}else{
			for($i=0,$j=count($data);$i<$j;$i++){
				$data[$i]['banner'] = static_url($data[$i]['banner']);
			}
		}
	}
	public function getMemberPackage($user_id=0){
		$sql =" SELECT p.*,up.expire_date 
				FROM ".$this->table('user_package','up')."
				LEFT JOIN ".$this->table('package','p')." ON up.package_id = p.package_id 
				WHERE up.user_id = '".$user_id."' 
				AND up.status = 'ACTIVE'
				AND expire_date > NOW() 
				AND p.status = 'ACTIVE' 
				ORDER BY up.expire_date DESC";
		return $this->adodb->GetRow($sql);
	}
}

/* End of file package_model.php */
/* Location: ./application/models/package_model.php */