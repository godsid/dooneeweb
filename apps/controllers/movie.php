<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class movie extends CI_Controller {
    var $categories;
    var $page;
    var $limit;
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('movie_model','mMovie');
        $this->categories = $this->mCategory->getCategoriesMenu();        
        $this->page = $this->input->get('page'); $this->page = $this->page?$this->page:1;
        $this->limit = $this->input->get('limit'); $this->limit = $this->limit?$this->limit:30;

    }

    public function index($movieId="",$episodeId="",$debug=null){
        if(is_numeric($movieId)){
            $this->detail($movieId,$episodeId,$debug);
        }else{
            $this->archive();
        }
    }
    private function detail($movieId,$episodeId="",$debug=null){
        $this->load->model('episode_model','mEpisode');
        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)||$view['movie']['is_free']=='YES') ;
            $is_favorite = $this->mMember->isMemberFavorites($view['memberLogin']['user_id'],$movieId);
            if(is_array($is_favorite)&&sizeof($is_favorite)){
                $view['memberLogin']['is_favorite'] = array_pop($is_favorite);
            }
            unset($is_favorite);
        }
        $view['categories'] = $this->categories;

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
        }
        //Movie Relate
        $relates = $this->mMovie->getMovieRelate($movieId,1,10);
        if($relates['pageing']['allItem']){
            $view['relates'] = $relates['items'];
        }
        unset($relates);
		$view['debug'] = $debug;
		if(!empty($view['memberLogin']['user_id'])){
			$watched = $this->mMovie->getEpisodeHistory($view['memberLogin']['user_id'],$movieId,1,100);
		}
		$view['watched'] = array();
		if(!empty($watched['items'])){
			foreach($watched['items'] as $item){
				$view['watched'][] = $item['episode_id'];
			}
			
		}
		
		$this->load->view('web/movie_detail',$view);
    }

    private function archive(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMovies($this->page,$this->limit);

        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
        
    }
    public function cate($category_id){

        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesCategory($category_id,$this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function hot(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesHot($this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function series(){
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['movies'] = $this->mMovie->getMoviesSeries($this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function search(){
        $q = $this->input->get('q');
        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['search'] = $q;
        $view['movies'] = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function suggestion(){
        $q = $this->input->get('q');
        $movies = $this->mMovie->getMoviesSearch($q,$this->page,$this->limit);
        $resp['allItem'] = $movies['pageing']['allItem'];
        $resp['items'] = array();
        $movies = $movies['items'];
        for($i=0,$j=count($movies);$i<$j;$i++){
            $resp['items'][] = array(
                'movie_id'=>$movies[$i]['movie_id'],
                'title'=>$movies[$i]['title'],
                'title_en'=>$movies[$i]['title_en'],
                'cover'=>static_url($movies[$i]['cover'])
                );
        }
        unset($movies);
        echo json_encode($resp);
    }
    public function letter($alphabet=""){
        $this->load->model('movie_model','mMovie');

        $view['memberLogin'] = $this->mMember->getMemberLogin();
        $view['categories'] = $this->categories;
        $view['letter'] = $alphabet;
        $view['movies'] = $this->mMovie->getMoviesLetter($alphabet,$this->page,$this->limit);
        if($this->input->get('more')){
            $this->load->view('web/movie_more',$view);
        }else{
            $this->load->view('web/movie',$view);    
        }
    }
    public function player_back($movieId="",$episodeId=""){
        $this->load->library('user_agent');
        $this->load->model('episode_model','mEpisode');

        $allow = array('127.0.0.1');
        if(!in_array($this->input->ip_address(),$allow)){
            if($this->geoip_lib->InfoIP($this->input->ip_address())){
                if($this->geoip_lib->result_country_code()!="TH"){
                    show_404();
                }
            }else{
                show_404();
            }
        }


        if(!$view['movie'] = $this->mMovie->getMovie($movieId)){
            exit;
            //redirect(home_url('/'));
        }

        if($view['memberLogin'] = $this->mMember->getMemberLogin()){
            $view['memberLogin']['canwatch'] = ($this->mMovie->canWatch($view['memberLogin']['user_id'],$movieId)) ;
        }else{
            exit;
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
        
        if($this->agent->is_mobile()){
            $this->load->view('web/player_mobile',$view);
        }else{
            $this->load->view('web/player',$view);
        }
        
    }

	/*-----------------------------
	public function player($movieId="",$episodeId=""){
		$view['movieId'] = $movieId;
		$view['episodeId'] = $episodeId;
		$view['lang'] = (empty($_GET['lang'])? null: $_GET['lang']);
		
        $this->load->view('web/player',$view);
    }
	 */

	/*-----------------------------*/
	public function player($movieId="",$episodeId=""){
		
		$this->load->library('user_agent');
		$this->load->model('episode_model','mEpisode');
		
		$view['movieId'] = $movieId;
		$view['episodeId'] = $episodeId;
		$view['lang'] = (empty($_GET['lang'])? null: $_GET['lang']);
		
		$memberLogin = $this->mMember->getMemberLogin();
        $canwatch = $this->mMovie->canWatch((empty($memberLogin['user_id'])?null:$memberLogin['user_id']),$movieId) ;
		
		if(is_numeric($episodeId)){
	    	$thisEpisode= $this->mEpisode->getEpisode($episodeId);
	    }else{
	        $thisEpisode = $this->mEpisode->getEpisode((empty($episodes[0]['episode_id'])?null:$episodes[0]['episode_id']));
	    }
		
		//play single file
		if($this->agent->is_mobile()){
			$lang = $view['lang'];
			
			$allow = array('127.0.0.1');
	        if(!in_array($this->input->ip_address(),$allow)){
	            if($this->geoip_lib->InfoIP($this->input->ip_address())){
	                if($this->geoip_lib->result_country_code()!="TH"){
	                    show_404();
	                }
	            }else{
	                show_404();
	            }
			}
			
			if(!$movie = $this->mMovie->getMovie($movieId)){
	        	echo 'no file found';
	            exit;
	        }
			
			$this->load->library('user_agent');
        	$this->load->model('episode_model','mEpisode');
			
			if($movie['is_series']=='YES'){
	            $episodes = $this->mMovie->getMovieEpisode($movieId);
	            $episodes = $episodes['items'];

	            $moviePath = 'series/' . $thisEpisode['path'];
	        }else{
	            $moviePath = 'movies/'.$movie['path'];
	        }
			
			if($memberLogin){
	       		if($canwatch || ($thisEpisode['web_free'] == 1)){
	       			if($lang == 'en'){
						$view['moviePath'] = $this->_get_filesource($moviePath . 'en480');
					}
					else{
						$view['moviePath'] = $this->_get_filesource($moviePath . 'th480');
					}
				}
			}
			
			$this->load->view('web/player_mobile',$view);
		}

		//play multiple file
		else{
			//get episode detail
			
			$movie = $this->mMovie->getMovie($movieId);
			$episodes = $this->mMovie->getMovieEpisode($movieId);
			$playlist = array();
			
			if($memberLogin){
				//for free episode but no day left
				if(!$canwatch && ($thisEpisode['web_free'] == 1)){
					$this->load->view('web/player',$view);
				}
				else if(!$canwatch){
					$this->load->view('web/player',$view);
				}
				else{
	       			
					$playlist[] = array(
						'image' => static_url($movie['cover']),
						'title' => $thisEpisode['title'],
						'description' => $movie['title_en'],
						'file' => base_url('/movie/playlist.m3u8?m=' . $thisEpisode['movie_id'] . '&e=' . $thisEpisode['episode_id'] . '&lang=' . $view['lang'])
								
					);
					
					//gen playlist
					$all_episodes = array();	
					if(!empty($episodes)){
						foreach($episodes['items'] as $item){
							if($thisEpisode['episode_id'] != $item['episode_id']){
								$playlist[] = array(
									'image' => static_url($movie['cover']),
									'title' => $item['title'],
									'description' => $movie['title_en'],
									'file' => base_url('/movie/playlist.m3u8?m=' . $item['movie_id'] . '&e=' . $item['episode_id'] . '&lang=' . $view['lang'])
									
								);
							}
							
							$all_episodes[] = array(
								'id' => $item['episode_id'],
								'title'=> $item['title']
							);
				  		}
					}
					$view['episodes'] = json_encode($all_episodes);
				}
			}
			$view['playlist'] = json_encode($playlist);
			$this->load->view('web/player_list',$view);
		}
    }
	
	/*-----------------------------*/
	public function playlist(){
		$movieId = $_GET['m'];
		$episodeId = $_GET['e'];
		$lang = (empty($_GET['lang'])? null: strtolower($_GET['lang']));
		
		$this->load->library('user_agent');
        $this->load->model('episode_model','mEpisode');

        $allow = array('127.0.0.1');
        if(!in_array($this->input->ip_address(),$allow)){
            if($this->geoip_lib->InfoIP($this->input->ip_address())){
                if($this->geoip_lib->result_country_code()!="TH"){
                    show_404();
                }
            }else{
                show_404();
            }
		}
		

        if(!$movie = $this->mMovie->getMovie($movieId)){
        	echo 'no file found';
            exit;
        }
		
        $memberLogin = $this->mMember->getMemberLogin();
		$canwatch = $this->mMovie->canWatch((empty($memberLogin['user_id'])?null:$memberLogin['user_id']),$movieId) ;
	
        //Series Episode
        if($movie['is_series']=='YES'){
            $episodes = $this->mMovie->getMovieEpisode($movieId);
            $view['episodes'] = $episodes['items'];
            unset($episodes);
            if(is_numeric($episodeId)){
                $view['thisEpisode'] = $this->mEpisode->getEpisode($episodeId);
            }else{
                $view['thisEpisode'] = $this->mEpisode->getEpisode((empty($view['episodes'][0]['episode_id'])?null:$view['episodes'][0]['episode_id']));
            }
            $view['moviePath'] = 'series/'.$view['thisEpisode']['path'];
        }else{
            $view['moviePath'] = 'movies/'.$movie['path'];
        }
		
        
       if($memberLogin){
       		if($canwatch || ($view['thisEpisode']['web_free'] == 1)){
				
				header("Content-type: application/text");
				header("Content-Disposition: attachment; filename=playlist.m3u8");
				echo $this->_gen_playlist($view,$movie, $lang);
			}
			else{
				echo 'วันดูหนังหมด';
			}
		}
		else{
			echo 'คุณยังไม่ได้ login';
		}
		exit();
	}

	/*-----------------------*/
	function _gen_playlist_for_ipad($view,$movie, $lang){
		$txt = "#EXTM3U\n";

		if($lang == 'en'){
			$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Eng SD"' . "\n";
			$txt .= $this->_get_filesource($view['moviePath'] . 'en480') . "\n";
		}
		else{
			$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Thai SD"' . "\n";
			$txt .= $this->_get_filesource($view['moviePath'] . 'th480') . "\n";
		}
		return $txt;
	}
	
	/*-----------------------*/
	function _gen_playlist_rss($view,$movie, $episodes, $lang){
		
		$txt = '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/"><channel>';
  
  		if(!empty($episodes)){
	  		foreach($episodes as $item){
	  				$txt .= '
					  <item>
					    <mediaid>' . $item['episode_id'] . '</mediaid>
					    <title>' . $item['title'] . '</title>
					    <description>' . $movie['title_en'] . '</description>
					    <jwplayer:image>' . static_url($movie['cover']) . '</jwplayer:image>
					    <jwplayer:source file="' . base_url('/movie/playlist.m3u8?m=' . $item['movie_id'] . '&amp;e=' . $item['episode_id'] . '&amp;lang=' . $lang) . '"/>
					  </item>';
	  		}
		}

		$txt .= '</channel></rss>';
		return $txt;
	}

	/*-----------------------*/
	function _gen_playlist($view,$movie, $lang){
		$txt = '#EXTM3U' . "\n";
		
			if($lang == 'en'){
				$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Eng SD"' . "\n";
				$txt .= $this->_get_filesource($view['moviePath'] . 'en480') . "\n";
				
				if($movie['is_hd']=='YES'){
					$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1600000,RESOLUTION=1280x720,NAME="Eng HD"' . "\n";
					$txt .= $this->_get_filesource($view['moviePath'] . 'en720') . "\n";
				}
			}
			else if($lang == 'th'){
				$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Thai SD"' . "\n";
				$txt .= $this->_get_filesource($view['moviePath'] . 'th480') . "\n";
				
				if($movie['is_hd']=='YES'){
					$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1600000,RESOLUTION=1280x720,NAME="Thai HD"' . "\n";
					$txt .= $this->_get_filesource($view['moviePath'] . 'th720') . "\n";
				}
			}
			else{
				$sounds = explode(",",$movie['audio']);
				
				if(in_array("TH",$sounds)){
					$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Thai SD"' . "\n";
					$txt .= $this->_get_filesource($view['moviePath'] . 'th480') . "\n";
				}
				if(in_array("EN",$sounds)){
					$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=832000,RESOLUTION=854x480,NAME="Eng SD"' . "\n";
					$txt .= $this->_get_filesource($view['moviePath'] . 'en480') . "\n";
				}
				
				if($movie['is_hd']=='YES'){
					if(in_array("TH",$sounds)){
						$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1600000,RESOLUTION=1280x720,NAME="Thai HD"' . "\n";
						$txt .= $this->_get_filesource($view['moviePath'] . 'th720') . "\n";
					}
					if(in_array("EN",$sounds)){
						$txt .= '#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=1600000,RESOLUTION=1280x720,NAME="Eng HD"' . "\n";
						$txt .= $this->_get_filesource($view['moviePath'] . 'en720') . "\n";
					}
				}
			}
		return $txt;
	}

	/*-----------------------*/
	function _get_filesource($file){
		$domain = "https://cdn10-dooneetv.wisstream.com";
		$secret = 'fdoonejifosofoi320';

		$baseuri = "/" . $file; // This is the file to send to the user.
		$uri = dirname($file) . '/' . basename($file) . '/' . basename($file) . '.m3u8';
	
		$e = time() + 6000; // At which point in time the file should expire. time() + x; would be the usual usage.
		$rawhash=$secret . $baseuri . $e . $_SERVER['REMOTE_ADDR'];
	 
		$m = base64_encode(md5($rawhash , true)); // Using binary hashing.
	
		$m = strtr($m, '+/', '-_'); // + and / are considered special characters in URLs, see the wikipedia page linked in references.
		$m = str_replace('=', '', $m); // When used in query parameters the base64 padding character is considered special.
		$file_path = "$domain/$uri?m=$m&e=$e";
		return $file_path;
	}


    public function ios($movieId="",$episodeId=""){
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
        

        $this->load->view('web/player_mobile',$view);
    }
    public function trailers($movie_id=""){
       
		
		if(!$movie = $this->mMovie->getMovie($movie_id)){
	        echo 'no file found';
	        exit;
	    }
		
		$view['moviePath'] = "https://cdn10-dooneetv.wisstream.com/";
		if(substr($movie['trailer'],0,1) == '/'){
			$view['moviePath'] .= substr($movie['trailer'],1,strlen($movie['trailer'])-1);
		}
		else{
			$view['moviePath'] .= $movie['trailer'];
		}
		$this->load->view('web/player_trailers',$view);


		/*
        if($this->agent->is_mobile()){
            echo '
            <style type="text/css">
            	body{background:#000;}
            </style>
            <center>
            <video width="640" style="min-height:150px;height:480" controls id="video" autoplay>
              <source src="https://cdn10-dooneetv.wisstream.com',$movie['trailer'],'" autoplay/> 
              Your browser does not support the video.
            </video>
            </center>';
        }else{
            echo '
            <style type="text/css">
            	body{background:#000;}
            </style>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
            <script src="',static_url('/js/jwplayer/jwplayer.js'),'"></script>
            <center><div id="container">Loading the player ...</div></center>
            <script type="text/javascript">
            jwplayer("container").setup({
                flashplayer: "',static_url('/js/jwplayer6/jwplayer.flash.swf'),'",
                width: "640",
                height: "480" ,
                primary: "flash",
                aspectratio: "16:9",
                autostart: true,
                file: "https://cdn10-dooneetv.wisstream.com/'
                .(startsWith($movie['trailer'],'/') == true?substr($movie['trailer'],1,strlen($movie['trailer'])-1):$movie['trailer']) . '",
                skin:"bekle",
                abouttext:"Doonee 2014",
                aboutlink:"',base_url('/privacy'),'",
            });
            </script>
            '; 
        }
		 */
    }

	/*----------------------------------*/
	public function ajax_updateview($movie_id=""){
		echo $movie_id;
		$this->mMovie->updateView($movie_id);
		exit();
	}
}
