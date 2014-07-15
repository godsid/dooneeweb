<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(BASEPATH.'libraries/REST_Controller.php');
class Auth extends REST_Controller {

	public function index_get(){
		$this->response(array(), 200);
	}

	public function login_post(){
		$this->response(array(), 200);
	}

	public function logout_get(){
		$this->response(array(), 200);
	}

	public function register_post(){
		$this->response(array(), 200);
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */