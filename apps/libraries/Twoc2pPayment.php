<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
}