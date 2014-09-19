<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Payment_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}
	
	public function checkTransection($transection,$uId,$cId,$price){
		$sql = "SELECT * 
				FROM ".$this->table('ss_transection')."
				WHERE transactionId = '".$transection."' 
				AND uId = '".$uId."'
				AND command = 'prepareCharging' 
				AND cId = '".$cId."' 
				AND price = ".$price." ";
		return $this->adodb->GetRow($sql);
	}

	public function insertTransection($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		if($this->adodb->AutoExecute($this->table('ss_transection'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}
	public function updateTransection($transactionId,$data){
		$data['update_date'] = date('Y-m-d H:i:s');

		if($this->adodb->AutoExecute($this->table('ss_transection'),$data,'UPDATE',"transactionId='".$transactionId."'")){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}	
	} 

	public function log($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		$this->adodb->AutoExecute($this->table('ss_transection_log'),$data,'INSERT');
	}
	
}