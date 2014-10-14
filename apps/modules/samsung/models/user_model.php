<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class User_model extends ADODB_model {
	public function __construct(){
		parent::__construct();
	}

	public function getUserPackage($user_id=""){
		$sql = "SELECT * 
				FROM ".$this->table('user_package','up')." 
				WHERE user_id = '".$user_id."'
				AND expire_date > '".date('Y-m-d H:i:s')."' ";

		return $this->adodb->GetRow($sql);
	}

	public function getUser($uId=''){
		$sql = "SELECT * 
				FROM ".$this->table('user')." 
				WHERE samsung_id = '".$uId."' 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}
	public function register($uId=''){
		if(!empty($uId)){
			if($this->adodb->AutoExecute($this->table('user'),array(
				'email'=>$uId.'@samsung.com',
				'password'=>md5($uId),
				'firstname'=>'samsung',
				'lastname'=>'samsung',
				'samsung_id'=>$uId,
				'create_date'=>date('Y-m-d H:i:s')
				),'INSERT')){
				return $this->adodb->Insert_ID();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}