<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
	public function __construct(){
		parent::__construct();
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
			$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>'');
			$data['breadcrumb'] = $this->breadcrumb;	
			$data['movie']['path'] = str_replace('{path}',$data['movie']['path'],$this->config->item('clip_path'));
			$this->load->view('movie_detail',$data);
		}else{
			$data['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
			$data['movies']['pageing']['url'] = base_url('/movie');
			$data['pageing'] = $this->load->view('pageing',$data['movies']['pageing'],true);
			$data['breadcrumb'] = $this->breadcrumb;
			$this->load->view('movie',$data);
		}
	}
	public function search(){
		$this->breadcrumb[] = array('title'=>'Search','url'=>backoffice_url('/movie/search'));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie',$data);
	}
	public function detail($movieID=""){
		$this->breadcrumb[] = array('title'=>'MovieName','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		
		$this->load->view('movie_detail',$data);
	}
	public function edit($movieID=""){
		$data['movie'] = $this->mMovie->getMovie($movieID);
		$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>backoffice_url('/movie/'.$movieID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/movie/edit/'.$movieID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
	public function create(){
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
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

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
}

/* End of file movie.php */
/* Location: ./application/modeules/backoffice/controllers/movie.php */