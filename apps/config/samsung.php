<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//$config['samsung_access_key'] = 'XVHbNpyC5m';
//$config['samsung_payment_key'] = 'mezEJsVqsF';

$config['samsung_appid'] = '19';
$config['samsung_logo'] = '';
$config['samsung_title'] = '';
$config['samsung_description'] = '';
$config['samsung_background_image'] = 'https://logicshowtime.meevuu.com:8443/appThumbImg/bg_main-2.png';
$config['samsung_background_color'] = '#000000';

$config['samsung_payment_log'] = APPPATH.'logs/samsung_transection_'.date('Ymd').'.log';
$config['samsung_connection_log'] = APPPATH.'logs/samsung_connection_'.date('Ymd').'.log';
$config['samsung_checkuserid_url'] = 'https://logicshowtime.meevuu.com:8443/ShowtimeServer/user/verifyUserId';
$config['samsung_checktransactionid_url'] = 'https://logicshowtime.meevuu.com:8443/ShowtimeServer/user/verifyTransactionId';

$config['samsung_cdn_url'] = "https://cdn10-dooneetv.wisstream.com/";

$config['samsung_video_secret'] = 'fdoonejifosofoi320';
?>