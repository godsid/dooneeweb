<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/API_Controller.php');
class Payment extends API_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('api/package_model','mPackage');
		$this->load->model('api/member_model','mMember');
	}
	public function index($package_id=""){
		$view = array();
		if(is_numeric($package_id)){
			$package = $this->mPackage->getPackage($package_id);
		}
		$view['package'] = $package;
		$this->load->view('package',$view);
	}

	public function creditcard_get(){
		$view = array();

		$this->load->view('payment_creditcard',$view);
	}
	public function atm_get(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function paypoint_get(){
		$view = array();
		
		$this->load->view('payment_paypoint',$view);
	}
	public function bankcounter_get(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function ibanking_get(){
		$view = array();
		
		$this->load->view('payment_bank',$view);
	}
	public function prepaidcard_get(){
		$view = array();
		
		$this->load->view('payment_prepaidcard',$view);
	}

	public function success_get(){

	}
	public function error_get(){

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
				'message_id'=>strtoupper(md5(time()+$member_id+$package_id))
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
						'resp_fail_reason'=>$message
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
}