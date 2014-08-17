<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Category_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getCategory($categoryID){
		$sql = "SELECT * 
				FROM ".$this->table('category')."
				WHERE category_id = ".$categoryID." 
				AND status = 'ACTIVE' 
				ORDER BY sort ASC ,category_id ASC ";
		return $this->adodb->GetRow($sql);
	}

	public function getCategories($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('category')." 
				WHERE status = 'ACTIVE' 
				ORDER BY sort ASC ,category_id ASC ";
				
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function getMainCategories($category_id=null){
		$sql = "SELECT * 
				FROM ".$this->table('category')." 
				WHERE parent_id = 0 
				AND status = 'ACTIVE' 
				ORDER BY sort ASC ,category_id ASC ";

		return $this->adodb->Execute($sql)->GetAll();
	}
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */