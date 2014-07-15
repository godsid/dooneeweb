<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/ADODB_Model.php');
class Banner_model extends ADODB_model {

	public function __construct(){
		parent::__construct();
	}

	public function getBanner($bannerID=false){
		$sql = "SELECT * 
				FROM ".$this->table('banner')."
				WHERE status = 'ACTIVE' ";

		if($bannerID){
			$sql.=" AND banner_id = ".$bannerID;
			return $this->adodb->GetRow($sql);
		}else{
			return $this->adodb->query($sql)->GetAll();
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */