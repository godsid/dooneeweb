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
			'appId'=>'1'

		);

	public function __construct(){
		parent::__construct();
		header("Content-type: Application/json; Charset:utf8;");
		$this->load->config('samsung');
		$this->load->model('samsung/movie_model','mMovie');
	}


	public function index($movieID="",$episodeID=null){
		$resp['item'] = array();
		if(is_numeric($movieID)&&is_numeric($episodeID)){
			$resp = $this->seriesDetail($movieID,$episodeID);
		}elseif(is_numeric($movieID)){
			$movie = $this->mMovie->getMovie($movieID);
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
		
		return $resp;	
	}
	private function seriesDetail($movie,$episodeID){
		$resp['item'] = array();

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
									'nextTo'=>'playNow',
									'url'=>$episode['path'],//samsung_api_url('/movie/'.$episode['movie_id'].'/'.$episode['episode_id'])
								);	
		}
		$resp['total'] = $episodes['pageing']['allItem'];
		return $resp;
	}

	public function privilege(){
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
	}

	public function paid(){
		$this->head['title'] = 'PREMIUM (PAID)';
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
							'nextTo'=>($privilages[$i]['is_series']=='YES')?'ContentGrid':'movieDetail',
							'url'=>samsung_api_url('/movie/'.$privilages[$i]['movie_id'])
						);
		}
		$data['purchase'] = array(
								'contentId'=>'samsung',
								'appId'=>1,
								'price'=>'299',
								'type'=>'30Day',
								'dateExpired'=>0,
								'isPurchased'=>"no",
							);
		$data['purchaseList'] = array(
								'isPurchased'=>'no',
								'dateExpired'=>'0',
								'priceList'=>array(
												array(
													'title'=>'19 Baht/Day',
													'typeTitle'=>'ชาระผา่นบตัรเครดติ',
													'contentId'=>'buffet1Day',
													'appId'=>1,
													'price'=>19,
													'type'=>'payCoin',
													'priceIcon'=>'https://logicshowtime.meevuu.com:8449/priceIcon/service_icon-3.png',
													'confirmMSG'=>'Do you want to subscribe to PREMIUM (PAID) for 19 Baht/Day?'
													),
											)

							);
		$data['item'] = &$privilages;
		$data['total'] = $total;
		$this->response($data);
	}

	public function play($movieID,$episodeID=null){

	}

	//public function movie($movieID){
		//$data = $this->mMovie->getMovie($movieID);
		//$this->mMovie->rewiteData($data);
		



	//	$this->response($data);
	//} 
	
	
}

/* End of file movie.php */
/* Location: ./application/controllers/movie.php */