<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(BASEPATH.'libraries/API_Controller.php');
class Member extends API_Controller {

	$this->load->model('member_model','mMember');
	public function login_post(){
		$email = $this->post('email');
		$password = $this->post('password');

		if($email&&$password){
			if($member = $this->mMember->login($email,$password)){
				$this->response($member, 200);
			}
		}else{
			$this->response(array(), 200);
		}
	}

	public function register_post(){
		$email = trim(strtolower($this->post('email')));
		$firstname = trim(strtolower($this->post('firstname')));
		$lastname = trim(strtolower($this->post('lastname')));
		$gender = $this->post('email');
		$phone = trim($this->post('phone'));
		$password = $this->post('password');

		if(!preg_match("#^[a-z].+[a-z]{2,4}#", $email)){
			$this->error("Invalid email");exit;
		}
		if(empty($firstname))){
			$this->error("Invalid firstname");exit;
		}
		if(empty($lastname)){
			$this->error("Invalid lastname");exit;
		}
		if(empty($gender)){
			$this->error("Invalid Gender");exit;
		}

		if(!preg_match("#^[0-9]{8,11}#", $phone)){
			$this->error("Invalid phone");exit;
		}

		if(strlen($password)<4)){
			$this->error("Password is 4 - 16 Digit");exit;
		}

		if($this->mMember->isDuplicateEmail($email)){
			$this->error("Email duplicate");exit;
		}

		if($member_id = $this->mMember->setMember()){
			$member = $this->mMember->login($email,$password);
			$this->success($member);
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */