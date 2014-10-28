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
			'brandLogo'=>'http://www.dooneetv.com/assets/img/logo-thai-s1.png',
			'appId'=>''

		);
	public function __construct()
    {
        parent::__construct();
        $this->load->config('samsung');
        $this->uid = $this->input->get_post('uid');
        
        if(!$this->limit = $this->input->get_post('max')){
            $this->limit = 200;
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
    public function videoUrlHash($basepath){
        $secret = $this->config->item('samsung_video_secret'); // To make the hash more difficult to reproduce.
        $baseuri = '/shc/hd/MISS_POTTER_HD'; // This is the file to send to the user.
        //$uri  = "$baseuri/playlist.m3u8"; // This is the file to send to the user. 
        //$uri    =  $_GET["contenturl"];  //change to your content location ex. "media.imovie.com/movie1.mp4"
        $e = time() + 6000; // At which point in time the file should expire. time() + x; would be the usual usage.
        $rawhash=$secret . $basepath . $e . "203.151.27.70";//$_SERVER['REMOTE_ADDR'];
        //echo "<p>" . $rawhash . "</p>";
        $m = base64_encode(md5($rawhash , true)); // Using binary hashing.
        $m = strtr($m, '+/', '-_'); // + and / are considered special characters in URLs, see the wikipedia page linked in references.
        $m = str_replace('=', '', $m); // When used in query parameters the base64 padding character is considered special.
        //You have 60 seconds to access via this link
        return array('hash'=>"?m=".$m."&e=".$e,'rawhash'=>$rawhash);
    }
}