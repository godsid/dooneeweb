<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {
	public function __construct(){
		parent::__construct();

		public function samsungPrepareCharging($uId,$transactionId,$appId,$cId,$price){
			$sql = "SELECT COUNT(*) 
					FROM ".$this->table('user','u')." 
					LEFT JOIN ".$this->table('movie','m')." ON  m.movie_id = ".$cId." 
					";

			return $this->adodb->GetRow($sql);
		}

		public function insertTransection($data){
			if($sql->adodb->AutoExecute($this->table('do_ss_transection'),$data,'INSERT')){
				return $this->adodb->Insert_ID();
			}else{
				return false;
			}
		}
		public function getTransection(){

		} 
	}
}