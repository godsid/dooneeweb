<?php 

class Paysbuypayment(){

	var $CI;
	var $config;
	function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('payment');

		
	}



}