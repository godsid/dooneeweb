<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class News_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getNewsOnce($newsID){
		$sql = "SELECT * 
				FROM ".$this->table('news')."
				WHERE news_id = ".$newsID." 
				AND status = 'ACTIVE'
				";
		return $this->adodb->GetRow($sql);
	}

	public function getNews($page=1,$limit=30){
		$sql = "SELECT * 
				FROM ".$this->table('news')."
				WHERE status = 'ACTIVE'
				ORDER BY news_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */