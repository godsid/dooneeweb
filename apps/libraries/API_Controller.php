<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');
abstract class API_Controller extends REST_Controller
{
	public function __construct()
    {
        parent::__construct();
        
        if(!$this->limit = $this->get('limit')){
            $this->limit = 30;
        }
        if($this->page = $this->get('page')){
            $this->page = (int)ceil($this->page/$this->limit);
        }else{
            $this->page = 1;
        }
    }

    public function error($message=""){
        $this->response(array('status'=>'error','message'=>$message),200);
        exit;
    }
    public function success($data,$message=""){
        $this->response(array('status'=>'success','message'=>$message,'items'=>$data),200);
        exit;
    }
}