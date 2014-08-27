<?php defined('BASEPATH') OR exit('No direct script access allowed');

function home_url(){
	$CI =& get_instance();
	return $CI->config->item('home_url');
}
function static_url($path=""){
	$CI =& get_instance();
	return $CI->config->item('static_url').$path;
}
function backoffice_url($path=""){
	$CI =& get_instance();
	return $CI->config->item('backoffice_url').$path;	
}
function static_path($path=""){
	$CI =& get_instance();
	return $CI->config->item('static_path').date('/Y/').$path;
}

function samsung_api_url($path=""){
	$CI =& get_instance();
	return $CI->config->item('samsung_api_url').$path;
}

?>