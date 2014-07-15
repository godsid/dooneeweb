<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getMovie($movieID){
		$sql = "SELECT * 
				FROM ".$this->table('movie')."
				WHERE movie_id = ".$movieID." 
				AND status = 'ACTIVE' ";
				
		return $this->adodb->query($sql);
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