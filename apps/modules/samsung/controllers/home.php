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
		$this->head['title'] = "Doonee.TV";

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
		$item[] = array(
						'id'=>1,
							'type'=>'category',
							'title'=>'PREMIUM (PAID)',
							'description'=>'พบซีรี่ย์ดังจาก Holywood ที่เยอะที่สุด',
							'icon'=>'https://logicshowtime.meevuu.com:8449/pageIcon/buffet_premium-1.png',
							'nextTo'=>'contentGrid',
							'url'=>base_url('/samsung/movie/premium')
					);
		$item[] = array(
						'id'=>2,
							'type'=>'category',
							'title'=>'SAMSUNG PRIVILEGE (FREE)',
							'description'=>'ดูซีรี่ย์ดังจาก Holywood ที่เยอะที่สุดฟรี',
							'icon'=>'https://logicshowtime.meevuu.com:8449/pageIcon/samsung_privilege-1.png',
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
						'item'=>&$item
						//'total'=>$countItem
				);
		
		$this->response($data);
		
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */