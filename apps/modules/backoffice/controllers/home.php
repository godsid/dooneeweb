<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(
	{
		//redirect('');
	}
	public function example($page="")
	{
		$this->load->view('example/'.$page);
	}
}

/* End of file home.php */
/* Location: ./application/modeules/backoffice/controllers/home.php */