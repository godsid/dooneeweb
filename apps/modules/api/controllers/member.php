<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/API_Controller.php');
class Member extends API_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('member_model','mMember');
	}
	

	public function index_get($memberID=""){
		if(is_numeric($memberID)){
			if($member = $this->mMember->getMember($memberID)){
				unset($member['password']);
				if($member['expire_date']==null||strtotime($member['expire_date'])<time()){
					$member['expire_date'] = "";
					$member['dayleft'] = 0;
				}else{
					$member['dayleft'] = $this->dayleft($member['expire_date']);
				}
				$this->success($member);
			}else{
				$this->error("Missing memberID");
			}
		}else{
			$this->error("Unknown method",404);
		}
	}
	public function login_post(){
		$email = $this->post('email');
		$password = $this->post('password');
	
		if($email&&$password){
			if($member = $this->mMember->login($email,md5($password))){
				//$member['member_id'] = md5($member['member_id'].$member['email']);
				if($member['expire_date']==null||strtotime($member['expire_date'])<time()){
					$member['expire_date'] = "";
					$member['dayleft'] = 0;
				}else{
					$member['dayleft'] = $this->dayleft($member['expire_date']);
				}
				
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
				//$member['member_id'] = md5($member['member_id'].$member['email']);
				if($member['expire_date']==null||strtotime($member['expire_date'])<time()){
					$member['expire_date'] = "";
					$member['dayleft'] = 0;
				}else{
					$member['dayleft'] = $this->dayleft($member['expire_date']);
				}
				$this->success($member);	
			}
		}
		/*
		if(empty($firstname)){
			$this->error("Invalid firstname");exit;
		}
		if(empty($lastname)){
			$this->error("Invalid lastname");exit;
		}
		
		if(!preg_match("#[MAIL|FEMAIL]#", $gender)){
			$this->error("Invalid Gender MAIL|FEMAIL");exit;
		}
		*/

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
			if($member['expire_date']==null){
					$member['expire_date'] = "";
			}
			$member['dayleft'] = $this->dayleft($member['expire_date']);
			//$member['member_id'] = md5($member['member_id'].$member['email']);
			$this->success($member);
		}
	}

	public function history_get(){
		$this->load->model('movie_model','mMovie');
		$member_id = $this->get('member_id');
		if(!is_numeric($member_id)){
			$this->error("Invalie member_id");
		}
		$history = $this->mMember->getMemberHistory($member_id,$this->page,$this->limit);
		$this->mMovie->rewiteData($history['items']);
		$this->success($history);

	}
	public function history_post(){
		$member_id = $this->post('member_id');
		$movie_id = $this->post('movie_id');

		if(!is_numeric($member_id)){
			$this->error("Invalid member_id");exit;
		}
		if(!is_numeric($movie_id)){
			$this->error("Invalid movie_id");exit;
		}
		if($this->mMember->setMemberHistory($member_id,$movie_id,1,0)){
			$this->success(array());
		}else{
			$this->error("Insert fail");exit;
		}
	}
	public function favorite_get(){
		$this->load->model('movie_model','mMovie');
		$member_id = $this->get('member_id');
		if(!is_numeric($member_id)){
			$this->error("Invalie member_id");
		}
		$favorite = $this->mMember->getMemberFavorite($member_id,$this->page,$this->limit);
		$this->mMovie->rewiteData($favorite['items']);
		$this->success($favorite);
	}
	public function favorite_post(){
		$member_id = $this->post('member_id');
		$movie_id = $this->post('movie_id');
		if(!is_numeric($member_id)){
			$this->error("Invalid member_id");exit;
		}
		if(!is_numeric($movie_id)){
			$this->error("Invalid movie_id");exit;
		}
		if($favorite_id = $this->mMember->setMemberFavorite($member_id,$movie_id)){
			$this->success(array('favorite_id'=>$favorite_id,'member_id'=>$member_id,'movie_id'=>$movie_id));
		}else{
			$this->error("Insert fail");exit;
		}
	}
	public function favorite_delete(){
		$member_id = $this->delete('member_id');
		$favorite_id = $this->delete('favorite_id');
		if(!is_numeric($member_id)){
			$this->error("Invalid member_id");exit;
		}
		if(!is_numeric($favorite_id)){
			$this->error("Invalid favorite_id");exit;
		}
		if($this->mMember->deleteMemberFavorite($member_id,$favorite_id)){
			$this->success(array());
		}else{
			$this->error("delete fail");exit;
		}
	}

	public function package_get(){
		$member_id = $this->get('member_id');
		if(!is_numeric($member_id)){
			$this->error("Invalid member_id");exit;
		}else{
			$package = $this->mMember->getMemberPackage($member_id,$this->page,$this->limit);
			$this->success($package);
		}
		
	}

	private function dayleft($expire_date){
		 return is_null($expire_date)?0:ceil((strtotime($expire_date)-time())/86400);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */