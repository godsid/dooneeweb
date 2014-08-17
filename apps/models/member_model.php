<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Member_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function auth(){
		$CI = & get_instance();
		$CI->load->library('session');
		$email = $CI->session->userdata('user_data');
		if($email){
			return true;
		}else{
			return false;	
		}
	}
	public function getMemberLogin(){
		$CI = & get_instance();
		$CI->load->library('session');
		$user = $CI->session->userdata('user_data');
		return $user;
	}
	public function login($email,$password){
		$sql = "SELECT user_id,email,avatar,firstname,lastname,0 as dayLeft 
				FROM ".$this->table('user')." 
				WHERE email='".$email."' 
				AND password='".$password."' 
				AND status = 'ACTIVE' 
				";
		return $this->adodb->GetRow($sql);
	}
	public function getMember($memberID){
		$sql = "SELECT * 
				FROM ".$this->table('user')."
				WHERE movie_id = ".$movieID." 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}
	public function setMember($data){
		$data['date_create'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('user'),$data,'INSERT');
	}
	public function isDuplicateEmail($email){
		
		$sql = "SELECT count(*) AS count
				FROM ".$this->table('user')."
				WHERE email = '".$email."'
				";
		$result = $this->adodb->GetRow($sql);
		if($result['count']){
			return true;
		}else{
			return false;
		}
	}
	
	/*

	public function getMovies($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE status = 'ACTIVE'
				ORDER BY movie_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function getMoviesHot($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE status = 'ACTIVE'
				ORDER BY movie_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getMovieRelate($movieID,$limit=3){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE status = 'ACTIVE' 
				ORDER BY movie_id DESC 
				LIMIT ".$limit." 
				";
		return $this->adodb->GetAll($sql);
	}
	public function getMoviesLetter($q,$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE (title LIKE '".$q."%' OR title_en LIKE '".$q."%' )
				AND status = 'ACTIVE'
				ORDER BY movie_id DESC";
		return $this->fetchPage($sql,$page,$limit);	
	}
	public function searchMovies($q,$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE (title LIKE '%".$q."%' OR title_en LIKE '%".$q."%' )
				AND status = 'ACTIVE'
				ORDER BY movie_id DESC";
		return $this->fetchPage($sql,$page,$limit);	
	}

	

	public function updateMovie($movie_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('movie'),$data,'UPDATE',"movie_id='".$movie_id."'");
	}

	public function delete($movie_id){
		return $this->adodb->AutoExecute($this->table('movie'),array('status'=>'INACTIVE'),'UPDATE',"movie_id='".$movie_id."'");	
	}
	*/
}

/* End of file movie_model.php */
/* Location: ./application/models/movie_model.php */