<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sms extends CI_Controller {
	public function __construct(){
        parent::__construct();
		
		$this->load->library('Util');
		$this->load->model('sms_model','mSms');
    }

	/*--------------------------*/
    public function receive(){
    	header("Content-Type: application/xml; charset=utf-8");
		
		$xml = file_get_contents('php://input');
		
		if(!empty($xml)){
			//save log
			$data = array(
				'data' => $xml
			);
			$this->mSms->saveLog($data);
			
			$result = array(
					'transid' => $this->util->generateRandomString(5,true),
					'status' => array(
						'status-code' => 'OK',
						'status-detail' => null
					),
					'data' => array(
						'content' => null,
						'msgtype' => null
					)
			);
			
		}
		else{
			$result = array(
					'transid' => $this->util->generateRandomString(5,true),
					'status' => array(
						'status-code' => 'ERR',
						'status-detail' => 'Not found content'
					)
			);
		}
		
		$xml = $this->util->array_to_xml($result, new SimpleXMLElement('<subscriber_response/>'))->asXML();
		echo $xml;
		
    	exit();
    }
	
	/*--------------------------*/
	public function test(){
		$phoneno = $this->util->generateRandomString(10,true);
		$ntype = array('GSM','ONE2CALL','DTAC','TRUE','TRUEMOVEH');
		$sub_type = array('REGISTER','CANCEL');
		
		$data = array(
			'transid' => $this->util->generateRandomString(5,true),
			'login' => $phoneno,
			'password' => $this->util->generateRandomString(4,true),
			'data' => array(
				'phoneno' => $phoneno,
				'ntype' => $ntype[rand(0,4)],
				'sub_type' => $sub_type[rand(0,1)],
				'service_id' => 843,
				'topic_id' => 1650
			)
		);
		
		$xml = $this->util->array_to_xml($data, new SimpleXMLElement('<subscriber/>'))->asXML();
		
		header("Content-Type: application/xml; charset=utf-8");
		$result = $this->util->post_xml(base_url('/sms/receive'),$xml);
		echo $result;
		
		exit();
	}
    
	
}
?>