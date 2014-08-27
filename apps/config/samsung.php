<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['samsung_appid'] = '20';
$config['samsung_logo'] = '';
$config['samsung_title'] = '';
$config['samsung_description'] = '';
$config['samsung_background_image'] = '';
$config['samsung_background_color'] = '#000000';

$config['samsung_payment_log'] = APPPATH.'logs/samsung_transection_'.date('Ymd').'.log';
$config['samsung_connection_log'] = APPPATH.'logs/samsung_connection_'.date('Ymd').'.log';
$config['samsung_checkuserid_url'] = 'https://logicshowtime.meevuu.com:8443/ShowtimeServer/user/verifyUserId';
$config['samsung_checktransactionid_url'] = 'https://logicshowtime.meevuu.com:8443/ShowtimeServer/user/verifyTransactionId';


?>