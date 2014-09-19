<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
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

		$this->breadcrumb[] = array('title'=>'Packages','url'=>backoffice_url('/package'));
		$this->load->model('package_model','mPackage');

	}

	public function index($packageID=""){
		if($packageID){
			$this->detail($packageID);
		}else{
			$data['breadcrumb'] = $this->breadcrumb;

			$data['packages'] = $this->mPackage->getPackages($this->page,$this->limit);
			$data['packages']['pageing']['url'] = backoffice_url('/package');
			$data['pageing'] = $this->load->view('pageing',$data['packages']['pageing'],true);
			$this->load->view('package',$data);	
		}
		
	}
	public function detail($packageID=""){
		$data['package'] = $this->mPackage->getPackage($packageID);		
		$this->breadcrumb[] = array('title'=>$data['package']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_detail',$data);
	}
	public function create(){
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['package']['category'] = array();
		$data['package']['partners'] = explode(',',$this->config->item('package_partner'));
		$this->load->view('package_form',$data);
	}
	public function edit($packageID=""){
		$this->load->model('category_model','mCategory');
		$data['categories'] = $this->mCategory->getCategories();
		$data['categories'] = $data['categories']['items'];

		$data['package'] = $this->mPackage->getPackage($packageID);
		$cateArray = $this->mPackage->getPackageCategory($packageID);
		$data['package']['category'] = array();
		foreach($cateArray as $cateID){
			$data['package']['category'][] = $cateID['category_id'];
		}
		$data['package']['partners'] = explode(',',$this->config->item('package_partner'));
		$this->breadcrumb[] = array('title'=>$data['package']['title'],'url'=>backoffice_url('/package/'.$packageID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_form',$data);
	}
	public function submit($packageID=false){
		$this->load->library('image_lib');
		$isError = false;
		$package = $this->input->post();

		if(empty($package['title'])){
			$isError = true;
			$package['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(empty($package['name'])){
			$isError = true;
			$package['name_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(isset($_FILES["banner"])&&!empty($_FILES["banner"]['tmp_name'])){
			//if($_FILES['cover']['error']){
				//var_dump($_FILES);
				//$isError = true;
				//$movie['cover_error'] = $_FILES['cover']['error'];
			//}else{
				$destinationPath = static_path('package'.substr(md5(time()),0,5).".jpg");
				if(move_uploaded_file($_FILES['banner']['tmp_name'],$destinationPath)){
					$imageSize = $this->config->item('package_banner');
					$config["source_image"] = $destinationPath;
		            $config['new_image'] = $destinationPath;
		            $config["width"] = $imageSize['large'][0];
		            $config["height"] = $imageSize['large'][1];
		            $config["dynamic_output"] = FALSE; // always save as cache
		            
					$this->image_lib->initialize($config);
		            $this->image_lib->fit();
		            unlink(preg_replace("#.*".$this->config->item('static_path')."#",$this->config->item('static_path'),$package['banner_tmp']));
		            $package['banner'] = '/'.$destinationPath;
				}
				
			//}
		}
		$data['package'] = $package;
		unset($package);
		if($isError){
			$this->load->view('package_form',$data);
		}else{
			if(is_numeric($packageID)){
				$this->mPackage->updatePackage($packageID,$data['package']);
			}else{
				$packageID = $this->mPackage->setPackage($data['package']);
			}

			$category_tmp = explode(',',$this->input->post('category_tmp'));
			$category = $this->input->post('category');
			
			$deleteCategory = array_diff($category_tmp,$category);
			$addCategory = array_diff($category,$category_tmp);

			if(is_array($addCategory)&&count($addCategory)){
				$this->mPackage->setPackageCategory($packageID,$addCategory);
			}
			if(is_array($deleteCategory)&&count($deleteCategory)){
				$this->mPackage->deletePackageCategory($packageID,$deleteCategory);
			}

			redirect(backoffice_url('/package'));	
		}
	}
	
	public function active($packageID){
		if(is_numeric($packageID)){
			$this->mPackage->updatePackage($packageID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/package'));
	}
	public function inactive($packageID){
		if(is_numeric($packageID)){
			$this->mPackage->updatePackage($packageID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/package'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_form',$data);
	}
}

/* End of file package.php */
/* Location: ./application/modeules/backoffice/controllers/package.php */