<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class User_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function auth(){
		$CI = & get_instance();
		$CI->load->library('session');
		$email = $CI->session->userdata('email');
		$permission = $CI->session->userdata('permission');
		if($email&&$permission=='ADMIN'){
			return true;
		}else{
			return false;	
		}
	}

	public function login($username,$password){
		$sql = "SELECT user_id,email,avatar,permission 
				FROM ".$this->table('user')."
				WHERE email='".$username."' 
				AND password=MD5('".$password."')
				AND permission = 'ADMIN' 
				AND status='ACTIVE' ";
		return $this->adodb->GetRow($sql);
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

	public function searchUser($q,$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('user')." 
				WHERE email LIKE '%".$q."%' OR firstname LIKE '%".$q."%' 
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