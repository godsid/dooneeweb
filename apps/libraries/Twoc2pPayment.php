<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twoc2pPayment {
	var $CI;
	var $version;
	var $merchantID;
	var $secretKey;
	var $currencyCode;
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('2c2p');

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
	public function createForm($messageID,$invoice_id,$amount,$title,$encryptedCardInfo){
		$amount = sprintf("%012d",($amount*100));
		$xml = "<PaymentRequest>
			<version>".$this->version."</version> 
			<merchantID>".$this->merchantID."</merchantID>
			<uniqueTransactionCode>".$invoice_id."</uniqueTransactionCode>
			<desc>".$title."</desc>
			<amt>".$amount."</amt>
			<currencyCode>".$this->currencyCode."</currencyCode>  
			<panCountry>".$this->countryCode."</panCountry> 
			<cardholderName>Banpot s</cardholderName>   
			<hashValue>".strtoupper(hash_hmac('sha1',$this->merchantID.$invoice_id.$amount,$this->secretKey, false))."</hashValue>
			<encCardData>".$encryptedCardInfo."</encCardData>
			</PaymentRequest>"; 
			
		$encryptMsg = base64_encode($xml);

		$resp = "<html><head></head><body><form method=post action=\"".$this->requestUrl."\" id=\"sbfrom\">
				<input type=\"hidden\" name=\"paymentRequest\" value=\"".$encryptMsg."\">
				<input type=\"submit\" style=\"display:none\" value=\"Send\" name=\"submit\"> </form>
				<script type=\"text/javascript\">document.getElementsByTagName(\"input\")[1].click();</script></body></html";
		return $resp;
	}

	
	public function decrypt($encMsg){
		$invoice = time();
		$filehash = $invoice.'_'.time();
		$respfile = $this->decryptPath.'resp_'.$filehash;
		$decfile = $this->decryptPath.'dec_'.$filehash;
		$msgfile = $this->decryptPath.'msg_'.$filehash;
		file_put_contents($respfile,$encMsg);

		$strOri = "MIME-Version: 1.0
Content-Disposition: attachment; filename=\"smime.p7m\"
Content-Type: application/x-pkcs7-mime; smime-type=enveloped-data; name=\"smime.p7m\"
Content-Transfer-Encoding: base64

";
	    $enc = file_get_contents($respfile);
	    $enc = wordwrap($enc, 64, "\n", true);
	    if($fp = fopen($decfile, "w")){
	    	fwrite($fp, $strOri.$enc);
	    	fclose($fp);	
	    }else{
	    	error_log("Can't write file ".$decfile);
	    	return false;
	    }
	    
	    $key = file_get_contents($this->merchantPublicKey);
	    $key_private = array(file_get_contents($this->merchantPrivateKey), $this->merchantPassword);
	    if (openssl_pkcs7_decrypt($decfile, $msgfile, $key, $key_private)) {
	        return file_get_contents($msgfile);
	    }else 
		{
	        error_log("Can't decrypt on Twoc2pPayment Library =>".$decfile);
			return false;
		}
	}
}