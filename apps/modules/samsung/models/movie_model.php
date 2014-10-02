<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {
	var $samsung_category;
	public function __construct(){
		parent::__construct();
		$this->samsung_category = "28";
	}

	public function getMovie($movieID){
		$sql = "SELECT * 
				FROM ".$this->table('movie')."
				WHERE movie_id = ".$movieID." 
				AND status = 'ACTIVE' ";
				
		return $this->adodb->GetRow($sql);
	}
	public function getMovies($page,$limit){
		$sql ="SELECT m.* 
				FROM ".$this->table('movie','m')."
				LEFT JOIN ".$this->table('movie_category', 'mc')." ON m.movie_id = mc.movie_id
				WHERE mc.category_id IN (".$this->samsung_category.") 
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function getMovieCount(){
		$sql = "SELECT COUNT(*) row
				FROM ".$this->table('movie')."
				WHERE status = 'ACTIVE' ";
		$result = $this->adodb->GetRow($sql);
		return $result['row'];
	}
	
	public function getMoviesFree($page,$limit){
		$sql ="SELECT m.* 
				FROM ".$this->table('movie','m')."
				LEFT JOIN ".$this->table('movie_category', 'mc')." ON m.movie_id = mc.movie_id
				WHERE mc.category_id IN (".$this->samsung_category.") 
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getHotMovies($page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')."
				WHERE is_hot = 'YES' 
				AND status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function getMoviesHotFirst($page,$limit){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE status = 'ACTIVE' 
				ORDER BY (is_hot ='YES') DESC ,movie_id DESC ";
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
	public function getMovieEpisode($movieID="",$page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('episode')."
				WHERE movie_id = '".$movieID."'
				AND status = 'ACTIVE' 
				ORDER BY title ASC ";
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