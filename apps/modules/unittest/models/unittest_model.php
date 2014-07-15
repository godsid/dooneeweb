<?php
class Unittest_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function testconnect(){
		var_dump($this->db->query("SELECT 1"));
	}
		
}
?>