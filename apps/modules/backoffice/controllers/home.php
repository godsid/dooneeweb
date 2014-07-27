<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($page="")
	{
		$this->load->view($page);
	}
}

/* End of file home.php */
/* Location: ./application/modeules/backoffice/controllers/home.php */