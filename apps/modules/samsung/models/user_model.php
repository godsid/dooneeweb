<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class User_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}

	public function getUser($uId=''){
		$sql = "SELECT * 
				FROM ".$this->table('user')." 
				WHERE samsung_id = '".$uId."' 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);

	}
}