<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
	public function __construct(){
		parent::__construct();
		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('page');
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
		$data['movie'] = $movie;
		unset($movie);
		if($isError){
			$this->load->view('movie_form',$data);
		}else{
			if(is_numeric($movieID)){
				$this->mMovie->updateMovie($movieID,$data['movie']);
			}else{
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