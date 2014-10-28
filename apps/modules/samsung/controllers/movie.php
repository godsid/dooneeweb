<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(APPPATH.'libraries/SAMSUNG_Controller.php');
class Movie extends SAMSUNG_Controller {
	var $page = 0;
	var $limit = 10;
	var $head = array(
			'title'=>'',
			'text'=>'',
			'description'=>'',
			'backgroundColor'=>'#000000',
			'backgroundImage'=>'https://logicshowtime.meevuu.com:8443/appThumbImg/bg_main-2.png',
			'url'=>'',
			'brandLogo'=>'http://www.dooneetv.com/assets/img/logo-thai-s1.png',
			'appId'=>''

		);
	var $user;
	public function __construct(){
		parent::__construct();
		header("Content-type: Application/json; Charset:utf8;");
		$this->load->config('samsung');
		$this->load->model('samsung/movie_model','mMovie');
		$this->load->model('user_model','mUser');
		$this->load->model('package_model','mPackage');	
		$this->user = $this->mUser->getUser($this->uid);
	}

	public function index($movieID="",$episodeID=null){

		redirect(samsung_api_url(''));
		/*
		$resp['item'] = array();
		$movie = $this->mMovie->getMovie($movieID);

		if(sizeof($movie)&&is_numeric($movieID)&&is_numeric($episodeID)){
			$resp = $this->seriesDetail($movie,$episodeID);
		}elseif(sizeof($movie)&&is_numeric($movieID)){
			if($movie['is_series']=='YES'){
				$resp = $this->seriesEpisode($movie);
			}
			else{
				$resp = $this->movieDetail($movie);
			}
		}
		$this->response($resp);
		*/
	}
	/*
	private function movieDetail($movie){
		$resp['item'] = array(
							'id'=> $movie['movie_id'],
							'title'=> $movie['title'],
							'titleEng'=> $movie['title_en'],
							'tag'=> "-",
							'director'=> ucwords(strtolower($movie['director'])),
							'writer'=> '-',
							'actor'=> ucwords(strtolower($movie['cast'])),
							'genre'=> '-',
							'detail'=> $movie['description'],
							'thumbnail'=> static_url($movie['cover']),
							'content'=> $movie['path'],
							'coverImage'=> static_url($movie['cover']),
							'releaseDate'=> '',
							'year'=> $movie['year'],
							'movieRating'=> $movie['rating'],
							'duration'=> $movie['length'],
							'screenshot'=>array(),
							'rating'=> $movie['score'],
							'weight'=> '-',
							'sound'=> $movie['audio'],
							'subtitle'=> $movie['subtitle'],
							'priceID'=> "",
							'price'=> "",
							'pricePromotion'=> "-",
							'currency'=> "THB",
							'relatedMovie'=> "",
							'isPurchased'=> "no",
							'isComingSoon'=> "no",
							'securityType'=> "basicAuth",
							'urlContent'=> ""
						);
		if($movie['is_free']!='YES'){
			$purchase = $this->isPurchased($movie['movie_id']);
			$resp['item']['isPurchased'] = $purchase['purchaseList']['isPurchased'];
			$resp = array_merge($purchase,$resp);
		}
		return $resp;
	}
	*/
	/*
	private function seriesEpisode($movie){
		$resp['item'] = array();
		$this->head['title'] = $movie['title'].' ('.$movie['title'].')';
		$episodes = $this->mMovie->getMovieEpisode($movie['movie_id'],$this->page,$this->limit);
		foreach($episodes['items'] as $episode){
			$resp['item'][] = array(
									'id'=>$episode['movie_id'],
									'type'=>'movie',
									'title'=>$episode['title'],
									'description'=>$movie['summary'],
									'icon'=>static_url($movie['cover']),
									'nextTo'=>'playNow',//'MovieDetail'
									'url'=>samsung_api_url('/movie/'.$episode['movie_id'].'/'.$episode['episode_id'])
								);	
		}
		
		$purchase = $this->isPurchased($movie['movie_id']);
		$resp['item']['isPurchased'] = $purchase['purchaseList']['isPurchased'];
		$resp = array_merge($purchase,$resp);
		$resp['total'] = $episodes['pageing']['allItem'];
		return $resp;
	}
	*/

