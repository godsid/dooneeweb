<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

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
		$this->load->model('article_model','mArticle');
		$this->mainCategory = $this->mCategory->getMainCategories();
	}	

	public function news(){
		$view['articles'] = $this->mArticle->getNews($this->page,$this->limit);
		$view['articles']['pageing']['url'] = backoffice_url('/article/news');
		$view['pageing'] = $this->load->view('pageing',$view['articles']['pageing'],true);
		$this->load->view('article',$view);
	}

	public function help(){
		$view['articles'] = $this->mArticle->getHelp($this->page,$this->limit);
		$view['articles']['pageing']['url'] = backoffice_url('/article/help');
		$view['pageing'] = $this->load->view('pageing',$view['articles']['pageing'],true);
		$this->load->view('article',$view);
	}

	public function active($type='',$articleID=''){
		if(is_numeric($articleID)){
			$this->mArticle->updateArticle($articleID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/article/'.$type));
	}
	public function inactive($type='',$articleID=''){
		if(is_numeric($articleID)){
			$this->mArticle->updateArticle($articleID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/article/'.$type));
	}

	public function create($type="",$articleID="",$success=''){
		$this->breadcrumb[] = array('title'=>(($this->uri->segment(3)=='news')?"ข่าว/โปรโมชั่น":"วิธีการรับชม"),'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		//$data['page']['pagename'] = $type;
		if($success=='success'){
			$data['page']['success'] = "success";
		}
		$this->load->view('article_form',$data);
	}
	public function edit($type="",$articleID="",$success=""){
		$this->breadcrumb[] = array('title'=>(($this->uri->segment(3)=='news')?"ข่าว/โปรโมชั่น":"วิธีการรับชม"),'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['article'] = $this->mArticle->getArticle($articleID);
		if($success=='success'){
			$data['page']['success'] = "success";
		}
		$this->load->view('article_form',$data);
	}
	
	public function submit($type="",$articleID=''){
		$this->load->library('image_lib');
		$isError = false;
		$article = $this->input->post();

		if(empty($page['description'])){
			$isError = true;
			$category['description_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		$data['article'] = $article;
		$data['article']['type'] = $type;
		
		if(isset($_FILES["cover"])&&!empty($_FILES["cover"]['tmp_name'])){
			//if($_FILES['cover']['error']){
				//var_dump($_FILES);
				//$isError = true;
				//$movie['cover_error'] = $_FILES['cover']['error'];
			//}else{
				$destinationPath = static_path('article/'.substr(md5(time()),0,5).".jpg");
				if(move_uploaded_file($_FILES['cover']['tmp_name'],$destinationPath)){
					$imageSize = $this->config->item('article');
					$config["source_image"] = $destinationPath;
		            $config['new_image'] = $destinationPath;
		            $config["width"] = $imageSize['small'][0];
		            $config["height"] = $imageSize['small'][1];
		            $config["dynamic_output"] = FALSE; // always save as cache
		            
					$this->image_lib->initialize($config);
		            $this->image_lib->fit();
		            if(isset($article['cover_tmp'])){
		            	unlink(preg_replace("#.*".$this->config->item('static_path')."#",$this->config->item('static_path'),$article['cover_tmp']));	
		            }
		            $data['article']['cover'] = '/'.$destinationPath;
				}
				
			//}
		}
		
		unset($article);
		//if($isError){
		//	$this->load->view('article_form',$data);
		//}else{
			if($articleID){
				$this->mArticle->updateArticle($articleID,$data['article']);
			}else{
				$articleID = $this->mArticle->setArticle($data['article']);
			}
			redirect(backoffice_url('/article/'.$type.'/'));	
		//}
	}
}

/* End of file category.php */
/* Location: ./application/modeules/backoffice/controllers/category.php */