<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twoc2p extends CI_Controller{
	public function __construct(){
        parent::__construct();
        $this->load->library("Twoc2pPayment");
        $this->load->library("Format");
        $this->load->model('invoice_model','mInvoice');
        $this->load->model('package_model','mPackage');
        $this->load->model('member_model','mMember');
	}

	public function devBackRespCyb5Z2Wnhu(){
		if(!$this->process()){
			error_log("2c2p devBackResp data error");
		}
	}

	public function proBackRespEcJz8eMMCE(){ 
		if(!$this->process()){
			error_log("2c2p proBackResp data error");
		}
	}

	private function process(){
		if($paymentResponse = $this->input->post('paymentResponse')){
			$respData = $this->twoc2ppayment->decrypt($paymentResponse);
			$respData =  (array) simplexml_load_string($respData, 'SimpleXMLElement', LIBXML_NOCDATA);
			
			$updateData = array(
					'resp_code'=>$respData['respCode'],
					'resp_pan'=>$respData['pan'],
					'resp_unique_transaction'=>$respData['uniqueTransactionCode'],
					'resp_tran_ref'=>$respData['tranRef'],
					'resp_approval_code'=>$respData['approvalCode'],
					'resp_ref_number'=>$respData['refNumber'],
					'resp_eci'=>$respData['eci'],
					'resp_status'=>$respData['status'],
					'resp_fail_reason'=>$respData['failReason'],
					'store_card_unique_id' => (empty($respData['storeCardUniqueID'])?null:$respData['storeCardUniqueID']),
					'recurring_unique_id' => (empty($respData['recurringUniqueID'])?null:$respData['recurringUniqueID'])
					);
			if($respData['respCode']=='00'){
				$updateData['status'] = 'SUCCESS';
			}else{
				$updateData['status'] = 'ERROR';
			}
			if($this->mInvoice->updateInvoice($respData['uniqueTransactionCode'],$updateData)){
				if($respData['respCode']=='00'){//Payment success
					if($invoice = $this->mInvoice->getInvoice($respData['uniqueTransactionCode'],array("status = 'SUCCESS'"))){
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
							$this->_check_fgf($invoice);
						}
					}
				}
			}
		}else{
			return false;
		}
	}

	/*--------------------------
	function test_process(){
		$invoice_id = 1188;
		
		if($invoice = $this->mInvoice->getInvoice($invoice_id)){
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
				
				$this->_check_fgf($invoice);
			}
		}
		
		exit();
	}*/
	/*--------------------------*/
	function _check_fgf($invoice = null){
		$fgf_package_id = $this->config->item('year_package');
		$member = $this->mMember->getMember($invoice['user_id']);
		if(empty($member['friend_fgf']) && empty($invoice['friend_fgf'])) return;
		
		$friend_id = $invoice['friend_fgf'];
		/*
		if(empty($friend_id)){
			$friend = $this->mMember->getMemberByFgf($member['friend_fgf']);
			$friend_id = (empty($friend['user_id'])? null: $friend['user_id']);
		}
		 */
		
		if(!empty($friend_id) && ($invoice['package_id'] == $fgf_package_id)){
			$this->_topup_day($friend_id);
		}
	}
	
	/*---------------------------*/
	function _topup_day($member_id){
		//set package
		$package_id = $this->config->item('fgf_package');
		$campaign = "fgf";
		$package = $this->mPackage->getPackage($package_id, array("status in ('ACTIVE','INACTIVE')"));
		$day = (empty($package['dayleft'])? 0: $package['dayleft']);
		
		//friend
		if($myPackage = $this->mPackage->getMemberPackage($member_id)){
		    $expireDate = date('Y-m-d H:i:s',strtotime($myPackage['expire_date'])+($day*86400));
		}else{
		    $expireDate = date('Y-m-d H:i:s',strtotime('+'. $day.' day'));
		}
		$this->mMember->setMemberPackage(
		                            $member_id,
		                            $package['package_id'],
		                            $expireDate,
		                            $day, 
		                            $campaign
		);
	}
}