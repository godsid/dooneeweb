<?php defined('BASEPATH') or exit('No direct script access allowed');
abstract class SAMSUNG_Controller extends CI_Controller
{
	var $head = array(
			'title'=>'MOVIES',
			'text'=>'',
			'description'=>'',
			'backgroundColor'=>'#000000',
			'backgroundImage'=>'https://logicshowtime.meevuu.com:8443/appThumbImg/bg_main-1.png',
			'url'=>'',
			'brandLogo'=>'http://www.doonee.tv/assets/img/logo.png',
			'appId'=>'1'

		);
	public function __construct()
    {
        parent::__construct();
        if($this->input->get('offset')){
            $this->page = $this->input->get('offset');
        }
        if($this->input->get('max')){
            $this->limit = $this->input->get('max');
        }
    }
    public function response($data = null, $http_code = null, $continue = false){
    	header("Content-type: Application/json; Charset: utf8;");
    	$data = array_merge(array('head'=>$this->head),$data);
    	echo json_encode($data);
    }
}