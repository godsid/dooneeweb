<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class invoice_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function setInvoice($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		$data['status'] = 'PENDING';
		if($this->adodb->AutoExecute($this->table('invoice'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}
}