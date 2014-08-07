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
				
		return $this->adodb->GetRow($sql);
	}

	public function getMovies($page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getHotMovies($page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE is_hot = 'YES' 
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSearchMovie($q,$page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE (title LIKE '%".$q."%' OR title_en LIKE '%".$q."%')
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSuggestion($q,$page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE (title LIKE '".$q."%' OR title_en LIKE '".$q."%')
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function rewiteData(&$data){
		if(isset($data['cover'])){
			$data['cover'] = static_url($data['cover']);
			
		}else{
			for($i=0,$j=count($data);$i<$j;$i++){
				$data[$i]['cover'] = static_url($data[$i]['cover']);
			}
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */