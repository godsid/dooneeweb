<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['2c2p_version'] = '1.0';
$config['2c2p_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['2c2p_requesturl'] = 'http://uat.123.co.th/payment/paywith123.aspx';
$config['2c2p_secretkey'] = '2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH';
$config['2c2p_public_certificate'] = APPPATH.'libraries/2c2ppay/MerchantPublic.pem';

$config['2c2p_currencycode'] = 'THB';
$config['2c2p_countrycode'] = 'THA';

if(ENVIRONMENT=='production'){
	$config['2c2p_frontrespurl'] = 'http://www.dooneetv.com/payment/fontResponse';
	$config['2c2p_backrespurl'] = 'http://www.dooneetv.com/2c2p/devBackResp7pwDvbfe9i';
}else{
	$config['2c2p_frontrespurl'] = 'http://dev.dooneetv.com/payment/fontResponse';
	$config['2c2p_backrespurl'] = 'http://www.dooneetv.com/2c2p/devBackResp7pwDvbfe9i';
}


//$config['2c2p_frontrespurl'] = "http://uat.123.co.th/DemoShopping/merchantUrl.aspx";
//$config['2c2p_backrespurl'] = "http://uat.123.co.th/DemoShopping/apicallurl.aspx";


$config['2c2p_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['2c2p_decrypt_path'] = APPPATH.'logs/decrypt/';


