<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/API_Controller.php');
class Payment extends API_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('api/package_model','mPackage');
		$this->load->model('api/member_model','mMember');

	}
	public function index_get($package_id=""){
		$view = array();
		if(is_numeric($package_id)){
			$package = $this->mPackage->getPackage($package_id);
		}
		$view['package'] = $package;
		$this->load->view('package',$view);
	}
	private function initPaymentGet($package_id){
		session_start();

		/* ### Fix mov domain www.dooneetv.com to www.doonee.com  support for android payment */
        if($_SERVER['HTTP_HOST']=='www.dooneetv.com'){
            redirect('https://www.doonee.com'.$_SERVER['REQUEST_URI']);
        }
        /* End */

		$_SESSION['app_payment'] = '1';
		$view = array();

		$member_id = $this->get('member_id');
		$view['member']['member_id'] = $member_id;
		if(!is_numeric($member_id)){
			echo "กรุณาเข้าสู่ระบบก่อน";exit;
		}		

		if(!is_numeric($package_id)){
			echo "ไม่มีข้อมูล Package นี้ ";exit;
		}
		$package = $this->mPackage->getPackage($package_id);
		if(!$package){
			echo "ไม่มีข้อมูล Package นี้ ";exit;
		}
		$view['device'] = $this->get('device');
		$view['package'] = $package;
		return $view;
	}

	public function creditcard_get($package_id=""){
		$view = $this->initPaymentGet($package_id);
		$this->load->view('payment_creditcard',$view);
		error_log("payment start");
	}
	public function creditcard_post(){
		session_start();
		$_SESSION['app_payment'] = '1';		
		$this->load->library("Twoc2pPayment");

		$package_id = $this->input->post('package_id');
		$member_id = $this->input->post('member_id');
		$encryptedCardInfo = $this->input->post('encryptedCardInfo');
		$holderName = $this->input->post('holdername');
		$device = $this->input->post('device');

		if(!is_numeric($package_id)||!is_numeric($member_id)||empty($encryptedCardInfo)){
			echo "เกิดข้อผิดพลาดข้อมูลไม่ถูกต้อง";exit;
		}
		
		$package = $this->mPackage->getPackage($package_id);
		if(!$package){
			echo "ไม่มีข้อมูล Package นี้ ";exit;
		}
	
		$invoice = $this->createInvoice($member_id,$package,'CREDITCARD',$device);

        if($encryptedCardInfo){
            $messageID = $this->getMessageID();
            if($invoice){
                $view['form'] = $this->twoc2ppayment->createForm($messageID,$invoice['invoice_id'],$package['price'],$package['title'],$encryptedCardInfo,$holderName);
                echo $view['form'];exit;//$this->load->view('web/payment_submit',$view);
            }
        }else{
            echo "กรอกข้อมูลไม่ถูกต้อง กรถณาลองใหม่อีกครั้ง";exit;
        }
	}
	
	public function atm_get($package_id=""){
		$view = $this->initPaymentGet($package_id);
		
		$this->load->view('payment_bank',$view);
	}
	public function paypoint_get($package_id=""){
		$view = array();
		
		$this->load->view('payment_paypoint',$view);
	}
	public function bankcounter_get($package_id=""){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function ibanking_get($package_id=""){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function prepaidcard_get(){
		$view = array();
		
		$this->load->view('payment_prepaidcard',$view);
	}
	public function prepaidcard_post(){
		$code = $this->post("code");
		$member_id = $this->post("member_id");

		if(!$member_id){
			$this->error("Please Login");
		}
		if(!$code||!preg_match("#^[0-9]{16}$#",$code)){
			$this->error("รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ");
		}
		$this->load->library('prepaidCard');
        $this->load->model('card_model','mCard');
        
        $output = array('status'=>'','message'=>'');
        
        $this->mCard->insertCardLog(array(
                            'code'=>$code,
                            'user_id'=>$member_id,
                            'ip_address'=>$this->input->ip_address()));
        
        if($this->prepaidcard->validateChecksum($code)){
            if($card = $this->mCard->getCard($code)){
                $package = $this->mPackage->getPackage($card['package_id']);
                if( $card['status']=='UNUSED' 
                    && $card['expire_date'] >= date('Y-m-d') 
                    && $card['start_date'] < date('Y-m-d')
                    && $card['code'] == $code ){
                        $this->mCard->updateCard($card['serial_number'],array(
                            'user_id'=>$member_id,
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

                        $output['status'] = "success";
                        $output['expire_date'] = $expireDate;
                        $output['day_left'] = $this->dayleft($expireDate);
                        $output['message'] = "รหัสเติมเงินของคุณถูกต้อง \nแพ็ตเก็จของคุณคือ ".$package['title']." \n คุณสามารถใช้งานได้ถึงวันที่ ".$expireDate;
                        $this->success($output);
                        exit;
                    
                }else{
                    $output['status'] = "error";
                    $output['message'] = "1รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ";
                    $this->error($output['message']);
                    exit;
                }
            }else{
                $output['status'] = "error";
                $output['message'] = "2รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ";
                $this->error($output['message']);
                exit;
            }
        }else{
            $output['status'] = "error";
            $output['message'] = "3รหัสบัตรของคุณไม่ถูกต้องกรุณาติดต่อเจ้าหน้าที่ค่ะ";
            $this->error($output['message']);
            exit;
        }
        

	}

	public function invoice_get($invoiceID=""){
		$this->load->model('api/invoice_model','mInvoice');
		$data = array();
		$invoice = $this->mInvoice->getInvoice($invoiceID);
		
		$package = $this->mPackage->getPackage($invoice['package_id']);
		if($myPackage = $this->mPackage->getMemberPackage($invoice['user_id'])){
            $expireDate = date('Y-m-d H:i:s',strtotime($myPackage['expire_date'])+($package['dayleft']*86400));
        }else{
            $expireDate = date('Y-m-d H:i:s',strtotime('+'.$package['dayleft'].' day'));
        }
        $invoice['member'] = array(
        					'expire_date'=>$expireDate,
        					'day_left'=>$this->dayleft($expireDate),
        					'message'=>"รหัสเติมเงินของคุณถูกต้อง \nแพ็ตเก็จของคุณคือ ".$package['title']." \n คุณสามารถใช้งานได้ถึงวันที่ ".$expireDate
        					);


		$this->response($invoice, 200);



	}

	public function success_get(){
		session_start();
		var_dump($_COOKIE);
		var_dump($_SESSION);
		unset($_SESSION['app_payment']);
		echo "Payment Success";exit;
	}
	public function error_get(){
		session_start();
		unset($_SESSION['app_payment']);
		echo "Payment Error";exit;
	}

	public function iosinapp_post(){
		$this->load->model('api/invoice_model','mInvoice');
		$member_id = $this->post('member_id');
		$package_id = $this->post('package_id');
		if(!is_numeric($member_id)){
			$this->error("Invalid Member");
		}
		if(!is_numeric($package_id)){
			$this->error('Invalid Package');
		}

		$member = $this->mMember->getMember($member_id);
		$package = $this->mPackage->getPackage($package_id);
		if(!$member){
			$this->error("Invalid Member");
		}
		if(!$package){
			$this->error('Invalid Package');
		}
		$data = array(
				'user_id'=>$member_id,
				'package_id'=>$package_id,
				'channel'=>'IOS_INAPP',
				'amount'=>$package['price'],
				'title'=>$package['title'],
				'message_id'=>strtoupper(md5(time()+$member_id+$package_id)),
				'device'=>'ios'
			);
		if($invoice_id = $this->mInvoice->setInvoice($data)){
			$resp = array(
				'invoice_id'=>$invoice_id,
				'user_id'=>$member_id,
				'package_id'=>$package_id,
				'transection'=>$data['message_id'],
				'amount'=>$package['price'],
				'title'=>$package['title'],
				'dayleft'=>$package['dayleft']
				);
			$this->success($resp);
		}else{
			$this->error("ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้งค่ะ");
		}
	}
	public function iosinapp_put($invoice_id=""){
		$this->load->model('api/invoice_model','mInvoice');
		$transection = $this->put('transection');
		$status = $this->put('status');
		$message = $this->put('message');
		$transection_id = $this->put('transection_id');

		if(!is_numeric($invoice_id)){
			$this->error("Invalid Invoice");
		}
		if(!preg_match("/[SUCCESS|CANCELED|ERROR]/", $status)){
			$this->error("Invalid Status");
		}
		if(!preg_match("/[A-F0-9]{32}/", $transection)){
			$this->error("Invalid Transection");
		}
		if($invoice = $this->mInvoice->getInvoice($invoice_id)){
			if($invoice['message_id']!=$transection||$invoice['status']!='PENDING'){
				$this->error("Invalid Invoice");
			}else{
				$data = array(
						'invoice_id'=>$invoice_id,
						'status'=>$status,
						'resp_fail_reason'=>$message,
						'resp_tran_ref'=>$transection_id
					);
				if($this->mInvoice->updateInvoice($invoice_id,$data)){
					if($status=='SUCCESS'){
						if($resp = $this->setUserPackage($invoice)){
							$this->success($resp);
						}else{
							$this->success('ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้งค่ะ');	
						}
					}else{
						$this->success(null,'update sucess');
					}
				}else{
					$this->error("ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้งค่ะ");
				}

			}
		}else{
			$this->error("Invalid Invoice");	
		}
	}


	private function setUserPackage($invoice){
		if($package = $this->mPackage->getPackage($invoice['package_id'])){
			if($myPackage = $this->mPackage->getMemberPackage($invoice['user_id'])){
                $expireDate = date('Y-m-d H:i:s',strtotime($myPackage['expire_date'])+($package['dayleft']*86400));
            }else{
                $expireDate = date('Y-m-d H:i:s',strtotime('+'.$package['dayleft'].' day'));
            }

            $this->mMember->setMemberPackage(
                $invoice['user_id'],
                $package['package_id'],
                $expireDate
            );
            $resp = array(
            			'invoice_id'=>$invoice['invoice_id'],
            			'package_id'=>$invoice['package_id'],
            			'member_id'=>$invoice['user_id'],
            			'expire_date'=>$expireDate,
            			'dayleft'=>$this->dayleft($expireDate)
            		);
            return $resp;
		}else{
			return false;
		}
	}
	private function dayleft($expire_date){
		 return is_null($expire_date)?0:ceil((strtotime($expire_date)-time())/86400);
	}
	private function getMessageID(){
        return strtoupper('dooneetv'.random_string('alnum',32));
    }

    private function createInvoice($member_id,$package,$channel,$device=''){
    	$this->load->model('api/invoice_model','mInvoice');
    	$data = array(
				'user_id'=>$member_id,
				'package_id'=>$package['package_id'],
				'channel'=>$channel,
				'amount'=>$package['price'],
				'title'=>$package['title'],
				'message_id'=>strtoupper(md5(time()+$member_id+$package['package_id'])),
				'device'=>$device
			);
		if($invoice_id = $this->mInvoice->setInvoice($data)){
			$resp = array(
				'invoice_id'=>$invoice_id,
				'user_id'=>$member_id,
				'package_id'=>$package['package_id'],
				'transection'=>$data['message_id'],
				'amount'=>$package['price'],
				'title'=>$package['title'],
				'dayleft'=>$package['dayleft']
				);
			return $resp;
		}else{
			return false;
		}
    }
}