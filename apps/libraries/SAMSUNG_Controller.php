<?php defined('BASEPATH') or exit('No direct script access allowed');
abstract class SAMSUNG_Controller extends CI_Controller
{
    var $uid = "";
	var $head = array(
			'title'=>'',
			'text'=>'',
			'description'=>'',
			'backgroundColor'=>'#000000',
			'backgroundImage'=>'',//252x449
			'url'=>'',
			'brandLogo'=>'http://www.doonee.tv/assets/img/logo.png',
			'appId'=>''

		);
	public function __construct()
    {
        parent::__construct();
        $this->load->config('samsung');
        $this->uId = $this->input->get_post('uId');
        
        if(!$this->limit = $this->input->get_post('max')){
            $this->limit = 12;
        }
        if($this->page = $this->input->get_post('offset')){
            $this->page = (int)ceil($this->page/$this->limit);
        }else{
            $this->page = 1;
        }
        
        $this->head['logo'] = $this->config->item('samsung_logo');
        $this->head['title'] = $this->config->item('samsung_title');
        $this->head['description'] = $this->config->item('samsung_description');
        $this->head['backgroundColor'] = $this->config->item('samsung_background_color');
        $this->head['backgroundImage'] = $this->config->item('samsung_background_image');
        $this->head['title'] = $this->config->item('samsung_title');
        $this->head['appId'] = $this->config->item('samsung_appid');
    }
    public function response($data = null, $http_code = null, $continue = false){
    	header("Content-type: Application/json; Charset: utf8;");
    	$data = array_merge(array('head'=>$this->head),$data);
    	echo json_encode($data);
    }
}