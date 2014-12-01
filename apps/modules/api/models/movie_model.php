<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Movie_model extends ADODB_model {
	var $member_id;
	var $CI;
	public function __construct(){
		parent::__construct();
		$this->member_id = $this->input->get('member_id');
		$this->CI = & get_instance();
		$this->CI->load->config('samsung');
	}

	public function getMovie($movieID){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.movie_id = ".$movieID." 
				AND m.status = 'ACTIVE' ";
				
		return $this->adodb->GetRow($sql);
	}

	public function getMovies($page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getHotMovies($page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE m.is_hot = 'YES' 
				AND m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSearchMovie($q,$page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE (m.title LIKE '%".$q."%' OR m.title_en LIKE '%".$q."%')
				AND m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getSuggestion($q,$page,$limit){
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie','m')."
				WHERE (m.title LIKE '".$q."%' OR m.title_en LIKE '".$q."%')
				AND m.status = 'ACTIVE' ";
		return $this->fetchPage($sql,$page,$limit);
	}
	public function rewiteData(&$data){
		if(isset($data['cover'])){
			$data['cover'] = static_url($data['cover']);
			
		}else{
			for($i=0,$j=count($data);$i<$j;$i++){
				$data[$i]['cover'] = static_url($data[$i]['cover']);
			}
		}
	}
	public function getCategoryMovie($category_id,$page=1,$limit=30){
		if(is_array($category_id)){
			$category_id = "mc.category_id IN (".implode(',',$category_id).") ";
		}else{
			$category_id = "mc.category_id = '".$category_id."' ";
		}
		if($this->member_id){
			$favorite = ",(SELECT f.favorite_id FROM ".$this->table('favorite','f')." WHERE m.movie_id = f.movie_id AND f.user_id = '".$this->member_id."' )  AS favorite_id ";
		}else{
			$favorite = ",(SELECT NULL)  AS favorite_id ";
		}
		$sql = "SELECT m.* ".$favorite." 
				FROM ".$this->table('movie_category','mc')."  
				LEFT JOIN ".$this->table('movie','m')." ON mc.movie_id = m.movie_id
				WHERE ".$category_id." 
				AND m.status = 'ACTIVE'
				ORDER BY m.movie_id DESC ";
		return $this->fetchPage($sql,$page,$limit);
	}

	public function getMovieEpisode($movie_id,$episode_id=""){
		$sql = "SELECT *  
				FROM ".$this->table('episode','e')."  
				WHERE movie_id = '".$movie_id."' 
				".(empty($episode_id)?"":" AND episode_id = '".$episode_id."' ")."
				AND status = 'ACTIVE'
				ORDER BY title ASC ";
		return $this->fetchPage($sql,1,50);
	}

	public function rewriteEpisode(&$data,&$movie,$canwatch=false){
		
		$cdnUrl = $this->CI->config->item('samsung_cdn_url');

		//https://cdn10-dooneetv.wisstream.com/series/5c991ac7d1en720/5c991ac7d1en720.m3u8
		
		for($i=0,$j=count($data);$i<$j;$i++){
			if($canwatch){
				if($movie['is_soon']=='YES'){
					$data[$i]['url'] = array();
				}else{
					if($movie['is_hd']=='YES'){
						$data[$i]['url']['THHD'] = $cdnUrl.'series/'.$data[$i]['path'].'th720/'.$data[$i]['path'].'th720.m3u8'.$this->cdnHash('/series/'.$data[$i]['path'].'th720');
						$data[$i]['url']['ENHD'] = $cdnUrl.'series/'.$data[$i]['path'].'en720/'.$data[$i]['path'].'en720.m3u8'.$this->cdnHash('/series/'.$data[$i]['path'].'en720');
					}
					$data[$i]['url']['THSD'] = $cdnUrl.'series/'.$data[$i]['path'].'th480/'.$data[$i]['path'].'th480.m3u8'.$this->cdnHash('/series/'.$data[$i]['path'].'th480');
					$data[$i]['url']['ENSD'] = $cdnUrl.'series/'.$data[$i]['path'].'en480/'.$data[$i]['path'].'en480.m3u8'.$this->cdnHash('/series/'.$data[$i]['path'].'en480');
				}
			}else{
				$data[$i]['url'] = array();
				unset($data[$i]['path']);
			}
		}
	}
	public function getMovieRelate($movieID,$page=1,$limit=30){
		$sql = "SELECT m.*
				FROM ".$this->table('movie_tags','mt1')."
				LEFT JOIN ".$this->table('movie','m')." ON mt1.movie_id = m.movie_id
				WHERE mt1.tags_id IN (SELECT tags_id FROM ".$this->table('movie_tags','mt2')." WHERE mt2.movie_id = ".$movieID.")
				AND mt1.movie_id != ".$movieID."
				AND m.status = 'ACTIVE' 
				GROUP BY m.movie_id 
				ORDER BY m.movie_id DESC ";
		;
		return $this->fetchPage($sql,$page,$limit);
	}
	public function canWatch($member_id,$movie_id){
		$sql ="SELECT COUNT(*) AS canwatch 
				FROM ".$this->table('user_package','up')." 
				LEFT JOIN ".$this->table('package_category','pc')." ON up.package_id = pc.package_id 
				LEFT JOIN ".$this->table('movie_category','mc')." ON pc.category_id = mc.category_id 
				WHERE up.user_id = ".$member_id." 
				AND up.expire_date > NOW()
				AND up.status = 'ACTIVE'
				AND mc.movie_id = ".$movie_id." ";

		$resp = $this->adodb->GetRow($sql);
		if($resp['canwatch']>0){
			return true;
		}else{
			return false;
		}
		
	}

	private function cdnHash($basepath){

		//'/series/PathLangScreen/'
		$secret = $this->CI->config->item('samsung_video_secret');
		$e = time() + 6000; // At which point in time the file should expire. time() + x; would be the usual usage.
        $rawhash=$secret . $basepath . $e . $_SERVER['REMOTE_ADDR'];
        //echo "<p>" . $rawhash . "</p>";
        $m = base64_encode(md5($rawhash , true)); // Using binary hashing.
        $m = strtr($m, '+/', '-_'); // + and / are considered special characters in URLs, see the wikipedia page linked in references.
        $m = str_replace('=', '', $m); // When used in query parameters the base64 padding character is considered special.
        //You have 60 seconds to access via this link
        //echo $rawhash;
        return ("?m=".$m."&e=".$e);
	}
	

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */