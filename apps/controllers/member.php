<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller {
    var $memberLogin;
    var $categories;

    public function __construct(){
        parent::__construct();
		$this->load->library('Util');
		$this->load->library('Mypayment');
        $this->load->model('member_model','mMember');
		$this->load->model('package_model','mPackage');
        $this->memberLogin = $this->mMember->getMemberLogin();
        $this->load->model('category_model','mCategory');
        $this->categories = $this->mCategory->getCategoriesMenu();
    }

    public function history(){
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }
		
		$page = $this->page;
		$limit = 1000;
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
		$view['history'] = $this->mMember->getMemberHistory($view['memberLogin']['user_id'],$page,$limit);
        $this->load->view('web/member_history',$view);
    }
	
	public function addMemberHistory(){
		header("Content-type: Application/json; charset:utf8;");
        $movieID = $this->input->post('movie_id');
        $episodeID = $this->input->post('episode_id');
        if(!$this->memberLogin){
            $status = 'error';
            $message = 'คุณยังไม่ได้เข้าสู่ระบบค่ะ';
        }else{
            if($history_id = $this->mMember->saveMemberHistoryLog($this->memberLogin['user_id'],$movieID,$episodeID)){
                $status = 'success';
                $message = '';
            }else{
                $status = 'error';
                $message = 'เกิดข้อผิดพลาดกรุณาลองใหม่ค่ะ';
            }
        }
        
        $resp = array(
                    'status'=>$status,
                    'message'=>$message
                );
        echo json_encode($resp);
	}
	
    public function addHistory(){
        header("Content-type: Application/json; charset:utf8;");
        $movieID = $this->input->post('movie_id');
        $episodeID = $this->input->post('episode_id');
        $last_time = $this->input->post('last_time');
        if(!$this->memberLogin){
            $status = 'error';
            $message = 'คุณยังไม่ได้เข้าสู่ระบบค่ะ';
        }else{
            if($history_id = $this->mMember->setMemberHistory($this->memberLogin['user_id'],$movieID,$episodeID,$last_time)){
                $status = 'success';
                $message = '';
                $items = array('history_id'=>$history_id,'movie_id'=>$movieID,'episode_id'=>$episodeID);
            }else{
                $status = 'error';
                $message = 'เกิดข้อผิดพลาดกรุณาลองใหม่ค่ะ';
            }
        }
        
        $resp = array(
                    'status'=>$status,
                    'message'=>$message
                );
        echo json_encode($resp);
    }
    public function favorite(){
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['favorites'] = $this->mMember->getMemberFavorites($view['memberLogin']['user_id'],1,1000);

        $this->load->view('web/member_favorite',$view);
    }
    public function isFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($movie_id = $this->input->get('movie_id')){
            $favorites = $this->mMember->isMemberFavorites($this->memberLogin['user_id'],$movie_id);
            echo json_encode(array('status'=>'success','message'=>'','items'=>$favorites));
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid movie_id'));
        }
    }
    public function addFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($movie_id = $this->input->get('movie_id')){
            if($favorite_id = $this->mMember->setMemberFavorite($this->memberLogin['user_id'],$movie_id)){
                echo json_encode(array('status'=>'success','message'=>'','favorite_id'=>$favorite_id));    
            }else{
                echo json_encode(array('status'=>'error','message'=>'Insert fail'));    
            }
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid movie_id'));
        }
    }
    public function deleteFavorite(){
        header("Content-type: Application/json;Charset: utf8;");
        if($favorite_id = $this->input->get('favorite_id')){
            if($this->mMember->deleteMemberFavorite($this->memberLogin['user_id'],$favorite_id)){
                echo json_encode(array('status'=>'success','message'=>''));    
            }else{
                echo json_encode(array('status'=>'error','message'=>'Delete fail'));
            }
        }else{
            echo json_encode(array('status'=>'error','message'=>'Invalid favorite_id'));
        }
    }
    public function package(){
        $this->load->model('package_model','mPackage');
        if(!$this->memberLogin){
            redirect(base_url('/login'));
        }

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['package'] = $this->mPackage->getMemberPackage($this->memberLogin['user_id']);
        $this->load->view('web/member_package',$view);
    }
    public function register($option=""){
        if($this->memberLogin&&$option!="success"){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();
        if($option=="success"){
            $this->load->view('web/member_register_success',$view);    
        }else{
            $this->load->view('web/member_register',$view);    
        }
    }
    public function register_submit(){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $member = $this->input->post();
        $member['email'] = strtolower($member['email']);
        $error = false;
        $message = array();
        if(empty($member['email'])){
            $error = true;
            $message['email'] = "ยังไม่ได้ระบุ อีเมล์"; 
        }elseif(!preg_match("#^[a-z][a-z0-9_\-\.]+@[a-z0-9_\.\-]+\.\w#",$member['email'])){
            $error = true;
            $message['email'] = "อีเมล์ ไม่ถูกต้อง exp:xxx@email.com"; 
        }
        if(empty($member['firstname'])){
            $error = true;
            $message['firstname'] = "ยังไม่ได้ระบุ ชื่อ"; 
        }
        if(empty($member['lastname'])){
            $error = true;
            $message['lastname'] = "ยังไม่ได้ระบุ นามสกุล"; 
        }
        if(empty($member['phone'])){
            $error = true;
            $message['phone'] = "ยังไม่ได้ระบุ เบอร์โทรศัพท์"; 
        }
        if(empty($member['gender'])){
            $error = true;
            $message['gender'] = "ยังไม่ได้ระบุ เพศ"; 
        }
        if(empty($member['password'])){
            $error = true;
            $message['password'] = "ยังไม่ได้ระบุ รหัสผ่าน"; 
        }elseif(strlen($member['password'])<4){
            $error = true;
            $message['password'] = "รหัสผ่านน้อยกว่า 4 ตัวอักษร"; 
        }
        if($member['password']!=$member['rpassword']){
            $error = true;
            $message['password'] = "รหัสผ่านไม่ตรงกัน"; 
        }

        if($member['email']){
            //Check Duplicate Email
            if($this->mMember->isDuplicateEmail($member['email'])){
                $error = true;
                $message['email'] = "อีเมล์ นี้ถูกใช้งานแล้ว";
            }
        }
        if(!$error){
            $member['password'] = md5($member['password']);
            if($member_id = $this->mMember->setMember($member)){
                
                /* Promotion New Member to Package ID 5 ดูนี่ทีวีโปรโมชั่นดูฟรี 3วัน */
                $this->promotionRegister($member_id);

                
                /* End Promotion */


                //Auto Login
                if($this->auth('afterRegister')){
                    redirect(base_url('/register/success'));
                }else{
                    redirect(base_url('/login?formregister'));    
                }
                
            }else{
                $error = true;
                $view['error_message']['unknow'] = "เกิดความผิดพลาดกรุณาลองใหม่: 501";
            }
        }

        $view['member'] = $member;
        $view['error'] = $error;
        $view['error_message'] = $message;
        $this->load->view('web/member_register',$view);
    }

	
	/*-------------------------*/
	public function register_fgf($option=""){
        if($this->memberLogin&&$option!="success"){
            redirect(home_url());
        }
		$this->load->model('package_model','mPackage');
		
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();
		$view['packages'] = $this->mPackage->getAllPackages(1, 30, array("package_id in (3,11)","status in ('ACTIVE','INACTIVE')"));
		
        if($option=="success"){
            $this->load->view('web/member_register_success',$view);    
        }else{
            $this->load->view('web/member_register_fgf',$view);    
        }
    }
	
	public function register_fgf_submit(){
		if($this->memberLogin&&$option!="success"){
            redirect(home_url());
        }
		
		$view['categories'] = $this->categories;
        $view['memberLogin'] = $this->memberLogin;
        $member = $this->input->post();
		
		//validate
        $validate = $this->_validate_register($member, "register");
		$error = $validate['error'];
		$message = $validate['message'];
		
		//validate fgf
		if(!empty($member['friend_fgf'])){
			$friend = $this->mMember->getMemberByFgf($member['friend_fgf']);
			if(empty($friend)){
				$error = true;
                $message['friend_fgf'] = "ไม่พบรหัส Friend get Friend นี้";
			}
		}
		//----end validate--//

        if(!$error){
					
            $member['password'] = md5($member['password']);
			$member_id = $this->mMember->setMember($member);
			
            if($member_id){
            	//update package
            	$package_id = $member['package_id'];
				if(!empty($package_id) && is_numeric($package_id)){
					$package = $this->mPackage->getPackage($package_id, array("status in ('ACTIVE','INACTIVE')"));
					if(empty($package)){
						echo 'No package found';
						exit();
					}
					
					//invoice
					$messageID = $this->_get_message_id();
					$fgf_package_id = $this->config->item('year_package');
					if($package_id == $fgf_package_id){
						$friend_fgf = (empty($friend['user_id'])? null: $friend['user_id']);
					}
					else{
						$friend_fgf = null;
					}
					$invoice_id = $this->_create_invoice($messageID,$member_id,$package_id,'CREDITCARD','',$package['price'],$package['title'],"",$friend_fgf);
				
					//auto login
					$this->auth('afterRegister');
				
					//create credit form
					$view['form'] = $this->_generate_form_data($invoice_id,$member, $package);
					
					$this->load->view('web/payment_submit',$view);
					return;
				}
				else if($package_id == 'card'){
					$this->_topup_prepaidcard($member_id, $member['code']);
					
				}
				
				 //Auto Login
		        if($this->auth('afterRegister')){
		            redirect(base_url('/register/success'));
		        }else{
		            redirect(base_url('/login?formregister'));    
		        }
                
            }else{
                $error = true;
                $view['error_message']['unknow'] = "เกิดความผิดพลาดกรุณาลองใหม่: 501";
            }
        }

        $view['member'] = $member;
        $view['error'] = $error;
        $view['error_message'] = $message;
		$view['packages'] = $this->mPackage->getAllPackages(1, 30, array("package_id in (3,11)","status in ('ACTIVE','INACTIVE')"));
        $this->load->view('web/member_register_fgf',$view);
    }

	/*---------------------------*/
	function _topup_prepaidcard($member_id, $code){
		$code = implode('',$code);
		$this->load->library('prepaidCard');
        $this->load->model('card_model','mCard');
		
		
		if($card = $this->mCard->getCard($code)){
			$package = $this->mPackage->getPackage($card['package_id']);
			
			if( $card['status']=='UNUSED' 
                    && $card['expire_date'] >= date('Y-m-d') 
                    && $card['start_date'] < date('Y-m-d')
                    && $card['code'] == $code ){
			
				$this->mCard->updateCard($card['serial_number'],array(
		             'user_id'=> $member_id,
		             'use_date'=>date('Y-m-d H:i:s'),
		             'status'=>'USED'
		        ));
		
		        if($myPackage = $this->mPackage->getMemberPackage($member_id)){
		             $expireDate = date('Y-m-d H:i:s',strtotime($myPackage['expire_date'])+($package['dayleft']*86400));
		        }else{
		             $expireDate = date('Y-m-d H:i:s',strtotime('+'.$package['dayleft'].' day'));
		        }
		
		        $this->mMember->setMemberPackage(
		             $member_id,
		             $package['package_id'],
		             $expireDate
		        );
				$this->mMember->updateExpireSession($expireDate);
		    }
			else{
				echo 'Card นี้ถูกใช้งาน หรือ Expire แล้ว โปรดติดต่อเจ้าหน้าที่ค่ะ';
				exit();
			}
		}
		else{
			echo 'Card not found';
			exit();
		}
	}

	/*---------------------------*/
	function _generate_form_data($invoice_id,$member = array(), $package = array()){
		$data = array();
		
		$data['cardholderName'] = (empty($member['member_name'])?null:$member['member_name']);
		$data['cardholderEmail'] = (empty($member['email'])?null:$member['email']);
		$data['encryptedCardInfo'] = (empty($member['encryptedCardInfo'])?null:$member['encryptedCardInfo']);
		$data['invoice_id'] = $invoice_id;
		
		$recurring_package = $this->config->item('recurring_package');
		
		if($package['package_id'] == $recurring_package){
			$data['recurring'] = 'Y';
			$data['storeCard'] = 'Y';
			$data['invoicePrefix'] = $this->util->generateRandomString(5);
			$data['recurringInterval'] = 30;
			$data['allowAccumulate'] = 'N';
			$data['recurringCount'] = 0;
		}
						
		
		return $this->mypayment->createForm($data, $package);
	}

	/*---------------------------*/
	function _validate_register($member = array(), $mode = "register"){
		$member['email'] = strtolower($member['email']);
        $error = false;
        $message = array();
        if(empty($member['email'])){
            $error = true;
            $message['email'] = "ยังไม่ได้ระบุ อีเมล์"; 
        }elseif(!preg_match("#^[a-z][a-z0-9_\-\.]+@[a-z0-9_\.\-]+\.\w#",$member['email'])){
            $error = true;
            $message['email'] = "อีเมล์ ไม่ถูกต้อง exp:xxx@email.com"; 
        }
        if(empty($member['firstname'])){
            $error = true;
            $message['firstname'] = "ยังไม่ได้ระบุ ชื่อ"; 
        }
        if(empty($member['lastname'])){
            $error = true;
            $message['lastname'] = "ยังไม่ได้ระบุ นามสกุล"; 
        }
        if(empty($member['phone'])){
            $error = true;
            $message['phone'] = "ยังไม่ได้ระบุ เบอร์โทรศัพท์"; 
        }
        if(empty($member['gender'])){
            $error = true;
            $message['gender'] = "ยังไม่ได้ระบุ เพศ"; 
        }
		
		if($mode == "register"){
		
	        if(empty($member['password'])){
	            $error = true;
	            $message['password'] = "ยังไม่ได้ระบุ รหัสผ่าน"; 
	        }elseif(strlen($member['password'])<4){
	            $error = true;
	            $message['password'] = "รหัสผ่านน้อยกว่า 4 ตัวอักษร"; 
	        }
	        if($member['password']!=$member['rpassword']){
	            $error = true;
	            $message['password'] = "รหัสผ่านไม่ตรงกัน"; 
	        }
		
	        if($member['email']){
	            //Check Duplicate Email
	            if($this->mMember->isDuplicateEmail($member['email'])){
	                $error = true;
	                $message['email'] = "อีเมล์ นี้ถูกใช้งานแล้ว";
	            }
	        }

			if($member['package_id'] == 'card'){
				$code = implode('',$member['code']);
				$result = $this->_validate_prepaidcard($code);
				if($result['error']){
					$error = true;
					$message['prepaidcard'] = $result['message'];
				}
			}
		}
		else if($mode == "edit_profile"){
			 //Check Duplicate Email
	         if($this->mMember->isDuplicateEmail($member['email'], array("user_id != '" . $member['user_id'] . "'"))){
	            $error = true;
	            $message['email'] = "อีเมล์ นี้ถูกใช้งานแล้ว";
	         }
		}

		return array('error' => $error, 'message' => $message);
	}

	/*---------------------------*/
	function _validate_prepaidcard($code){
		$result = array('error' => false, 'message' => null);
		$this->load->library('prepaidCard');
        $this->load->model('card_model','mCard');
		
		if(!$this->prepaidcard->validateChecksum($code)){
			$result = array('error' => true, 'message' => "3รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ");
			return $result;
		}
		
		$card = $this->mCard->getCard($code);
		if(empty($card)){
			$result = array('error' => true, 'message' => "2รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ");
			return $result;
		}
		
		$package = $this->mPackage->getPackage($card['package_id']);
		if( $card['status'] !='UNUSED' 
                    || ($card['expire_date'] < date('Y-m-d'))
                    || ($card['start_date'] >= date('Y-m-d'))
                    || ($card['code'] != $code )){
            $result = array('error' => true, 'message' => "1รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ");
		}
		
		return $result;
	}
	
	/*---------------------------*/
	private function _create_invoice($messageID,$user_id,$package_id,$channel,$agent,$amount,$title,$description,$friend_fgf){
        $this->load->model('invoice_model','mInvoice');
		$data = array(
            'message_id'=>$messageID,
            'user_id'=>$user_id,
            'package_id'=>$package_id,
            'channel'=>$channel,
            'agent'=>$agent, 
            'amount'=>$amount,
            'title'=>$title,
            'description'=>$description,
			'create_date' => date('Y-m-d H:i:s'),
			'friend_fgf' => $friend_fgf
        );
        return $this->mInvoice->setInvoice($data);
    }

	private function _get_message_id(){
        return strtoupper('dooneetv'.random_string('alnum',32));
    }
	
	/*----------------------------*/
	public function edit_profile(){
		if(!$this->memberLogin){
            redirect(base_url('/login'));
			return;
        }
		
		$error = false;
		$message = array();
		$user = $this->memberLogin;
		if($data = $this->input->post()){
			$data['user_id'] = $user['user_id'];
			
			$validate = $this->_validate_register($data, "edit_profile");
			$error = $validate['error'];
			$message = $validate['message'];
			
			if(!$error && $this->mMember->updateMember($user['user_id'], $data)){
				$message['submit_success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
				$user = $this->mMember->updateMemberSession($user['email']);
			}
			else{
				$message['submit_error'] = 'ไม่สามารถบันทึกข้อมูลได้';
			}
		}
		
		
		$view['error_message'] = $message;
		$view['categories'] = $this->categories;
		$view['memberLogin'] = $user;
		$this->load->view('web/member_edit_profile',$view);
	}
	
	/*----------------------------*/
	public function change_password(){
		if(!$this->memberLogin){
            redirect(base_url('/login'));
			return;
        }
		
		$error = false;
		$message = array();
		$user = $this->memberLogin;
		if($data = $this->input->post()){
			
			//validate
	        $validate = $this->_validate_change_password($data);
			$error = $validate['error'];
			$message = $validate['message'];
			
			
			//check is match current password
			if(!$error && !$this->mMember->login($user['email'], md5($data['current_password']))){
				$message['submit_error'] = 'คุณใส่รหัสผ่านเดิมไม่ถูกต้อง';
			}
			else{
				$record = array(
					'password' => md5($data['password'])
				);
				
				if($this->mMember->updateMember($user['user_id'], $record)){
					$message['submit_success'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
				}
				else{
					$message['submit_error'] = 'ไม่สามารถบันทึกข้อมูลได้';
				}
			}
		}
		
		
		$view['error_message'] = $message;
		$view['categories'] = $this->categories;
		$view['memberLogin'] = $user;
		$this->load->view('web/member_change_password',$view);
	}
	
	/*---------------------------*/
	function _validate_change_password($member = array()){
        $error = false;
        $message = array();
		
		if(empty($member['password'])){
	            $error = true;
	            $message['password'] = "ยังไม่ได้ระบุ รหัสผ่าน"; 
	        }elseif(strlen($member['password'])<4){
	            $error = true;
	            $message['password'] = "รหัสผ่านน้อยกว่า 4 ตัวอักษร"; 
	        }
	        if($member['password']!=$member['rpassword']){
	            $error = true;
	            $message['password'] = "รหัสผ่านไม่ตรงกัน"; 
	    }

		return array('error' => $error, 'message' => $message);
	}

	/*----------------------------*/
	public function get_fgf($debug = false){
		if(!$this->memberLogin){
            redirect(home_url());
			return;
        }
		$user = $this->memberLogin;
		
		$valid = false;
		$code = null;
		$year_package = $this->config->item('year_package');
		$is_package_member = $this->mMember->isPackageMember($user['user_id'],$year_package);
			
		if($is_package_member){
			$valid = true;
		
			if(empty($user['fgf'])){
				$code = $this->util->generateRandomString(7,true);
				
				$row = $this->mMember->is_dupp_fgf($code);
				if(empty($row)){
					$this->mMember->update_fgf($user['user_id'],$code);
				}
			}
			else{
				$code = $user['fgf'];
			}
		}
		
		$view['valid'] = $valid;
		$view['code'] = $code;
		$view['categories'] = $this->categories;
		$view['memberLogin'] = $user;
		$this->load->view('web/member_fgf',$view);
	}

	/*----------------------------*/
	public function ajax_valid_email(){
		$email = (empty($_POST['email'])? null: $_POST['email']);
		
		if($this->mMember->getMemberByEmail($email)){
			echo 'false';
		}
		else{
			echo 'true';
		}
		exit();
	}

    public function login(){
        if($this->memberLogin){
            redirect(home_url());
        }
        $this->auth();
    }

    public function facebookLogin(){
        $data = $this->input->post();
        $member = $this->mMember->facebookLogin($data['id'],$data['email']);
        if($member){
            if($member['facebook_id']==$data['id']){
                //Registered with facebook
                //redirect(home_url());
            }elseif($member['email'] == $data['email']){
                //Match facebook_id
                if($this->mMember->updateMember($member['user_id'],array('facebook_id'=>$data['id']))){
                }
            }    
        }else{
            //New User Register by facebook
            $member_id = $this->mMember->setMember(array(
                    'email'=>$data['email'],
                    'firstname'=>$data['first_name'],
                    'lastname'=>$data['last_name'],
                    'facebook_id'=>$data['id'],
                    'password'=>md5($data['id']),
                    'create_date'=>date('Y-m-d H:i:s')
                    ));
            if($member_id){

                $member = $this->mMember->getMember($member_id);
                $this->promotionRegister($member_id);
            }
        }
        $user = $this->mMember->login($member['email'],$member['password']);
        //if($device_code = $this->checkFirstLogin($user['user_id'])){
            //$user['device'] = $device_code;
            $this->session->set_userdata(array('user_data'=>$user));
            header("Content-type: Application/json; charset:utf8;");
            echo json_encode($user);
        //}else{
            //header("Content-type: Application/json; charset:utf8;");
            //echo json_encode(array('message'=>'บัญชีนี้ถูกใช้งานจากเครื่องอื่นอยู่'));
        //}
        
        
    }
    public function changepassword(){
        $this->load->view('web/member_changepassword');
    }

    public function forgotpassword($option=""){
        if($this->memberLogin){
            redirect(home_url());
        }
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['member'] = array();
		$view['submit'] = '';

        if($option=='submit'){
            $email = $this->input->post('email');

			$subject = 'แจ้งลืมรหัสผ่าน DooneeTV';
			$newpass = rand(1000,9999);
			$member = $this->mMember->getMemberByEmail($email);
			if(!empty($member)){
				$this->mMember->updateMember($member['user_id'],array('password'=> md5($newpass)));
	
				$headers = "From: " . strip_tags($this->config->item('email_contact')) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($this->config->item('email_contact')) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$message = '<html><body>';
				$message .= '<div>Dear ' . $email . '</div>';
				$message .= '<div>รหัสผ่านใหม่ของท่านคือ ' . $newpass . '</div><br/><br/>';
				$message .= '<div>Thanks!</div>';
				$message .= '<div>DooneeTV</div>';
				$message .= '</body></html>';
				
	            mail($email,$subject,$message,$headers);
			
				$view['submit'] = 'success';
				$view['email'] = $email;
			}
        }

        $this->load->view('web/member_forgotpassword',$view);
    }
    public function auth($option=""){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['reurl'] = $this->input->get('reurl');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $autologin = $this->input->post('remember');
        if($email&&$password){
            if($user = $this->mMember->login(strtolower($email),md5($password))){
                //if($device_code = $this->checkFirstLogin($user['user_id'])){
                    //$user['device'] = $device_code;
                    $this->session->set_userdata(array('user_data'=>$user));
                    if($autologin=='yes'){
                        $rememberCode = $user['user_id']."|".md5($user['email'].md5($password));
                        $this->input->set_cookie('remember',$rememberCode,strtotime('+1 year'),$this->config->item('cookie_domain'),'/');
                    }
                    if($option=="afterRegister"){
                        return true;
                    }
                    if($reurl = $this->input->get('reurl')){
                        redirect($reurl);
                    }else{
                        redirect(home_url());
                    }
                //}else{
                    $view['message'] = 'บัญชีนี้ถูกใช้งานจากเครื่องอื่นอยู่';
                //    $this->load->view('web/member_login',$view); 
                //}
            }else{
                $this->load->view('web/member_login',$view); 
            }
        }else{
            $this->load->view('web/member_login',$view);
        }
    }

    public function logout(){
        $user = $this->session->userdata('user_data');
        $this->mMember->deleteMemberDevice($user['user_id']);
        $this->input->set_cookie('remember','',strtotime('-1 day'));
        $this->session->sess_destroy();
        redirect(home_url());
    }
    private function checkFirstLogin($user_id){
        $device = $this->mMember->getMemberDevice($user_id);
        $device_code = $this->mMember->deviceEncode($user_id);
        if($device){
            if($device['last_active'] < date('Y-m-d H:i:s',time()-1800)){
                $data = array(
                            'device'=>$device_code,
                            'device_detail'=>$this->agent->agent_string(),
                            'ip_address'=>$this->input->ip_address(),
                            'last_active'=>date('Y-m-d H:i:s')
                        );
                $this->mMember->updateMemberDevice($user_id,$data);
                return $device_code;
            }else{
                return false;
            }
        }else{
            $data = array(
                        'user_id'=>$user_id,
                        'device'=>$device_code,
                        'device_detail'=>$this->agent->agent_string(),
                        'ip_address'=>$this->input->ip_address(),
                        'last_active'=>date('Y-m-d H:i:s')
                    );
            $this->mMember->setMemberDevice($data);
            return $device_code;
        }
    }
    private function promotionRegister($member_id){
        /*
        $this->load->model('package_model','mPackage');
        if($package = $this->mPackage->getPackage(5)){
            $now = date('Y-m-d H:i:s');
            if($package['status']=='ACTIVE'&&$package['start_date'] < $now && $package['end_date'] > $now){
                $this->mMember->setMemberPackage($member_id,5,date('Y-m-d H:i:s',strtotime('+'.$package['dayleft'].' day')));
            }
            
        }
        */
    }
    
}