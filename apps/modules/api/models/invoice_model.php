<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class invoice_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}
	public function getInvoice($invoiceID){
		$sql = "SELECT * 
					FROM ".$this->table('invoice')." 
					WHERE invoice_id='".$invoiceID."' ";
		return $this->adodb->GetRow($sql);
	}
	public function setInvoice($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		$data['status'] = 'PENDING';
		if($this->adodb->AutoExecute($this->table('invoice'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			error_log($this->adodb->ErrorMsg());
			return false;
		}
	}
	public function updateInvoice($invoiceID,$data){
		$data['resp_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('invoice'),$data,'UPDATE',"invoice_id='".$invoiceID."'");
	}
}