<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Package extends CI_Controller {
    var $categories;
    var $memberLogin;
	public function __construct(){
        parent::__construct();
		$this->load->library('Util');
		$this->load->library('Mypayment');
		
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('package_model','mPackage');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();
        if(!$this->memberLogin){
            redirect(base_url('/login?reurl='.urlencode(base_url('/package'))));
        }
		$this->load->helper('form');
    }

    public function index(){
        /*
        $this->load->model('member_model','mMember');
        $this->load->model('banner_model','mBanner');
        $this->load->model('movie_model','mMovie');

        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['banners'] = $this->mBanner->getBanners();
        $view['moviesHot'] = $this->mMovie->getMoviesHot(1,20);
        $view['moviesHot'] = $view['moviesHot']['items'];
        $view['movies'] = $this->mMovie->getMoviesHot(1,20);
        */
        
        $view['memberLogin'] = $this->memberLogin;
        $view['packages'] = $this->mPackage->getPackages(1,30,array("status = 'ACTIVE'", "partner = 'DOONEE'","package_id in (3,10)"));
        $view['categories'] = $this->categories;
		
        $this->load->view('web/package',$view);
    }
	
	/*--------------------------------*/
	public function refill($selected_package_id = null){
		$view['selected_package_id'] = $selected_package_id;
		$view['memberLogin'] = $this->memberLogin;
		$view['categories'] = $this->categories;
		$view['packages'] = $this->mPackage->getAllPackages(1, 30, array("package_id in (3,11)","status in ('ACTIVE')"));
		
		//submit form
		if($member = $this->input->post()){
			$member_id = $this->memberLogin['user_id'];
			
			//validate
	        $validate = $this->_validate_register($member);
			$error = $validate['error'];
			$message = $validate['message'];
			
			//validate fgf
			if(!empty($member['friend_fgf'])){
				$friend = $this->mMember->getMemberByFgf($member['friend_fgf'], $member_id);
				if(empty($friend)){
					$error = true;
	                $message['friend_fgf'] = "ไม่พบรหัส Friend get Friend นี้";
				}
			}
			
			if(!$error){
				$package_id = $member['package_id'];
				$channel_id = $member['channel_id'];
				
				if($channel_id == 'credit'){
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
					
					//create credit form
					$view['form'] = $this->_generate_form_data($invoice_id,$member, $package);
					
					$this->load->view('web/payment_submit',$view);
					return;
				}
				else if($channel_id == 'card'){
					$this->_topup_prepaidcard($member_id, $member['code']);
					 redirect(base_url('package/refill_success'));
				}
				else if($channel_id == 'counter_service'){
					redirect(base_url('payment/paypoint/' . $member['package_id'] . '/' . $member['counter_service']));
				}
				else if($channel_id == 'atm'){
					redirect(base_url('payment/atm/' . $member['package_id'] . '/' . $member['atm']));
				}
				else if($channel_id == 'bank'){
					redirect(base_url('payment/bankcounter/' . $member['package_id'] . '/' . $member['bank']));
				}
				else if($channel_id == 'ibanking'){
					redirect(base_url('payment/ibanking/' . $member['package_id'] . '/' . $member['ibanking']));
				}
			}
			else{
				$view['error'] = $error;
	        	$view['error_message'] = $message;
				$view['member'] = $member;
			}
		}
		
		$view['payment_channels'] = array(
			'credit' => 'บัตรเครดิต',
			'counter_service' => 'จุดชำระค่าบริการ',
			'atm' => 'เอทีเอ็ม',
			'bank' => 'ธนาคาร',
			'ibanking' => 'ไอแบงก์กิ้ง',
			'card' => 'บัตรเติมวัน'
		);

		
		$this->load->view('web/package_refill',$view);
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
	function _validate_register($member = array()){
        $error = false;
        $message = array();
       
		if($member['channel_id'] == 'card'){
			$code = implode('',$member['code']);
			$result = $this->_validate_prepaidcard($code);
			if($result['error']){
				$error = true;
				$message['prepaidcard'] = $result['message'];
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
	private function _create_invoice($messageID,$user_id,$package_id,$channel,$agent,$amount,$title,$description, $friend_fgf){
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
	/*--------------------------------*/
	public function refill_success(){
		$view['memberLogin'] = $this->memberLogin;
		$view['categories'] = $this->categories;
		
		
		$this->load->view('web/package_refill_success',$view);
	}
}