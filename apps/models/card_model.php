<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Card_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}
	public function getCard($code){
		$sql = "SELECT * 
				FROM ".$this->table('prepaidcard')."
				WHERE code = '".$code."' ";
		return $this->adodb->GetRow($sql);
	}

	public function updateCard($serialNumber,$data){
		//$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('prepaidcard'),$data,'UPDATE',"serial_number='".$serialNumber."'");
	}

	public function insertCardLog($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('prepaidcard_log'),$data,'INSERT');

	}
}

/* End of file banner_model.php */
/* Location: ./application/models/banner_model.php */