	/*
	private function seriesDetail($movie,$episodeID){
		$resp['item'] = $resp['item'] = array(
							'id'=> $movie['movie_id'],
							'title'=> $movie['title'],
							'titleEng'=> $movie['title_en'],
							'tag'=> "-",
							'director'=> ucwords(strtolower($movie['director'])),
							'writer'=> '-',
							'actor'=> ucwords(strtolower($movie['cast'])),
							'genre'=> '-',
							'detail'=> $movie['description'],
							'thumbnail'=> static_url($movie['cover']),
							'content'=> $movie['path'],
							'coverImage'=> static_url($movie['cover']),
							'releaseDate'=> '',
							'year'=> $movie['year'],
							'movieRating'=> $movie['rating'],
							'duration'=> $movie['length'],
							'screenshot'=>array(),
							'rating'=> $movie['score'],
							'weight'=> '-',
							'sound'=> $movie['audio'],
							'subtitle'=> $movie['subtitle'],
							'priceID'=> "",
							'price'=> "",
							'pricePromotion'=> "-",
							'currency'=> "THB",
							'relatedMovie'=> "",
							'isPurchased'=> "no",
							'isComingSoon'=> "no",
							'securityType'=> "basicAuth",
							'urlContent'=> ""
						);
		$purchase = $this->isPurchased($movie['movie_id']);
		$resp['item']['isPurchased'] = $purchase['purchaseList']['isPurchased'];
		$resp = array_merge($purchase,$resp);
		return $resp;
	}
	*/
	public function premium(){
		$this->head['title'] = 'ซีรี่ย์ฮอลลีว้ดูกวา่600เรื่อง (Premium)';
		$this->head['text'] = 'รับชม!ซีรี่ย์ฮอลลีว้ดูกวา่600เรื่อง';
		$this->head['description'] = '';
		$premiums = $this->mMovie->getMovies($this->page,$this->limit);
				
		$total = $premiums['pageing']['allItem'];
		$data['item'] = array();
		$premiums = $premiums['items'];
		for($i=0,$j=count($premiums);$i<$j;$i++){
			$premiums[$i] = array(
							'id'=>$premiums[$i]['movie_id'],
							'type'=>'movie',
							'title'=>$premiums[$i]['title'],
							'description'=>$premiums[$i]['summary'],
							'icon'=>static_url($premiums[$i]['cover']),
							'nextTo'=>'ContentList',
							'url'=>samsung_api_url('/movie/language/premium/'.$premiums[$i]['movie_id'])
						);
		}
		$data['item'] = &$premiums;
		$data['total'] = $total;
		$this->response($data);
		
	}

	public function free(){
		
		$this->head['title'] = 'SAMSUNG PRIVILEGE (FREE)';
		$this->head['text'] = 'รับชมฟรีซีรี่ย์ฮอลลีว้ดูกวา่100เรื่อง';
		$this->head['description'] = 'พบซีรี่ย์ดังจาก Holywood ที่เยอะที่สุด';
		$free = $this->mMovie->getMoviesFree($this->page,$this->limit);
		
		$total = $free['pageing']['allItem'];
		$data['item'] = array();
		$free = $free['items'];
		for($i=0,$j=count($free);$i<$j;$i++){
			$free[$i] = array(
							'id'=>$free[$i]['movie_id'],
							'type'=>'movie',
							'title'=>$free[$i]['title'],
							'description'=>$free[$i]['summary'],
							'icon'=>static_url($free[$i]['cover']),
							'nextTo'=>'ContentList',
							'url'=>samsung_api_url('/movie/language/free/'.$free[$i]['movie_id'])
						);
		}
		$data['item'] = &$free;
		$data['total'] = $total;
		$this->response($data);
	}


	public function language($type='',$movieID=""){
		if(empty($type)||empty($movieID)){
			redirect(samsung_api_url(''));
		}

		$movie = $this->mMovie->getMovie($movieID);
		$this->head['title'] = "เลือกภาษา";
		$this->head['text'] = $movie['title'];

		if($movie['is_hd']=='YES'){
			$urlEN = samsung_api_url('/movie/quality/'.$type.'/en/'.$movieID);
			$urlTH = samsung_api_url('/movie/quality/'.$type.'/th/'.$movieID);
		}else{
			$urlEN = samsung_api_url('/movie/episode/'.$type.'/en/SD/'.$movieID);
			$urlTH = samsung_api_url('/movie/episode/'.$type.'/th/SD/'.$movieID);
		}
		
		$language['item'][] = array(
							'id'=>$movie['movie_id'],
							'type'=>'movie',
							'title'=>"EN-".$movie['title'],
							'description'=>$movie['summary'].' Eng',
							'icon'=>static_url($movie['cover']),
							'nextTo'=>'ContentList',
							'url'=>$urlEN
						);
		$language['item'][] = array(
							'id'=>$movie['movie_id'],
							'type'=>'movie',
							'title'=>"TH-".$movie['title'],
							'description'=>$movie['summary'].' Thai',
							'icon'=>static_url($movie['cover']),
							'nextTo'=>'ContentList',
							'url'=>$urlTH
						);
		
		$data = &$language;
		$data['total'] = count($language['item']);
		$this->response($data);
	}

