<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Member_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function auth(){
		$CI = & get_instance();
		$CI->load->library('session');
		$email = $CI->session->userdata('user_data');
		if($email){
			return true;
		}else{
			return false;	
		}
	}
	public function getMemberLogin(){
		$CI = & get_instance();
		$CI->load->library('session');
		$user = $CI->session->userdata('user_data');

		if(!$user){
			if($remember = $CI->input->cookie('remember')){
				list($memberID,$code) = explode("|",$remember);
				if($member = $this->getMember($memberID)){
					if(md5($member['email'].$member['password'])==$code){
						$user = $this->login($member['email'],$member['password']);
						$CI->session->set_userdata(array('user_data'=>$user));
					}
				}
			}
		}
		if($user){
			//Check fraud data
			/*
			if(isset($user['device'])&&!$this->validateDeviceCode($user['user_id'],$user['device'])){
				$CI->session->sess_destroy();
				return false;
			}

			if($memberDevice = $this->getMemberDevice($user['user_id'])){
				if($memberDevice['device']!=$user['device']){
					$CI->session->sess_destroy();
					return false;
				}
			}else{
				$CI->session->sess_destroy();
				return false;
			}
			*/
			$history = $this->getMemberHistory($user['user_id'],1,3);
			$user['history'] = $history['items'];
			unset($history);

			$favorites = $this->getMemberFavorites($user['user_id'],1,3);
			$user['favorites'] = $favorites['items'];
			unset($favorites);
		}
		return $user;
	}
	public function login($email,$password){
		$sql = "SELECT u.user_id,u.email,u.avatar,u.firstname,u.lastname,up.expire_date,0 as dayLeft 
				FROM ".$this->table('user','u')." 
				LEFT JOIN  ".$this->table('user_package','up')." 
					ON up.user_id = u.user_id
				WHERE email='".$email."'
				AND u.password='".$password."' 
				AND u.status = 'ACTIVE' 
				ORDER BY up.expire_date DESC 
				";
		return $this->adodb->GetRow($sql);
	}
	public function getMemberDevice($user_id){
		$sql = "SELECT * 
				FROM ".$this->table('user_device')." 
				WHERE user_id = '".$user_id."' ";
		return $this->adodb->GetRow($sql);
	}
	public function setMemberDevice($data){
		return $this->adodb->AutoExecute($this->table('user_device'),$data,'INSERT');
	}
	public function updateMemberDevice($user_id,$data){
		return $this->adodb->AutoExecute($this->table('user_device'),$data,'UPDATE',"user_id='".$user_id."'");
	}
	public function deleteMemberDevice($user_id){
		return $this->adodb->Execute("DELETE FROM ".$this->table('user_device')." WHERE user_id = '".$user_id."' ");
	}
	public function facebookLogin($facebook_id,$email){
		$sql = "SELECT * 
				FROM ".$this->table('user')." 
				WHERE email='".$email."' 
				OR facebook_id='".$facebook_id."' 
				AND status = 'ACTIVE' 
				";
		return $this->adodb->GetRow($sql);	
	}
	public function getMember($userID){
		$sql = "SELECT * 
				FROM ".$this->table('user')."
				WHERE user_id = ".$userID." 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}
	public function getMemberByEmail($email){
		$sql = "SELECT * 
				FROM ".$this->table('user')."
				WHERE email = '".$email."' 
				AND status = 'ACTIVE' ";
		return $this->adodb->GetRow($sql);
	}
	public function setMember($data){
		$data['create_date'] = date('Y-m-d H:i:s');
		if($this->adodb->AutoExecute($this->table('user'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}
	public function updateMember($userID,$data){
		//$data['edit_date'] = date('Y-m-d H:i:s');
		return $this->adodb->AutoExecute($this->table('user'),$data,'UPDATE',"user_id='".$userID."'");
	}
	public function isDuplicateEmail($email){
		
		$sql = "SELECT count(*) AS count
				FROM ".$this->table('user')."
				WHERE email = '".$email."'
				";
		$result = $this->adodb->GetRow($sql);
		if($result['count']){
			return true;
		}else{
			return false;
		}
	}

	public function getMemberHistory($user_id,$page=1,$limit=30){
		$sql = "SELECT m.movie_id,h.episode_id,m.title,m.title_en,m.cover,h.last_time 
				FROM ".$this->table('history','h')." 
				LEFT JOIN ".$this->table('movie','m')." ON h.movie_id = m.movie_id
				WHERE h.user_id = ".$user_id." 
				AND m.status = 'ACTIVE' 
				";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function setMemberHistory($user_id,$movie_id,$episode_id,$last_time){
		$data = array(
					'user_id'=>$user_id,
					'movie_id'=>$movie_id,
					'episode_id'=>$episode_id,
					'last_time'=>$last_time
				);
		if($this->adodb->GetRow("SELECT * FROM ".$this->table('history')." WHERE user_id='".$user_id."' AND movie_id='".$movie_id."' ")){
			return $this->adodb->AutoExecute($this->table('history'),array('episode_id'=>$episode_id,'last_time'=>$last_time),'UPDATE',"user_id='".$user_id."' AND movie_id='".$movie_id."'");
		}else{
			if($this->adodb->AutoExecute($this->table('history'),$data,'INSERT')){
				return $this->adodb->Insert_ID();
			}else{
				return false;
			}
		}
	}

	public function getMemberFavorites($user_id,$page=1,$limit=30){
		$sql = "SELECT m.movie_id,m.title,m.title_en,m.cover 
				FROM ".$this->table('favorite','f')." 
				LEFT JOIN ".$this->table('movie','m')." ON f.movie_id = m.movie_id
				WHERE f.user_id = ".$user_id." 
				AND m.status = 'ACTIVE' 
				";
		return $this->fetchPage($sql,$page,$limit);	
	}
	public function isMemberFavorites($user_id,$movie_id){
		$sql = "SELECT favorite_id,movie_id  
				FROM ".$this->table('favorite')." 
				WHERE user_id = ".$user_id." 
				AND movie_id IN (".$movie_id.") ";
		return $this->adodb->GetAll($sql);	
	}
	

	public function setMemberFavorite($user_id,$movie_id){
		$data= array(
				'user_id'=>$user_id,
				'movie_id'=>$movie_id
				);
		if($this->adodb->AutoExecute($this->table('favorite'),$data,'INSERT')){
			return $this->adodb->Insert_ID();
		}else{
			return false;
		}
	}

	public function deleteMemberFavorite($user_id,$favorite_id){
		return $this->adodb->Execute("DELETE FROM ".$this->table('favorite')." WHERE user_id='".$user_id."' AND favorite_id ='".$favorite_id."' ");
	}
	
	public function setMemberPackage($userID,$packageID,$date){
		return $this->adodb->AutoExecute(
			$this->table('user_package'),
			array(
				'user_id'=>$userID,
				'package_id'=>$packageID,
				'create_date'=>date('Y-m-d H:i:s'),
				'expire_date'=>$date
				),
			'INSERT');
	}

	public function updateExpireSession($date){
		$user = $this->CI->session->userdata('user_data');
		$user['expire_date'] = $date;
        $this->CI->session->set_userdata(array('user_data'=>$user));
    }

    public function deviceEncode($user_id){
    	$CI = & get_instance();
        $device_section = substr(md5(time().random_string('alnum',5)),0,5);
        $device_hash = md5($device_section.$user_id.$CI->input->ip_address().$CI->agent->agent_string());
        $device_code = substr($device_hash,0,27).$device_section;
        return $device_code;
    }
    public function validateDeviceCode($user_id,$deviceCode){
    	$CI = & get_instance();
        $device_section = substr($deviceCode,27,32);
        $device_hash = md5($device_section.$user_id.$CI->input->ip_address().$CI->agent->agent_string());
        if(substr($deviceCode,0,27)==substr($device_hash,0,27)){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file member_model.php */
/* Location: ./application/models/member_model.php */