<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class One23 extends CI_Controller{
	public function __construct(){
        parent::__construct();
        $this->load->library("One23Payment");
        $this->load->library("Format");
        $this->load->model('invoice_model','mInvoice');
        $this->load->model('package_model','mPackage');
        $this->load->model('member_model','mMember');
	}

	public function devBackResp7BFxA4CXm9Y(){
		if(!$this->process()){
			error_log("123pay devBackResp data error");
		}
	}

	public function proBackRespXhMdkag7eR(){
		if(!$this->process()){
			error_log("2c2p proBackResp data error");
		}
	}

	private function process(){
		if($paymentResponse = $this->input->get('OneTwoThreeRes')){
			$respData = $this->one23payment->decrypt($paymentResponse);
			$respData =  (array) simplexml_load_string($respData, 'SimpleXMLElement', LIBXML_NOCDATA);
			$updateData = array(
					'resp_code'=>$respData['ResponseCode'],
					//'resp_pan'=>$respData['pan'],
					'resp_unique_transaction'=>$respData['InvoiceNo'],
					'resp_tran_ref'=>$respData['RefNo1'],
					//'resp_approval_code'=>$respData['approvalCode'],
					//'resp_ref_number'=>$respData['refNumber'],
					//'resp_eci'=>$respData['eci'],
					'resp_status'=>''
					);
			if(isset($respData['FailureReason'])){
				$updateData['resp_fail_reason'] = $respData['FailureReason'];
			}
			if($respData['ResponseCode']=='000'){
				$updateData['status'] = 'SUCCESS';
			}elseif($respData['ResponseCode']=='001'){
				$updateData['status'] = 'PENDING';
			}
			elseif($respData['ResponseCode']=='002'){
				$updateData['status'] = 'EXPIRE';
			}else{
				$updateData['status'] = 'CANCELED';
			}
			if($this->mInvoice->updateInvoice($respData['InvoiceNo'],$updateData)){
				if($respData['ResponseCode']=='000'){//Payment success
					if($invoice = $this->mInvoice->getInvoice($respData['InvoiceNo'])){
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
						}
					}
				}
			}
		}else{
			return false;
		}
	}
}