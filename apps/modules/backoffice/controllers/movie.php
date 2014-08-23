<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

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

		$this->breadcrumb[] = array('title'=>'Movies','url'=>backoffice_url('/movie'));
		$this->load->model('movie_model','mMovie');

	}

	public function index($movieID=""){
		
		if($movieID){
			$data['movie'] = $this->mMovie->getMovie($movieID);
			$data['movie']['category'] = $this->mMovie->getMovieCategory($movieID);

			$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>'');
			$data['breadcrumb'] = $this->breadcrumb;	
			$data['movie']['path'] = str_replace('{path}',$data['movie']['path'],$this->config->item('clip_path'));
			$this->load->view('movie_detail',$data);
		}else{
			$data['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
			$data['movies']['pageing']['url'] = backoffice_url('/movie');
			$data['pageing'] = $this->load->view('pageing',$data['movies']['pageing'],true);
			$data['breadcrumb'] = $this->breadcrumb;
			$this->load->view('movie',$data);
		}
	}
	public function search(){
		$q = $this->input->get('q');
		$data['movies'] = $this->mMovie->searchMovies($q,$this->page,$this->limit);
		$data['movies']['pageing']['url'] = backoffice_url('/movie/search?q='.$q);
		$data['pageing'] = $this->load->view('pageing',$data['movies']['pageing'],true);
		$data['q'] = $q;
		$this->breadcrumb[] = array('title'=>'Search','url'=>backoffice_url('/movie/search/?q='.$q));
		$this->breadcrumb[] = array('title'=>$q);
		$data['breadcrumb'] = $this->breadcrumb;

		$this->load->view('movie',$data);
	}

	public function edit($movieID=""){
		$this->load->model('category_model','mCategry');
		$this->load->model('episode_model','mEpisode');

		$data['categories'] = $this->mCategry->getCategories();
		$data['categories'] = $data['categories']['items'];
		
		$data['movie'] = $this->mMovie->getMovie($movieID);
		$cateArray = $this->mMovie->getMovieCategory($movieID);
		$data['movie']['category'] = array();
		foreach($cateArray as $cateID){
			$data['movie']['category'][] = $cateID['category_id'];
		}

		if($data['movie']['is_series']=='YES'){
			$data['movie']['episodes'] = $this->mEpisode->getEpisodes($data['movie']['movie_id']);
		}
		
		$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>backoffice_url('/movie/'.$movieID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/movie/edit/'.$movieID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
	public function create(){
		$this->load->model('category_model','mCategry');
		$data['categories'] = $this->mCategry->getCategories();
		$data['categories'] = $data['categories']['items'];
		
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['movie']['category'] = array();
		$this->load->view('movie_form',$data);
	}
	public function submit($movieID=false){
		$this->load->library('image_lib');

		$isError = false;
		$movie = $this->input->post();

		if(empty($movie['title'])){
			$isError = true;
			$movie['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(empty($movie['title_en'])){
			$isError = true;
			$movie['title_en_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		
		$movie['is_free'] = isset($movie['is_free'])?$movie['is_free']:'NO';
		$movie['is_hd'] = isset($movie['is_hd'])?$movie['is_hd']:'NO';
		$movie['is_hot'] = isset($movie['is_hot'])?$movie['is_hot']:'NO';
		$movie['is_series'] = isset($movie['is_series'])?$movie['is_series']:'NO';

		//var_dump($_FILES["cover"]);
		if(isset($_FILES["cover"])&&!empty($_FILES["cover"]['tmp_name'])){
			//if($_FILES['cover']['error']){
				//var_dump($_FILES);
				//$isError = true;
				//$movie['cover_error'] = $_FILES['cover']['error'];
			//}else{
				$destinationPath = static_path(substr(md5(time()),0,5).".jpg");
				if(move_uploaded_file($_FILES['cover']['tmp_name'],$destinationPath)){
					$imageSize = $this->config->item('cover');
					$config["source_image"] = $destinationPath;
		            $config['new_image'] = $destinationPath;
		            $config["width"] = $imageSize['medium'][0];
		            $config["height"] = $imageSize['medium'][1];
		            $config["dynamic_output"] = FALSE; // always save as cache
		            
					$this->image_lib->initialize($config);
		            $this->image_lib->fit();
		            unlink(preg_replace("#.*".$this->config->item('static_path')."#",$this->config->item('static_path'),$movie['cover_tmp']));
		            $movie['cover'] = '/'.$destinationPath;
				}
				
			//}
		}

		$data['movie'] = $movie;
		unset($movie);
		if($isError){
			$this->load->view('movie_form',$data);
		}else{
			if(is_numeric($movieID)){
				$this->mMovie->updateMovie($movieID,$data['movie']);
			}else{
				$data['movie']['path'] = substr(md5($data['movie']['title']+time()),0,10);
				$movieID = $this->mMovie->setMovie($data['movie']);
			}
			$category_tmp = explode(',',$this->input->post('category_tmp'));
			$category = $this->input->post('category');
			
			$deleteCategory = array_diff($category_tmp,$category);
			$addCategory = array_diff($category,$category_tmp);

			if(is_array($addCategory)&&count($addCategory)){
				$this->mMovie->setMovieCategory($movieID,$addCategory);
			}
			if(is_array($deleteCategory)&&count($deleteCategory)){
				$this->mMovie->deleteMovieCategory($movieID,$deleteCategory);
			}
			redirect(backoffice_url('/movie'));	
		}
	}
	
	public function active($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->updateMovie($movieID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/movie'));
	}
	public function inactive($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->updateMovie($movieID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/movie'));
	}
	public function delete($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->deleteMovie($movieID);
		}
		redirect(backoffice_url('/movie'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}

	public function addEpisode($movieID=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($movieID)){
			$data = $this->input->post();
			$data['movie_id'] = $movieID;

			$path = $this->config->item('episode_path').date('/Y/').'series-'.$movieID.'-'.substr(md5(time()),0,10);
			$episode_id = $this->mEpisode->setEpisode($data);
			echo json_encode(array(
				'status'=>'success',
				'items'=>array(
						'episode_id'=>$episode_id,
						'title'=>$data['title'],
						'path'=>$path
					)
			));
		}else{
			echo json_encode(array(
				'status'=>'faile',
				'message'=>'movie id not accept'
			));	
		}
		
		
	}
	public function deleteEpisode($episode_id=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($episode_id)){
			$this->mEpisode->deleteEpisode($episode_id);
		}
	}
}

/* End of file movie.php */
/* Location: ./application/modeules/backoffice/controllers/movie.php */