	public function quality($type='',$lang='',$movieID=''){
		if(empty($type)||empty($movieID)){
			redirect(samsung_api_url(''));
		}
		$movie = $this->mMovie->getMovie($movieID);
		$this->head['title'] = "เลือกความคมชัด";
		$this->head['text'] = $movie['title'];
		$language['item'][] = array(
							'id'=>$movie['movie_id'],
							'type'=>'movie',
							'title'=>"HD-".$movie['title'],
							'description'=>$movie['summary'].' '.strtoupper($lang),
							'icon'=>static_url($movie['cover']),
							'nextTo'=>'ContentList',
							'url'=>samsung_api_url('/movie/episode/'.$type.'/'.$lang.'/HD/'.$movieID)
						);
		$language['item'][] = array(
							'id'=>$movie['movie_id'],
							'type'=>'movie',
							'title'=>"SD-".$movie['title'],
							'description'=>$movie['summary'].' '.strtoupper($lang),
							'icon'=>static_url($movie['cover']),
							'nextTo'=>'ContentList',
							'url'=>samsung_api_url('/movie/episode/'.$type.'/'.$lang.'/SD/'.$movieID)
						);
		
		$data = &$language;
		$data['total'] = count($language['item']);
		$this->response($data);
	}

	public function episode($type='',$lang='',$quality='',$movieID=''){
		if(empty($type)||empty($movieID)||empty($lang)){
			redirect(samsung_api_url(''));
		}
		$movie = $this->mMovie->getMovie($movieID);
		$this->head['title'] = "เลือกตอน";
		$this->head['text'] = $movie['title'].' '.strtoupper($lang);

		$series = array();
		if($type=='free'){
			$episodes = $this->mMovie->getMovieEpisode($movieID,0,2);
		}else{
			$episodes = $this->mMovie->getMovieEpisode($movieID,$this->page,$this->limit);
		}

		if($quality=='HD'){
			$screen = "720";
		}else{
			$screen = "480";
		}

		foreach($episodes['items'] as $episode){

			$hash = $this->videoUrlHash("/series/".$episode['path'].$lang.$screen);
			if(!isset($_GET['debug'])){
				$hash['rawhash'] = "";
			}
			$series[] = array(
								'id'=>$episode['movie_id'],
								'type'=>'movie',
								'title'=>$episode['title'].' '.(($lang=='en')?'Eng':'Thai').' '.$quality,
								'description'=>$movie['summary'],
								'icon'=>static_url($movie['cover']),
								'nextTo'=>'playNow',
								'url'=>$this->config->item('samsung_cdn_url')."series/".$episode['path'].$lang.$screen."/".$episode['path'].$lang.$screen.".m3u8".$hash['hash'],
								'rawhash'=>$hash['rawhash']
							);
			//series/7c64132d62480.m3u8
			//str_replace(array('vods','mp4:','rtmp'),array('vod','','rtsp'),series_stream_url($episode['path'],'480',$lang))
		}
		$data = array();
		if($type!='free'){
			$purchase = $this->isPurchased($movie['movie_id']);
			$data = $this->isPurchased($movie['movie_id']);
		}
		
		
		$data['item'] = &$series;
		if($type=='free'){
			$data['total'] = count($episodes['items']);
		}else{
			$data['total'] = $episodes['pageing']['allItem'];
		}
		
		
		$this->response($data);
	}

	private function isPurchased($movieID='',$seriesID=''){
		if(isset($this->user['user_id'])&&!empty($this->user['user_id'])){
			$package = $this->mUser->getUserPackage($this->user['user_id']);
		}else{
			$package = array();
		}

		
		$expireDate = isset($package['expire_date'])?strtotime($package['expire_date'])-time():'0';
		$data['purchaseList'] = array(
									'isPurchased'=>($expireDate?'yes':'no'),
									'dateExpired'=>$expireDate
								);

		$packages = $this->mPackage->getPackagePartner('SAMSUNG');
		foreach($packages as $package){
			$data['purchaseList']['priceList'][] = array(
													'title'=>$package['title'],
													'typeTitle'=>'ชำระผ่านบัตรเครดิต',
													'contentId'=>$package['name'],
													'appId'=>$this->config->item('samsung_appid'),
													'price'=>$package['price'],
													'type'=>'payCoin',
													'priceIcon'=>'https://logicshowtime.meevuu.com:8449/priceIcon/service_icon-3.png',
													'confirmMSG'=>'Do you want to subscribe to PREMIUM (PAID) ?'
													);
		}
		return $data;
	}
}

/* End of file movie.php */
/* Location: ./application/controllers/movie.php */