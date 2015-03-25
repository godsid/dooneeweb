<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Samsung_allowip {
	var $ips = array(
		//korea
		"210.94.41.89",
		"222.117.150.186",
		"222.117.150.187",
		"222.117.150.188",
		"112.136.185.253",
		"124.194.98.154",
		"124.194.98.155",
		"124.194.98.156",
		"124.194.98.157",
		"124.194.98.158",
		
		//indea
		"14.141.49.234",
		"14.141.49.226",
		"61.246.186.198"
	);
	
	public function is_allow($ip){
		return in_array($ip, $this->ips);
	}
}