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
	public function getCategoriesMenu(){
		$countMovie = "SELECT COUNT(*) 
						FROM ".$this->table('movie_category','mc')." 
						LEFT JOIN ".$this->table('movie','mo')." ON mc.movie_id = mo.movie_id 
						WHERE c.category_id =  mc.category_id 
						AND mo.status = 'ACTIVE' 
						";
		$sql ="SELECT *,(".$countMovie.") movie_item 
				FROM ".$this->table('category','c')." 
				WHERE status = 'ACTIVE'
				AND c.category_id !=27 
				AND c.parent_id != 27 
				ORDER BY sort ASC ,category_id ASC ";
		return $this->adodb->GetAll($sql);		
	}
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */