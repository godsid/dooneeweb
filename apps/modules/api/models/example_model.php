<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example_model extends ADODB_Model 
{
	function __construct(){
		parent::__construct();
		
	}

	function test(){
		return $this->adodb->Execute("SELECT 1 AS row");
	}
}
?>