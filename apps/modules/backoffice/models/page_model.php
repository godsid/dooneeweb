<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Page_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getPage($pageName){
		$sql = "SELECT * 
				FROM ".$this->table('page')."
				WHERE name = '".$pageName."' ";
		return $this->adodb->GetRow($sql);
	}

	public function updatePage($pageName,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('page'),$data,'UPDATE',"name='".$pageName."'");
	}

}

/* End of file movie_model.php */
/* Location: ./application/models/movie_model.php */