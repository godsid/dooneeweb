<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getMovie($movieID){
		$sql = "SELECT * 
				FROM ".$this->table('movie')."
				WHERE movie_id = ".$movieID." ";
		return $this->adodb->GetRow($sql);
	}

	public function getMovies($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				ORDER BY movie_id DESC";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function searchMovies($q,$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('movie')." 
				WHERE title LIKE '%".$q."%' OR title_en LIKE '%".$q."%' 
				ORDER BY movie_id DESC";
		return $this->fetchPage($sql,$page,$limit);	
	}	
	/*public function getMovieCategory($movieID){
		$sql = "SELECT category_id 
				FROM ".$this->table('movie_category')." 
				WHERE movie_id = ".$movieID." 
				";
		return $this->adodb->Execute($sql)->GetAll();
	}*/
	public function getMovieCategory($movieID){
		$sql = "SELECT c.category_id,c.title 
				FROM ".$this->table('movie_category','mc')." 
				LEFT JOIN ".$this->table('category','c')." ON mc.category_id = c.category_id
				WHERE mc.movie_id = ".$movieID." 
				ORDER BY sort ASC
				";
		return $this->adodb->Execute($sql)->GetAll();
	}
	public function setMovie($data){
		return $this->adodb->AutoExecute($this->table('movie'),$data,'INSERT');
	}

	public function setMovieCategory($movieID,$categories){
		$insert = " (".$movieID.", ".implode("),(".$movieID.",",$categories).") ";
		$sql = "INSERT INTO ".$this->table('movie_category')." (movie_id,category_id)VALUES ".$insert;
		return $this->adodb->Execute($sql);
	}

	public function deleteMovieCategory($movieID,$categories){
		$sql = "DELETE FROM ".$this->table('movie_category')." WHERE movie_id = ".$movieID." AND category_id IN (".implode(',',$categories).") LIMIT ".count($categories)." ";
		return $this->adodb->Execute($sql);
	}

	public function updateMovie($movie_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('movie'),$data,'UPDATE',"movie_id='".$movie_id."'");
	}

	public function deleteMovie($movie_id){
		return $this->adodb->Execute("DELETE FROM ".$this->table('movie')." WHERE movie_id = '".$movie_id."' LIMIT 1");
	}

	public function getMovieTags($movieID=""){
		$sql = "SELECT t.tags_id,t.tags_name 
				FROM ".$this->table('movie_tags','mt')." 
				LEFT JOIN ".$this->table('tags','t')." ON mt.tags_id = t.tags_id
				WHERE mt.movie_id = '".$movieID."' 
				";
		return $this->adodb->GetAll($sql);
	}
	public function insertTags($movie_id,$tags_name){
		
	}
	public function deleteTags($tags=""){
		if(is_numeric($tags)){
			$this->adodb->Execute("DELETE FROM ".$this->table('movie_tags')." WHERE id = '".$tags."' LIMIT 1");
		}elseif(is_array($tags)){
			$this->adodb->Execute("DELETE FROM ".$this->table('movie_tags')." WHERE id IN ('".implode(',',$tags)."') LIMIT ".sizeof($tags));
		}

	}
}

/* End of file movie_model.php */
/* Location: ./application/models/movie_model.php */