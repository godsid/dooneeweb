<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Docs extends CI_Controller {

    public function __construct(){

    }

    public function index($file=""){
    	$this->load->view('docs/'.$file);
    }
}