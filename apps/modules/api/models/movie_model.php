<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {
	var $member_id;
	public function __construct(){
		parent::__construct();
		$this->member_id = $this->input->get('member_id');
	}

	public function getMovie($movieID){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.movie_id = ".$movieID." 
				AND m.status = 'ACTIVE' ";
				
		return $this->adodb->GetRow($sql);
	}

	public function getMovies($page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getHotMovies($page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.is_hot = 'YES' 
				AND m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSearchMovie($q,$page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE (m.title LIKE '%".$q."%' OR m.title_en LIKE '%".$q."%')
				AND m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSuggestion($q,$page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE (m.title LIKE '".$q."%' OR m.title_en LIKE '".$q."%')
				AND m.status = 'ACTIVE' ";
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
	public function getCategoryMovie($category_id,$page=1,$limit=30){
		if(is_array($category_id)){
			$category_id = "mc.category_id IN (".implode(',',$category_id).") ";
		}else{
			$category_id = "mc.category_id = '".$category_id."' ";
		}
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie_category','mc')."  
				LEFT JOIN ".$this->table('movie','m')." ON mc.movie_id = m.movie_id
				WHERE ".$category_id." 
				AND m.status = 'ACTIVE'
				ORDER BY m.movie_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */