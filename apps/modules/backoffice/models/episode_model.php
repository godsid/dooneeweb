<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Episode_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getEpisode($episodeID){
		$sql = "SELECT * 
				FROM ".$this->table('episode')."
				WHERE episode_id = ".$episodeID." ";
		return $this->adodb->GetRow($sql);
	}

	public function getEpisodes($movieID="",$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('episode')." 
				WHERE movie_id = '".$movieID."'
				ORDER BY title ASC ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function searchEpisode($q,$page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('episode')." 
				WHERE title LIKE '%".$q."%'  
				ORDER BY episode_id DESC";
		return $this->fetchPage($sql,$page,$limit);	
	}	

	public function setEpisode($data){
		header('Content-type: Application/json; Charset:utf8');
		if($this->adodb->AutoExecute($this->table('episode'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}

	public function deleteEpisode($episode_id){
		return $this->adodb->Execute("DELETE FROM ".$this->table('episode')." WHERE episode_id = '".$episode_id."' LIMIT 1");
	}
	public function updateEpisode($episode_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('episode'),$data,'UPDATE',"episode_id='".$episode_id."'");
	}



}

/* End of file movie_model.php */
/* Location: ./application/models/movie_model.php */