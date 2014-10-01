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
}