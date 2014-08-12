<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	var $breadcrumb;	
	var $page;
	var $limit;

	var $mainCategory;
	public function __construct(){
		parent::__construct();

		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Categorys','url'=>backoffice_url('/category'));
		$this->load->model('category_model','mCategory');
		$this->mainCategory = $this->mCategory->getMainCategories();
	}

	public function index($categoryID=""){
		if($categoryID){
			$this->detail($categoryID);
		}else{
			$data['breadcrumb'] = $this->breadcrumb;

			$data['categories'] = $this->mCategory->getCategories($this->page,$this->limit);
			$data['categories']['pageing']['url'] = backoffice_url('/category');
			$data['pageing'] = $this->load->view('pageing',$data['categories']['pageing'],true);
			$this->load->view('category',$data);	
		}
		
	}
	public function detail($categoryID=""){
		$data['category'] = $this->mCategory->getCategory($categoryID);
		$this->breadcrumb[] = array('title'=>$data['category']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('category_detail',$data);
	}
	public function create(){
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['parent'] = $this->mainCategory;
		$this->load->view('category_form',$data);
	}
	public function edit($categoryID=""){
		$this->load->model('package_model','mPackage');
		$data['category'] = $this->mCategory->getCategory($categoryID);
		$data['category']['packages'] = $this->mCategory->getPackageCategory($categoryID);
		$data['packages'] = $this->mPackage->getPackages();
		$data['packages'] = $data['packages']['items'];
		$tmpDataPackage = array();
		for($i=0,$j=count($data['packages']);$i<$j;$i++){
			$tmpDataPackage[$data['packages'][$i]['package_id']] = $data['packages'][$i];
		}
		$data['packages'] = $tmpDataPackage;
		unset($tmpDataPackage);
		$this->breadcrumb[] = array('title'=>$data['category']['title'],'url'=>backoffice_url('/category/'.$categoryID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['parent'] = $this->mainCategory;
		$this->load->view('category_form',$data);
	}
	public function submit($categoryID=false){
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
	public function submitSort(){
		$sort = $this->input->post('sort');
		for($i=0,$j=count($sort['category_id']);$i<$j;$i++){
			$this->mCategory->updateCategory($sort['category_id'][$i],array('sort'=>$sort['order'][$i]));
		
			
		}
		redirect(backoffice_url('/category'));
		
	}
	public function active($categoryID){
		if(is_numeric($categoryID)){
			$this->mCategory->updateCategory($categoryID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/category'));
	}
	public function inactive($categoryID){
		if(is_numeric($categoryID)){
			$this->mCategory->updateCategory($categoryID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/category'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('category_form',$data);
	}
}

/* End of file category.php */
/* Location: ./application/modeules/backoffice/controllers/category.php */