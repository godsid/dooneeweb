<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
	public function __construct(){
		parent::__construct();

		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Packages','url'=>backoffice_url('/package'));
		$this->load->model('package_model','mPackage');
	}

	public function index(){
		redirect(backoffice_url('/movie'));
		
	}
	
}

/* End of file package.php */
/* Location: ./application/modeules/backoffice/controllers/package.php */