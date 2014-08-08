<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {

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

		$this->breadcrumb[] = array('title'=>'Banners','url'=>backoffice_url('/banner'));
		$this->load->model('banner_model','mBanner');
	}

	public function index($bannerID=""){
		if($bannerID){
			$this->detail($bannerID);
		}else{
			$data['breadcrumb'] = $this->breadcrumb;

			$data['banners'] = $this->mBanner->getBanners($this->page,$this->limit);
			$data['banners']['pageing']['url'] = backoffice_url('/banner');
			$data['pageing'] = $this->load->view('pageing',$data['banners']['pageing'],true);
			$this->load->view('banner',$data);	
		}
		
	}
	public function detail($bannerID=""){
		$data['banner'] = $this->mBanner->getBanner($bannerID);
		$this->breadcrumb[] = array('title'=>$data['banner']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('banner_detail',$data);
	}
	public function create(){
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('banner_form',$data);
	}
	public function edit($bannerID=""){
		$data['banner'] = $this->mBanner->getBanner($bannerID);
		$this->breadcrumb[] = array('title'=>$data['banner']['title'],'url'=>backoffice_url('/banner/'.$bannerID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('banner_form',$data);
	}
	public function submit($bannerID=false){
		$this->load->library('image_lib');
		$isError = false;
		$banner = $this->input->post();

		if(empty($banner['title'])){
			$isError = true;
			$banner['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(isset($_FILES["cover"])&&!empty($_FILES["cover"]['tmp_name'])){
		
				$destinationPath = static_path('cover'.substr(md5(time()),0,5).".jpg");
				if(move_uploaded_file($_FILES['cover']['tmp_name'],$destinationPath)){
					$imageSize = $this->config->item('banner_banner');
					$config["source_image"] = $destinationPath;
		            $config['new_image'] = $destinationPath;
		            $config["width"] = $imageSize['large'][0];
		            $config["height"] = $imageSize['large'][1];
		            $config["dynamic_output"] = FALSE; // always save as cache
		            
					$this->image_lib->initialize($config);
		            $this->image_lib->fit();
		            unlink(preg_replace("#.*".$this->config->item('static_path')."#",$this->config->item('static_path'),$banner['cover_tmp']));
		            $banner['cover'] = '/'.$destinationPath;
				}
				
			//}
		}
		$data['banner'] = $banner;
		unset($banner);
		if($isError){
			$this->load->view('banner_form',$data);
		}else{
			if(is_numeric($bannerID)){
				$this->mBanner->updateBanner($bannerID,$data['banner']);
			}else{
				$bannerID = $this->mBanner->setBanner($data['banner']);
			}
			redirect(backoffice_url('/banner'));	
		}
	}
	
	public function active($bannerID){
		if(is_numeric($bannerID)){
			$this->mBanner->updateBanner($bannerID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/banner'));
	}
	public function inactive($bannerID){
		if(is_numeric($bannerID)){
			$this->mBanner->updateBanner($bannerID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/banner'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('banner_form',$data);
	}
}

/* End of file banner.php */
/* Location: ./application/modeules/backoffice/controllers/banner.php */