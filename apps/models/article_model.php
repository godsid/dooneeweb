<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Article_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getArticle($articleID){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE article_id = ".$articleID." 
				AND status = 'ACTIVE'
				";
		return $this->adodb->GetRow($sql);
	}

	public function getNews($page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE type = 'NEWS'
				AND status = 'ACTIVE'
				ORDER BY article_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function getHelp($page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE type = 'HELP'
				AND status = 'ACTIVE'
				ORDER BY article_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */