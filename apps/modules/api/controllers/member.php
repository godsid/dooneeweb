<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/API_Controller.php');
class Member extends API_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('member_model','mMember');
	}
	
	public function login_post(){
		$email = $this->post('email');
		$password = $this->post('password');
	
		if($email&&$password){
			if($member = $this->mMember->login($email,md5($password))){
				$member['dayleft'] = $this->dayleft($member['expire_date']);
				$this->success($member, 200);
			}else{
				$this->error("Invalid Email or Password");
			}
		}else{
			$this->error("Missing Email or Password");
		}
	}
	
	public function register_post(){
		$email = trim(strtolower($this->post('email')));
		$firstname = trim(strtolower($this->post('firstname')));
		$lastname = trim(strtolower($this->post('lastname')));
		$gender = trim($this->post('gender'));
		$phone = trim($this->post('phone'));
		$password = $this->post('password');
		$facebook_id = $this->post('facebook_id');

		if(!preg_match("#^[a-z].+[a-z]{2,4}#", $email)){
			$this->error("Invalid email");exit;
		}
		
		//Facebook Login
		if($facebook_id){
			if($member = $this->mMember->facebookLogin($facebook_id,$email)){
				if($member['facebook_id']!=$facebook_id){
					if($this->mMember->updateMember($member['user_id'],array('facebook_id'=>$facebook_id))){
						$member['facebook_id'] = $facebook_id;
					}
				}
				$member['dayleft'] = $this->dayleft($member['expire_date']);
				$this->success($member);	
			}
		}
		if(empty($firstname)){
			$this->error("Invalid firstname");exit;
		}
		if(empty($lastname)){
			$this->error("Invalid lastn
				.ame");exit;
		}
		if(!preg_match("#[MAIL|FEMAIL]#", $gender)){
			$this->error("Invalid Gender MAIL|FEMAIL");exit;
		}

		if(!preg_match("#^[0-9]{8,11}#", $phone)){
			$this->error("Invalid phone");exit;
		}

		if(strlen($password)<4){
			$this->error("Password is 4 - 16 Digit");exit;
		}

		if($this->mMember->isDuplicateEmail($email)){
			$this->error("Email duplicate");exit;
		}
		$data = array(
					'email'=>$email,
					'password'=>md5($password),
					'firstname'=>$firstname,
					'lastname'=>$lastname,
					'phone'=>$phone,
					'gender'=>$gender,
					'facebook_id'=>$facebook_id
				);
		if($member_id = $this->mMember->setMember($data)){
			$member = $this->mMember->login($email,md5($password));
			$member['dayleft'] = $this->dayleft($member['expire_date']);
			$this->success($member);
		}
	}

	private function dayleft($expire_date){
		 return is_null($expire_date)?0:ceil((strtotime($expire_date)-time())/86400);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */