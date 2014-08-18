<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Page_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getPage($pageName){
		$sql = "SELECT * 
				FROM ".$this->table('page')."
				WHERE name = '".$pageName."' 
				AND status = 'ACTIVE'
				";
		return $this->adodb->GetRow($sql);
	}
}

/* End of file page_model.php */
/* Location: ./application/models/page_model.php */