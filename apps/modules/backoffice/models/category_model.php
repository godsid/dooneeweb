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
				ORDER BY sort ASC ,category_id ASC ";
		return $this->adodb->GetRow($sql);
	}

	public function getCategories($page=1,$limit=30){
		$sql ="SELECT * 
				FROM ".$this->table('category')." 
				ORDER BY sort ASC ,category_id ASC ";
				
		return $this->fetchPage($sql,$page,$limit);
	}	

	public function getMainCategories($category_id=null){
		$sql = "SELECT * 
				FROM ".$this->table('category')." 
				WHERE parent_id = 0 ";

		return $this->adodb->Execute($sql)->GetAll();
	}

	public function getPackageCategory($category_id){
		$sql = "SELECT cp.category_id, p.package_id, p.title
				FROM ".$this->table('category_package','cp')." 
				WHERE category_id = ".category_id."
				LEFT JOIN  ".$this->table('package','p')." ON cp.package_id = p.package_id
				";
		return $this->adodb->GetAll($sql);
	}

	public function setCategory($data){
		return $this->adodb->AutoExecute($this->table('category'),$data,'INSERT');
	}

	public function updateCategory($category_id,$data){
		$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('category'),$data,'UPDATE',"category_id='".$category_id."'");
	}
	
	public function delete($category_id){
		return $this->adodb->AutoExecute($this->table('category'),array('status'=>'INACTIVE'),'UPDATE',"category_id='".$category_id."'");	
	}
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */