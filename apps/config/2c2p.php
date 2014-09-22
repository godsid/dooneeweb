<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['2c2p_version'] = '8.0';
$config['2c2p_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['2c2p_currencycode'] = '764';//Bath
$config['2c2p_countrycode'] = 'TH';
$config['2c2p_requesturl'] = 'http://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx';
$config['2c2p_secretkey'] = '4LpFOphCqLeE';
$config['2c2p_merchant_publickey'] = APPPATH.'libraries/2c2ppay/demo2.crt';
$config['2c2p_merchant_privatekey'] = APPPATH.'libraries/2c2ppay/demo2.pem';
$config['2c2p_merchant_password'] = '2c2p';
//$config['2c2p_server_publickey'] = APPPATH.'libraries/2c2ppay/123Public.pem';


//if(ENVIRONMENT=='production'){
//	$config['2c2p_frontrespurl'] = 'http://www.dooneetv.com/payment/fontResponse';
//	$config['2c2p_backrespurl'] = 'http://www.dooneetv.com/2c2p/devBackResp7pwDvbfe9i';
//}else{
	$config['2c2p_frontrespurl'] = 'http://dev.dooneetv.com/payment/response/creditcard3d';
	$config['2c2p_backrespurl'] = 'http://www.dooneetv.com/twoc2p/devBackRespCyb5Z2Wnhu';
//}


//$config['2c2p_frontrespurl'] = "http://uat.123.co.th/DemoShopping/merchantUrl.aspx";
//$config['2c2p_backrespurl'] = "http://uat.123.co.th/DemoShopping/apicallurl.aspx";


$config['2c2p_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['2c2p_decrypt_path'] = APPPATH.'logs/decrypt/';


