<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index(){

    	//$view['header'] = '';
    	$view['body'] = '';
    	//$view['footer'] = '';

    	$this->load->view('web/home',$view);
    }
}