<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Article_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}
	public function getArticle($articleID){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE article_id = '".$articleID."' ";
		return $this->adodb->GetRow($sql);
	}
	public function getNews($page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE type = 'NEWS' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function getHelp($page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('article')."
				WHERE type = 'HELP' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function setArticle($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('article'),$data,'INSERT');
	}
	public function updateArticle($articleID,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('article'),$data,'UPDATE',"article_id='".$articleID."'");
	}

}

/* End of file movie_model.php */
/* Location: ./application/models/movie_model.php */