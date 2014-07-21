<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class User_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getUser($userID){
		$sql = "SELECT * 
				FROM ".$this->table('user')."
				WHERE user_id = ".$userID." ";
		return $this->adodb->GetRow($sql);
	}

	public function getUsers($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('user')." 
				ORDER BY user_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function setUser($data){
		$this->adodb->debug=true;
		return $this->adodb->AutoExecute($this->table('user'),$data,'INSERT');
	}

	public function updateUser($user_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('user'),$data,'UPDATE',"user_id='".$user_id."'");
	}

	public function delete($user_id){
		return $this->adodb->AutoExecute($this->table('user'),array('status'=>'INACTIVE'),'UPDATE',"user_id='".$user_id."'");	
	}
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */