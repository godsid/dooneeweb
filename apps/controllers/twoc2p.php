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
					'resp_fail_reason'=>$respData['failReason']
					);
			if($respData['respCode']=='00'){
				$updateData['status'] = 'SUCCESS';
			}else{
				$updateData['status'] = 'ERROR';
			}
			if($this->mInvoice->updateInvoice($respData['uniqueTransactionCode'],$updateData)){
				if($invoice = $this->mInvoice->getInvoice($respData['uniqueTransactionCode'])){
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
						$this->mMember->setMemberPackage($invoice['user_id'],$package['package_id'],$package['dayleft']);
					}
				}
			}
		}else{
			return false;
		}
	}
}