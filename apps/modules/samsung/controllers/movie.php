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
			'brandLogo'=>'http://www.doonee.tv/assets/img/logo.png',
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
		$this->user = $this->mUser->getUser($this->uId);
	}

	public function index($movieID="",$episodeID=null){
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
	}

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

	public function free(){
		/*
		$this->head['title'] = 'SAMSUNG PRIVILEGE (FREE)';
		$this->head['text'] = 'รับชมฟรีซีรี่ย์ฮอลลีว้ดูกวา่100เรื่อง';
		$this->head['description'] = '';
		$privilages = $this->mMovie->getMoviesPrivilage($this->page,$this->limit);
		
		$total = $privilages['pageing']['allItem'];
		$data['item'] = array();
		$privilages = $privilages['items'];
		for($i=0,$j=count($privilages);$i<$j;$i++){
			$privilages[$i] = array(
							'id'=>$privilages[$i]['movie_id'],
							'type'=>'movie',
							'title'=>$privilages[$i]['title'],
							'description'=>$privilages[$i]['summary'],
							'icon'=>static_url($privilages[$i]['cover']),
							'nextTo'=>($privilages[$i]['is_series']=='YES')?'ContentGrid':'movieDetail',
							'url'=>samsung_api_url('/movie/'.$privilages[$i]['movie_id'])
						);
		}
		$data['item'] = &$privilages;
		$data['total'] = $total;
		$this->response($data);
		*/
	}

	public function premium(){
		$this->head['title'] = ' (Premium)';
		$this->head['text'] = 'รับชม!ซีรี่ย์ฮอลลีว้ดูกวา่600เรื่อง';
		$this->head['description'] = '';
		$privilages = $this->mMovie->getMoviesPrivilage($this->page,$this->limit);
				
		$total = $privilages['pageing']['allItem'];
		$data['item'] = array();
		$privilages = $privilages['items'];
		for($i=0,$j=count($privilages);$i<$j;$i++){
			$privilages[$i] = array(
							'id'=>$privilages[$i]['movie_id'],
							'type'=>'movie',
							'title'=>$privilages[$i]['title'],
							'description'=>$privilages[$i]['summary'],
							'icon'=>static_url($privilages[$i]['cover']),
							'nextTo'=>($privilages[$i]['is_series']=='YES')?'ContentGrid':'playNow',
							'url'=>samsung_api_url('/movie/'.$privilages[$i]['movie_id'])
						);
		}
		$data['item'] = &$privilages;
		$data['total'] = $total;
		$this->response($data);
		
	}



	private function isPurchased($movieID='',$seriesID=''){
		
		$package = $this->mUser->getUserPackage($this->user['user_id']);
		$expireDate = isset($package['expire_date'])?strtotime($package['expire_date'])-time():'0';
		$data['purchaseList'] = array(
									'isPurchased'=>($expireDate?'yes':'no'),
									'dateExpired'=>$expireDate
								);

		$packages = $this->mPackage->getPackagePartner('SAMSUNG');
		foreach($packages as $package){
			$data['purchaseList']['priceList'][] = array(
													'title'=>$package['title'],
													'typeTitle'=>'ชาระผา่นบตัรเครดติ',
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