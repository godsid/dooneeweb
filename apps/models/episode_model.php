<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Episode_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getEpisode($episodeID=""){
		$sql ="SELECT * 
				FROM ".$this->table('episode')." 
				WHERE episode_id = '".$episodeID."' 
				" ;
		return $this->adodb->GetRow($sql);
	}

	public function getAllEpisode(){
		$sql = "SELECT * 
				FROM ".$this->table('episode')." 
				 ";
		return $this->adodb->GetAll($sql);
	}
}


?>