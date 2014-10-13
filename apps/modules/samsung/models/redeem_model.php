<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Redeem_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}

	public function getRedeem($redeemCode){
		$sql = "SELECT * 
				FROM ".$this->table('ss_redeem')."
				WHERE code = ".$redeemCode." 
				AND uid = '' ";
				
		return $this->adodb->GetRow($sql);
	}
	public function updateRedeem($redeemCode,$data){
		return $this->adodb->AutoExecute($this->table('ss_redeem'),$data,'UPDATE',"code='".$redeemCode."'");
	}
}