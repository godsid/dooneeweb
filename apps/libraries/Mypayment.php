<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MyPayment {
	var $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('2c2p');
		
		$this->CI->load->library('Util');
		
		$this->version = $this->CI->config->item('2c2p_version');
		$this->merchantID = $this->CI->config->item('2c2p_merchantid');
		$this->currencyCode = $this->CI->config->item('2c2p_currencycode');
		$this->countryCode = $this->CI->config->item('2c2p_countrycode');
		$this->secretKey = $this->CI->config->item('2c2p_secretkey');
		$this->requestUrl = $this->CI->config->item('2c2p_requesturl');
		$this->encryptPath = $this->CI->config->item('2c2p_encrypt_path');
		$this->decryptPath = $this->CI->config->item('2c2p_decrypt_path');

		$this->merchantPublicKey = $this->CI->config->item('2c2p_merchant_publickey');
		$this->merchantPrivateKey = $this->CI->config->item('2c2p_merchant_privatekey');
		$this->merchantPassword  = $this->CI->config->item('2c2p_merchant_password');
		$this->serverPublicKey = $this->CI->config->item('2c2p_server_publickey');

		$this->frontrespurl = $this->CI->config->item('2c2p_frontrespurl');
		$this->backrespurl = $this->CI->config->item('2c2p_backrespurl');
	}
	
	/*-----------------------*/
	public function createForm($data = array(), $package = array()){

		//Merchant Account Information
		$merchantID = $this->merchantID;
		$secretKey = $this->secretKey;

		//Product Information
		$uniqueTransactionCode = (empty($data['invoice_id'])?null: $data['invoice_id']);
		$desc = (empty($package)? null: $package['title']);
		$amt = (empty($package)? 0: $package['price']);
		$amt = sprintf("%012d",($amt*100));
		$currencyCode = $this->currencyCode;
		
		//Customer Information
		$card_holder_name = (empty($data['cardholderName'])?null: $data['cardholderName']);
		$card_holder_email = (empty($data['cardholderEmail'])?null: $data['cardholderEmail']);
		$country = $this->countryCode;
		
		//Request Information
		$timeStamp = time();
		$apiVersion = "8.0";
		$stringToHash = $merchantID . $uniqueTransactionCode . $amt; 
		$hash = strtoupper(hash_hmac('sha1', $stringToHash ,$secretKey, false));  	//Calculate Hash Value
		$encryptedCardInfo = $data['encryptedCardInfo'];							//Retrieve encrypted credit card data
		
		//recuring
		$storeCard = (empty($data['storeCard'])? 'N': $data['storeCard']);
		$recurring = (empty($data['recurring'])? 'N': $data['recurring']);
		$recurringInterval = (empty($data['recurringInterval'])? '': $data['recurringInterval']);
		$allowAccumulate = (empty($data['allowAccumulate'])? 'N': $data['allowAccumulate']);
		$recurringCount = (empty($data['recurringCount'])? 0: $data['recurringCount']);
		$invoicePrefix = (empty($data['invoicePrefix'])? '': $data['invoicePrefix']);
		
		$request_arr = array (
				'version' => '8.0',
				'timeStamp' => time(),
				'merchantID' => $merchantID,
				'uniqueTransactionCode' => $uniqueTransactionCode,
				'desc' => $desc,
				'amt' => $amt,
				
				'currencyCode' => $currencyCode,
				'cardholderName' => $card_holder_name,
				'cardholderEmail' => $card_holder_email,
				'panCountry' => $country,
				'ippTransaction' => 'N',
				'hashValue' => $hash,
				'encCardData' => $encryptedCardInfo,
				
				//recurring
				'storeCard' => $storeCard,
				'recurring' => $recurring,
				'recurringInterval' => $recurringInterval,
				'allowAccumulate' => $allowAccumulate,
				'recurringCount' => $recurringCount,
				'invoicePrefix' => $invoicePrefix
		);
		
		print '<pre>';
		print_r($request_arr);
		print '</pre>';
		exit();
		
		$xml = $this->Util->array_to_xml($request_arr, new SimpleXMLElement('<PaymentRequest/>'))->asXML();
		$encryptMsg = base64_encode($xml);

		$resp = "<html><head></head><body><form method=post action=\"".$this->requestUrl."\" id=\"sbfrom\">
				<input type=\"hidden\" name=\"paymentRequest\" value=\"".$encryptMsg."\">
				<input type=\"submit\" style=\"display:none\" value=\"Send\" name=\"submit\"> </form>
				<script type=\"text/javascript\">document.getElementsByTagName(\"input\")[1].click();</script></body></html";
		return $resp;
	}
}
?>