<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	var $breadcrumb;
	public function __construct(){
		parent::__construct();
		$this->breadcrumb[] = array('title'=>'Movie','url'=>backoffice_url('/movie'));
	}

	public function index($movieID=""){

		if($movieID){
				$this->profile();
				exit;
		}
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie',$data);
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
		$this->breadcrumb[] = array('title'=>'MovieName','url'=>backoffice_url('/movie/detail/'.$movieID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/member/edit/'.$movieID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
}

/* End of file movie.php */
/* Location: ./application/modeules/backoffice/controllers/movie.php */