<?php

class One23Payment {
	var $CI;
	var $version;
	var $merchantID;
	var $secretKey;
	var $currencyCode;
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('one23');

		$this->version = $this->CI->config->item('one23_version');
		$this->merchantID = $this->CI->config->item('one23_merchantid');
		$this->currencyCode = $this->CI->config->item('one23_currencycode');
		$this->countryCode = $this->CI->config->item('one23_countrycode');
		$this->secretKey = $this->CI->config->item('one23_secretKey');
		$this->encryptPath = $this->CI->config->item('one23_encrypt_path');
		$this->decryptPath = $this->CI->config->item('one23_decrypt_path');
		$this->privateKey = $this->CI->config->item('one23_privatekey');
		$this->requestUrl = $this->CI->config->item('one23_requesturl');

		$this->frontrespurl = $this->CI->config->item('one23_frontrespurl');
		$this->backrespurl = $this->CI->config->item('one23_backrespurl');


	}

	public function createForm($messgaeID,$invoiceID,$amount,$description,$items=array(),$payerName="",$payerEmail="",$payerMobile="",$shippingAddress=""){

		$produnctItem = "";
		foreach($items as $item){
			$produnctItem.="<PaymentItem id=\"".$item['id']."\" name=\"".$item['name']."\" price=\"".sprintf("%012d",$item['price']*100)."\" quantity=\"".$item['quantity']."\" />";
		}

		$msg = "<OneTwoThreeReq>
					<Version>".$this->version."</Version>
					<TimeStamp>".date('Y-m-d H:i:s:B')."</TimeStamp>
					<MessageID>".$messgaeID."</MessageID>
					<MerchantID>".$this->merchantID."</MerchantID>
					<InvoiceNo>".sprintf("%012d",$invoiceID)."</InvoiceNo>
					<Amount>".sprintf("%012d",($amount*100))."</Amount>
					<Discount>".sprintf("%012d",0)."</Discount>
					<ServiceFee>".sprintf("%012d",0)."</ServiceFee>
					<ShippingFee>".sprintf("%012d",0)."</ShippingFee>
					<CurrencyCode>".$this->currencyCode."</CurrencyCode>
					<CountryCode>".$this->countryCode."</CountryCode>
					<ProductDesc>".mb_substr($description,0,255)."</ProductDesc>
					<PaymentItems>
						".$produnctItem."
					</PaymentItems>
					<PayerName>".mb_substr($payerName,0,100)."</PayerName>
					<PayerEmail>".mb_substr($payerEmail,0,100)."</PayerEmail>
					<PayerMobile>".mb_substr($payerMobile,0,20)."</PayerMobile>
					<ShippingAddress>".mb_substr($shippingAddress,0,200)."</ShippingAddress>
					<MerchantUrl>".$this->frontrespurl."</MerchantUrl>
					<APICallUrl>".$this->backrespurl."<APICallUrl>
					<PayInSlipInfo>Slip Info</PayInSlipInfo>
					<PaymentExpiry>".date('Y-m-d H:i:s',time()+3600)."</PaymentExpiry>
					<UserDefined1></UserDefined1>
					<UserDefined2></UserDefined2>
					<UserDefined3></UserDefined3>
					<UserDefined4></UserDefined4>
					<UserDefined5></UserDefined5>
					<HashValue>".$this->hash(sprintf("%012d",$invoiceID),sprintf("%012d",($amount*100)))."</HashValue>
				</OneTwoThreeReq>";

				/*
					<AgentCode>BBL</AgentCode>
					<ChannelCode>ATM</ChannelCode>
				*/
		
		$encryptMsg = $this->encrypt($invoiceID,$msg);

		$resp = "<html><head></head><body><form method=post action=\"".$this->requestUrl."\" id=\"sbfrom\">
				<input type=\"hidden\" name=\"OneTwoThreeReq\" value=\"".$encryptMsg."\">
				<input type=\"submit\" style=\"display:none\" value=\"Send\" name=\"submit\"> </form>
				<script type=\"text/javascript\">document.getElementsByTagName(\"input\")[1].click();</script></body></html";
		return $resp;
	}

	public function submitPayload($transactionID,$amout,$currencyCode){

		 $uniqueTransactionCode = "Invoice".time();
		 $desc = "1 room for 2 nights";



	}

	private function hash($invoice,$amount){
		return strtoupper(hash_hmac('sha1',$this->merchantID.$invoice.$amount,$this->secretKey,false));
	}
	private function encrypt($invoice,$msg){
		$key = file_get_contents(APPPATH."libraries/one23pay/123Public.pem"); //public key for encrypt. This is 123's public key
		$filehash = $invoice.'_'.time();
		$encfile = $this->encryptPath.'enc_'.$filehash;
		$msgfile = $this->encryptPath.'msg_'.$filehash;

		try{
			file_put_contents($msgfile,$msg);
		    if (openssl_pkcs7_encrypt($msgfile, $encfile, $key, array())) {
		        $tempStr = file_get_contents($encfile);
		        $strOri = "MIME-Version: 1.0
Content-Disposition: attachment; filename=\"smime.p7m\"
Content-Type: application/x-pkcs7-mime; smime-type=enveloped-data; name=\"smime.p7m\"
Content-Transfer-Encoding: base64

";
				$pos = strpos($tempStr, "base64");
				$tempStr=trim(substr($tempStr,$pos+6));
				unlink($encfile);
				unlink($msgfile);
		        return str_replace($strOri,"",$tempStr);
		    }else{
		    	echo "Error";
				error_log("Encrypt error on One23Payment Library =>".$msgfile);
				unlink($encfile);
				return false;
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	private function decrypt($encMsg,$msg){
		$filehash = $invoice.'_'.time();
		$encfile = $this->decryptPath.'enc_'.$filehash;
		$msgfile = $this->decryptPath.'msg_'.$filehash;
		file_put_contents($encfile,$encMsg);

		$strOri = "MIME-Version: 1.0
Content-Disposition: attachment; filename=\"smime.p7m\"
Content-Type: application/x-pkcs7-mime; smime-type=enveloped-data; name=\"smime.p7m\"
Content-Transfer-Encoding: base64

";
	    $enc = file_get_contents($encfile);
	    $enc = wordwrap($enc, 64, "\n", true);
	    if($fp = fopen($encfile, "w")){
	    	fwrite($fp, $strOri.$enc);
	    	fclose($fp);	
	    }else{
	    	error_log("Can't write file ".$encfile);
	    	return false;
	    }
	    
	    if (openssl_pkcs7_decrypt($encfile, $msgfile, $this->secretKey, $this->privatekey)) {
	        return file_get_contents($msgfile);
	    }else 
		{
	        error_log("Can't decrypt on One23Payment Library =>".$encfile);
			return false;
		}
	}
}

?>