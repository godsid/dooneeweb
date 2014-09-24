<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Prepaid_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getPrepaid($serialNumber){
		$sql = "SELECT * 
				FROM ".$this->table('prepaidcard')."
				WHERE serial_number = ".$serialNumber." ";
		return $this->adodb->GetRow($sql);
	}

	public function getPrepaids($page=1,$limit=30){
		$sql ="SELECT pr.*,us.email,pa.title 
				FROM ".$this->table('prepaidcard','pr')."
				LEFT JOIN ".$this->table('user','us')." 
					ON us.user_id = pr.user_id 
				LEFT JOIN ".$this->table('package','pa')." 
					ON pa.package_id = pr.package_id 
				ORDER BY create_date DESC";
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function setPrepaid($data){
		try{
			$data['create_date'] = date('Y-m-d H:i:s');
			return $this->adodb->AutoExecute($this->table('prepaidcard'),$data,'INSERT');
		}catch(Exception $e){
			return false;
		}	
	}

	public function updatePrepaid($serialNumber,$data){
		//$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('prepaidcard'),$data,'UPDATE',"banner_id='".$banner_id."'");
	}
	
	public function delete($serialNumber){
		return $this->adodb->AutoExecute($this->table('prepaidcard'),array('status'=>'INACTIVE'),'UPDATE',"banner_id='".$banner_id."'");	
	}
}

/* End of file banner_model.php */
/* Location: ./application/models/banner_model.php */