<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	public function index()
	{
		
		$this->load->view('backoffice/index');
	}
}

/* End of file home.php */
/* Location: ./application/modeules/backoffice/controllers/home.php */