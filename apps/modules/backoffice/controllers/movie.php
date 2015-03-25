<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','mUser');
		if(!$this->mUser->auth()){
			redirect(backoffice_url('/user/login'));
		}

		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Movies','url'=>backoffice_url('/movie'));
		$this->load->model('movie_model','mMovie');
		$this->load->model('category_model','mCategory');

	}

	public function index($movieID = null){
		if($movieID){
			$data['movie'] = $this->mMovie->getMovie($movieID);
			$data['movie']['category'] = $this->mMovie->getMovieCategory($movieID);

			$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>'');
			$data['breadcrumb'] = $this->breadcrumb;
			if($data['movie']['is_series']=='NO'){
				$moviepath = array();
				$sounds = explode(',',trim($data['movie']['audio']));
				foreach($sounds as $sound){
					if(!empty($sound)){
						$moviepath[] = '/'.$this->config->item('movie_path').$data['movie']['path'].'_480'.trim($sound).'.mp4';
						if($data['movie']['is_hd']=='YES'){
							$moviepath[] = '/'.$this->config->item('movie_path').$data['movie']['path'].'_720'.trim($sound).'.mp4';
						}
					}
				}
				$data['movie']['path'] = implode('<br/>',$moviepath);
			}
			
			$this->load->view('movie_detail',$data);
		}else{
			$data['movies'] = $this->mMovie->getMovies($this->page,$this->limit);
			$data['categories'] = $this->_get_categories(0);
			
			$data['movies']['pageing']['url'] = backoffice_url('/movie');
			$data['movies']['pageing']['total_item'] = $this->mMovie->getMovieTotal();
			$data['pageing'] = $this->load->view('pageing',$data['movies']['pageing'],true);
			$data['breadcrumb'] = $this->breadcrumb;
			$this->load->view('movie',$data);
		}
	}
	public function search(){
		$search['q'] = $this->input->get('q');
		$search['category'] = $this->input->get('category');
		
		$data['movies'] = $this->mMovie->searchMyMovies($search,$this->page,$this->limit);
		$data['movies']['pageing']['url'] = backoffice_url('/movie/search?q='.$search['q'] . '&category='.$search['category']);
		$data['pageing'] = $this->load->view('pageing',$data['movies']['pageing'],true);
		$data['q'] = $search['q'];
		$this->breadcrumb[] = array('title'=>'Search','url'=>backoffice_url('/movie/search/?q='.$search['q']));
		$this->breadcrumb[] = array('title'=>$search['q']);
		$data['breadcrumb'] = $this->breadcrumb;
		$data['categories'] = $this->_get_categories(0);
		$data['category'] = $search['category'];

		$this->load->view('movie',$data);
	}
	
	function _get_categories($category_id){
		$data = $this->mCategory->getSubCategory($category_id);
		
		for($i=0; $i<count($data['items']); $i++){
			if($data['items'][$i]['parent_id'] == 0){
				$data['items'][$i]['category'] = $this->_get_categories($data['items'][$i]['category_id']);
			}
		}
		
		return $data;
	}

	public function create(){
		$this->load->model('category_model','mCategry');
		$data['categories'] = $this->mCategry->getCategories();
		$data['categories'] = $data['categories']['items'];
		
		$this->breadcrumb[] = array('title'=>'New','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$data['movie']['category'] = array();
		$data['movie']['tags'] = array();
		$this->load->view('movie_form',$data);
	}

	public function edit($movieID=""){
		$this->load->model('category_model','mCategry');
		$this->load->model('episode_model','mEpisode');

		$data['categories'] = $this->mCategry->getCategories();
		$data['categories'] = $data['categories']['items'];
			
		$data['movie'] = $this->mMovie->getMovie($movieID);
		if($data['movie']['is_series']=='NO'){
			/*
			$moviepath = array();
			$sounds = explode(',',trim($data['movie']['audio']));
			foreach($sounds as $sound){
				if(!empty($sound)){
					$moviepath[] = '/'.$this->config->item('movie_path').$data['movie']['path'].'_480'.trim($sound).'.mp4';
					if($data['movie']['is_hd']=='YES'){
						$moviepath[] = '/'.$this->config->item('movie_path').$data['movie']['path'].'_720'.trim($sound).'.mp4';
					}
				}
			}
			$data['movie']['path'] = implode('<br/>',$moviepath);
			*/
			$data['movie']['path'] = '/'.$this->config->item('movie_path').$data['movie']['path'].'.mp4';
		}
		$cateArray = $this->mMovie->getMovieCategory($movieID);
		$data['movie']['category'] = array();
		foreach($cateArray as $cateID){
			$data['movie']['category'][] = $cateID['category_id'];
		}

		if($data['movie']['is_series']=='YES'){
			$data['movie']['episodes'] = $this->mEpisode->getEpisodes($data['movie']['movie_id']);
		}
		$data['movie']['tags'] = $this->mMovie->getMovieTags($data['movie']['movie_id']);
		
		$this->breadcrumb[] = array('title'=>$data['movie']['title'],'url'=>backoffice_url('/movie/'.$movieID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>backoffice_url('/movie/edit/'.$movieID));
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}
	
	public function submit($movieID=false){
		$this->load->library('image_lib');

		$isError = false;
		$movie = $this->input->post();
		
		if(empty($movie['title'])){
			$isError = true;
			$movie['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(empty($movie['title_en'])){
			$isError = true;
			$movie['title_en_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		
		$movie['is_free'] = isset($movie['is_free'])?$movie['is_free']:'NO';
		$movie['is_hd'] = isset($movie['is_hd'])?$movie['is_hd']:'NO';
		$movie['is_hot'] = isset($movie['is_hot'])?$movie['is_hot']:'NO';
		$movie['is_series'] = isset($movie['is_series'])?$movie['is_series']:'NO';
		$movie['is_18'] = isset($movie['is_18'])?$movie['is_18']:'NO';
		$movie['is_soon'] = isset($movie['is_soon'])?$movie['is_soon']:'NO';
		
		$movie['length'] = isset($movie['length'])?($movie['length']*60):0;

		//var_dump($_FILES["cover"]);
		if(isset($_FILES["cover"])&&!empty($_FILES["cover"]['tmp_name'])){
			//if($_FILES['cover']['error']){
				//var_dump($_FILES);
				//$isError = true;
				//$movie['cover_error'] = $_FILES['cover']['error'];
			//}else{
				$destinationPath = static_path(substr(md5(time()),0,5).".jpg");
				if(move_uploaded_file($_FILES['cover']['tmp_name'],$destinationPath)){
					$imageSize = $this->config->item('cover');
					$config["source_image"] = $destinationPath;
		            $config['new_image'] = $destinationPath;
		            $config["width"] = $imageSize['medium'][0];
		            $config["height"] = $imageSize['medium'][1];
		            $config["dynamic_output"] = FALSE; // always save as cache
		            
					$this->image_lib->initialize($config);
		            $this->image_lib->fit();
		            if(isset($movies['cover_tmp'])){
		            	unlink(preg_replace("#.*".$this->config->item('static_path')."#",$this->config->item('static_path'),$movie['cover_tmp']));	
		            }
		            
		            $movie['cover'] = '/'.$destinationPath;
				}
				
			//}
		}

		$data['movie'] = $movie;
		unset($movie);
		if($isError){
			$this->load->view('movie_form',$data);
		}else{
			if(is_numeric($movieID)){
				$this->mMovie->updateMovie($movieID,$data['movie']);
			}else{
				$data['movie']['path'] = substr(md5($data['movie']['title']+time()),0,10);
				$movieID = $this->mMovie->setMovie($data['movie']);
			}
			/* Category */
			$category_tmp = explode(',',$this->input->post('category_tmp'));
			$category = $this->input->post('category');
			if(is_array($category_tmp)&&is_array($category)){
				$deleteCategory = array_diff($category_tmp,$category);
				$addCategory = array_diff($category,$category_tmp);
			}

			if(is_array($addCategory)&&count($addCategory)){
				$this->mMovie->setMovieCategory($movieID,$addCategory);
			}
			if(is_array($deleteCategory)&&count($deleteCategory)){
				$this->mMovie->deleteMovieCategory($movieID,$deleteCategory);
			}
			/* Tags */

			$tags_delete = array();
			$tags_insert = array();
			$tags_tmp = json_decode($data['movie']['tags_tmp'],true);
			

			$tags_search = $tags = explode(',',preg_replace('#\s*,\s*#',',',trim($data['movie']['tags'])));
			
			foreach($tags_tmp as $tmp){
				$found = array_search($tmp['tags_name'],$tags_search);
				if($found===false){
					$tags_delete[] = $tmp['id'];
				}
				unset($tags[$found]);
			}
			
			$tags_insert = $tags;
			
			if(sizeof($tags_delete)){
				$this->mMovie->deleteTags($tags_delete);
			}
			foreach($tags_insert as $insert){
				$this->mMovie->insertTags($movieID,$insert);
			}

			//redirect(backoffice_url('/movie'));	
			$this->edit($movieID);
		}
	}
	
	public function active($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->updateMovie($movieID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/movie'));
	}
	public function inactive($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->updateMovie($movieID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/movie'));
	}
	public function delete($movieID){
		if(is_numeric($movieID)){
			$this->mMovie->deleteMovie($movieID);
		}
		redirect(backoffice_url('/movie'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('movie_form',$data);
	}

	public function addEpisode($movieID=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($movieID)){
			$data = $this->input->post();
			$data['movie_id'] = $movieID;
			$data['path'] = substr(md5(time()),0,10);

			$path = $this->config->item('episode_path').date('/Y/').'series-'.$movieID.'-'.$data['path'];
			$episode_id = $this->mEpisode->setEpisode($data);
			echo json_encode(array(
				'status'=>'success',
				'items'=>array(
						'episode_id'=>$episode_id,
						'title'=>$data['title'],
						'path'=>$path
					)
			));
		}else{
			echo json_encode(array(
				'status'=>'faile',
				'message'=>'movie id not accept'
			));	
		}
		
		
	}
	public function deleteEpisode($episode_id=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($episode_id)){
			$this->mEpisode->deleteEpisode($episode_id);
		}
	}

	public function activeEpisode($episode_id=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($episode_id)){
			$this->mEpisode->updateEpisode($episode_id,array('status'=>'ACTIVE'));
		}
	}
	public function inactiveEpisode($episode_id=""){
		$this->load->model('episode_model','mEpisode');
		if(is_numeric($episode_id)){
			$this->mEpisode->updateEpisode($episode_id,array('status'=>'INACTIVE'));
		}
	}

	public function export($type=""){
		//header("Content-type: application/force-download; charset=utf-8;");
		header("Content-type: text/plain; charset=utf-8;");
    	header('Content-Transfer-Encoding: binary');
    	header('Accept-Ranges: bytes');
		$this->load->model('episode_model','mEpisode');
		if($type=="series"){
			header('Content-Disposition: attachment; filename="series.csv"');
			$path = $this->config->item('series_path');

			$page = 1;
			echo "Id,Title,Path\r\n";
			while($page){
				$episodes = $this->mEpisode->getAllEpisodes($page,100);
				if($episodes&&$episodes['pageing']['maxPage']>$page){
					$page++;
				}else{
					$page = 0;
				}
				$episodes = $episodes['items'];
				for($i=0,$j=count($episodes);$i<$j;$i++){
					echo $episodes[$i]['movie_id'],",",$episodes[$i]['movieTitle'],$episodes[$i]['title'],",/",$path,$episodes[$i]['path'],".mp4\r\n";
				}
			}
				
		}else{
			header('Content-Disposition: attachment; filename="movies.csv"');
			$path = $this->config->item('movie_path');
			$page = 1;
			echo "Id,Title,Path\r\n";
			while($page){
				$movies = $this->mMovie->getMovies($page,100);
				if($movies&&$movies['pageing']['maxPage']>$page){
					$page++;
				}else{
					$page = 0;
				}
				$movies = $movies['items'];
				for($i=0,$j=count($movies);$i<$j;$i++){
					echo $movies[$i]['movie_id'],",",$movies[$i]['title'],",/",$path,$movies[$i]['path'],".mp4\r\n";
				}
			}
		}
	}
}

/* End of file movie.php */
/* Location: ./application/modeules/backoffice/controllers/movie.php */