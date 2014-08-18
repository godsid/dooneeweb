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

		$this->load->model('category_model','mCategory');
		$this->load->model('page_model','mPage');
		$this->mainCategory = $this->mCategory->getMainCategories();
	}
	
	public function form($pageName="",$success=''){

		$data['page'] = $this->mPage->getPage($pageName);
		$this->breadcrumb[] = array('title'=>$data['page']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['page']['pagename'] = $pageName;
		if($success=='success'){
			$data['page']['success'] = "success";
		}
		$this->load->view('page_form',$data);
	}
	
	public function submit($pageName=""){
		$isError = false;
		$page = $this->input->post();

		if(empty($page['description'])){
			$isError = true;
			$category['description_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		$data['page'] = $page;
		$data['page']['pagename'] = $pageName;
		
		unset($page);
		if($isError){
			$this->load->view('page_form',$data);
		}else{
			if($pageName){
				$this->mPage->updatePage($pageName,$data['page']);
			}else{
				$pageID = $this->mPage->setPage($data['page']);
			}
			redirect(backoffice_url('/page/form/'.$pageName.'/success'));	
		}
	}
}

/* End of file category.php */
/* Location: ./application/modeules/backoffice/controllers/category.php */