<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'libraries/SAMSUNG_Controller.php');
class Home extends SAMSUNG_Controller {
	var $user;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','mUser');
		if(!$this->user = $this->mUser->getUser($this->uid)){
			$this->mUser->register($this->uid);
		}
		$this->head['title'] = "DooneeTV";

	}

	public function index()
	{

		$this->load->model('samsung/movie_model','mMovie');

		//$this->load->model('api/banner_model','mBanner');

		/*$banners = $this->mBanner->getBanners(1,1);
		for($i=0,$j=sizeof($banners);$i<$j;$i++){
			$banners[$i] = array(
								'id'=>$banners[$i]['banner_id'],
								'type'=>'web',
								'title'=>$banners[$i]['title'],
								'description'=>$banners[$i]['description'],
								'icon'=>static_url($banners[$i]['cover']),
								'nextTo'=>'web',
								'url'=>$banners[$i]['link']
							);		
		}
		*/
		$banners[] = 
					array(
						'id'=>'1',
						'type'=>'',
						'title'=>'',
						'description'=>'',
						'icon'=>static_url('/img/samsung_banner_1080x540.jpg'),
						'nextTo'=>'',
						'url'=>''
						);
						
					
		$item[] = array(
							'id'=>1,
							'type'=>'category',
							'title'=>'PREMIUM (PAID)',
							'description'=>'พบซีรี่ย์ดังจาก Holywood ที่เยอะที่สุด',
							'icon'=>static_url('/img/samsung-premium3.png'),
							'nextTo'=>'contentGrid',
							'url'=>base_url('/samsung/movie/premium')
					);
		$item[] = array(
						'id'=>2,
							'type'=>'category',
							'title'=>'SAMSUNG PRIVILEGE (FREE)',
							'description'=>'ดูซีรี่ย์ดัง 2ตอนแรกฟรี',
							'icon'=>static_url('/img/samsung-free.png'),
							'nextTo'=>'contentGrid',
							'url'=>base_url('/samsung/movie/free')
					);
		
		//$item = array();
		//if($this->page==1){
			//First page is hot movie
		//$movie = $this->mMovie->getMoviesHotFirst($this->page,$this->limit);	
		//}else{
		//	$movie = $this->mMovie->getNotHotMovies($this->page,$this->limit);
		//}
		/*
		$countItem = $this->mMovie->getMovieCount();
		$movie = $movie['items'];
		for($i=0,$j=sizeof($movie);$i<$j;$i++){
			$item[] = array(
						'id'=>$movie[$i]['movie_id'],
						'type'=>'movie',
						'title'=>($movie[$i]['is_hot']=='YES'?'[HOT]':'').$movie[$i]['title'],
						'description'=>$movie[$i]['summary'],
						'icon'=>static_url($movie[$i]['cover']),
						'nextTo'=>($movie[$i]['is_series']=='YES')?'ContentGrid':'movieDetail',
						'url'=>samsung_api_url('/movie/'.$movie[$i]['movie_id'])
						);
		}
		*/

		$data = array(
						//'bannerItem'=>&$banners,
						'item'=>&$item
						//'total'=>$countItem
				);
		
		$this->response($data);
		
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */