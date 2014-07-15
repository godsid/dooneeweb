<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends ADODB_model {

	public function __construct()
	{
		parent::__construct();
		$this->adodb->Execute("SELECT 1 AS row");
	}

	public function getMovie($movieID){
		$sql = "SELECT * 
				FROM ".$this->table('movie')."
				WHERE movie_id = ".$movieID." 
				AND status = 'ACTIVE' ";
				
		return $this->db->query($sql);		
	}

	public function getMoviews($page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE status = 'ACTIVE' ";

	}

	public function getHotMoview(){

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */