<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	var $breadcrumb;	
	var $page;
	var $limit;

	var $mainCategory;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','mUser');
		if(!$this->mUser->auth()){
			redirect(backoffice_url('/user/login'));
		}
		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Categorys','url'=>backoffice_url('/category'));
		$this->load->model('category_model','mCategory');
		$this->mainCategory = $this->mCategory->getMainCategories();
	}
	
	public function form($pagename){
		$data['category'] = $this->mCategory->getCategory($categoryID);
		$this->breadcrumb[] = array('title'=>$data['category']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('category_detail',$data);
	}
	
	public function form($pageName=""){
		$data['category'] = $this->mCategory->getCategory($categoryID);
		$this->breadcrumb[] = array('title'=>$data['category']['title'],'url'=>backoffice_url('/category/'.$categoryID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['parent'] = $this->mainCategory;
		$this->load->view('category_form',$data);
	}
	public function submit($pageName=""){
		$this->load->library('image_lib');
		$isError = false;
		$category = $this->input->post();

		if(empty($category['title'])){
			$isError = true;
			$category['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		
		$data['category'] = $category;
		unset($category);
		if($isError){
			$this->load->view('category_form',$data);
		}else{
			if(is_numeric($categoryID)){
				$this->mCategory->updateCategory($categoryID,$data['category']);
			}else{
				$categoryID = $this->mCategory->setCategory($data['category']);
			}
			redirect(backoffice_url('/category'));	
		}
	}
}

/* End of file category.php */
/* Location: ./application/modeules/backoffice/controllers/category.php */