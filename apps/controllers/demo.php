<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demo extends CI_Controller {
    var $categories;
    var $memberLogin;
    var $package;
    public function __construct(){
        parent::__construct();
        $this->load->library('One23Payment');
        $this->load->library('Twoc2pPayment');
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('package_model','mPackage');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();
        //if(!$this->memberLogin){
        //    redirect(home_url());
        //}
    }

    public function index(){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        $view['packages'] = $this->mPackage->getPackages();
        $this->load->view('web/payment',$view);
    }
    public function creditcard($package_id=""){
        

        $xml = "";
        if($encryptedCardInfo = $this->input->post('encryptedCardInfo')){
            $this->validate($package_id);
            $messageID = $this->getMessageID();
            if($invoice_id = $this->createInvoice($messageID,$this->memberLogin['user_id'],$package_id,'CREDITCARD','',$this->package['price'],$this->package['title'],"")){
                $view['form'] = $this->twoc2ppayment->createForm($messageID,$invoice_id,$this->package['price'],$this->package['title'],$encryptedCardInfo);
                //var_dump($view);
                $this->load->view('web/payment_submit',$view);
            }
        }else{
            redirect('/package');
        }
    }

    public function ip(){
        $this->load->library('geoip_lib');
        echo $this->input->ip_address();
        var_dump($this->geoip_lib->InfoIP($this->input->ip_address()));

        var_dump($this->geoip_lib->result_country_code());
    }

    public function ios($movieId="",$episodeId=""){
        $this->load->model('movie_model','mMovie');
        $this->load->model('episode_model','mEpisode');
        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)||$view['movie']['is_free']=='YES') ;
        }

        //Series Episode
        if($view['movie']['is_series']=='YES'){
            $episodes = $this->mMovie->getMovieEpisode($movieId);
            $view['episodes'] = $episodes['items'];
            unset($episodes);
            if(is_numeric($episodeId)){
                $view['thisEpisode'] = $this->mEpisode->getEpisode($episodeId);
            }else{
                $view['thisEpisode'] = $this->mEpisode->getEpisode($view['episodes'][0]['episode_id']);
            }
            $view['moviePath'] = 'series/'.$view['thisEpisode']['path'];
        }else{
            $view['moviePath'] = 'movies/'.$view['movie']['path'];
        }
        

        $this->load->view('web/player_ios',$view);
    }

    public function notConvert(){
        $this->load->model('backoffice/episode_model','mEpisode');
        $epidodes = $this->mEpisode->getAllEpisodes(1,10000);
        
        $convert_command = "ffmpeg -i {input} -c:a aac -cutoff 15000 -ab 96k -ar 44100 -ac 2 -strict experimental -async 1 -c:v libx264 -b:v 500k -maxrate 500k -bufsize 1000k -r 25 -s 640x480 -aspect 16:9 -trellis 1 -coder ac -subq 7 -me_range 16 -bf 3 -b_strategy 1 -refs 3 -partitions partb8x8+partp4x4+partp8x8+parti8x8 -flags +loop -me_method hex -direct-pred 1 -rc_lookahead 40 -qmin 3 -qmax 51 -qdiff 4 -weightb 1 -8x8dct 1 -fast-pskip 1 -b-pyramid 1 -sc_threshold 40 -sn -threads 8 -y {output}";
        echo "#!/bin/bash\r\n\r\n";
        foreach($epidodes['items'] as $epidode){
            if(is_file('/disk2/series/'.$epidode['path'].'th720.mp4')&&!is_file('/disk2/series/'.$epidode['path'].'th480.mp4')){
                echo str_replace(
                    array("{input}","{output}"),
                    array("../".$epidode['path']."th720.mp4",$epidode['path']."th480.mp4"),
                    $convert_command),"\r\n";
            }
            if(is_file('/disk2/series/'.$epidode['path'].'en720.mp4')&&!is_file('/disk2/series/'.$epidode['path'].'en480.mp4')){
                echo str_replace(
                    array("{input}","{output}"),
                    array("../".$epidode['path']."en720.mp4",$epidode['path']."en480.mp4"),
                    $convert_command),"\r\n";
            }
        }
    }
}