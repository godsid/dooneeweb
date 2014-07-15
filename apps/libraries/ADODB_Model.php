<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/Adodb5/adodb.inc.php';
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

class ADODB_Model extends CI_Model {
	var $adodb,$CI;
	var $prefix="";
	
	function __construct($setActiveGroup=""){
		require(APPPATH.'config/database.php');
		global $ADODB_CACHE_DIR;
		parent::__construct();
		$this->CI =& get_instance();
		if(!empty($setActiveGroup)){
			$active_group = $setActiveGroup;
		}
		$ADODB_CACHE_DIR = $db[$active_group]['cachedir'];
		$dbtype = $db[$active_group]['dbdriver']."://".$db[$active_group]['username'].":".$db[$active_group]['password']."@".$db[$active_group]['hostname']."/".$db[$active_group]['database']."?options[debug]";
		$this->adodb = ADONewConnection($dbtype);
		
		$this->adodb->cacheSsecs =$db[$active_group]['cachetime']; 
		$this->adodb->memCache = $db[$active_group]['memcache']['enable'];
		$this->adodb->memCacheHost = $db[$active_group]['memcache']['host'];
		$this->adodb->memCachePort = $db[$active_group]['memcache']['port'];
		$this->adodb->memCacheCompress = $db[$active_group]['memcache']['compress'];
		$this->adodb->SetCharSet($db[$active_group]['char_set']);
		$this->adodb->Execute("set names 'utf8'");
		$this->adodb->Execute("SET NAMES ".$db[$active_group]['char_set']." COLLATE ".$db[$active_group]['dbcollat']."");

		$this->adodb->debug = $db[$active_group]['db_debug'];
		$this->prefix = $db[$active_group]['dbprefix'];
		
	}
	function table($name,$as=''){
		return $this->prefix.$name.(empty($as)?'':' AS '.$as);
	}
	function fetchPage($sql,$limit=30,$page=1){
		$rs = $this->adodb->PageExecute($sql,$page,$limit);

		$resp['pageing']  = array(
								'page'=>(int)$rs->AbsolutePage(),
								'maxItem'=>(int)$rs->RecordCount(),
							);
		$resp['pageing']['maxPage'] = (int)ceil($resp['pageing']/$limit);
		$resp['items'] = $rs->GetAll();
		return $resp;

	}
}


?>