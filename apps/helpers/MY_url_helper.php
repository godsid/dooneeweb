<?php defined('BASEPATH') OR exit('No direct script access allowed');

function static_url($path=""){
	$CI =& get_instance();
	return $CI->config->item('static_url').$path;
}
function backoffice_url($path=""){
	$CI =& get_instance();
	return $CI->config->item('backoffice_url').$path;	
}
?>