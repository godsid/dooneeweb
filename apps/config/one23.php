<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['one23_version'] = '1.1';
$config['one23_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['one23_requesturl'] = 'http://uat.123.co.th/payment/paywith123.aspx';
$config['one23_apikey'] = '2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH';
$config['one23_merchant_publickey'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';
$config['one23_merchant_privatekey'] = APPPATH.'libraries/one23pay/MerchantPrivate(123).pem';
$config['one23_merchant_password'] = '123';
$config['one23_server_publickey'] = APPPATH.'libraries/one23pay/123Public.pem';


//$config['one23_public_certificate'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';
//$config['one23_privatekey'] = APPPATH.'libraries/one23pay/MerchantPrivate(123).pem';




$config['one23_currencycode'] = 'THB';
$config['one23_countrycode'] = 'THA';
$config['one23_frontrespurl'] = 'http://www.dooneetv.com/payment/fontResponse';
$config['one23_backrespurl'] = 'http://www.dooneetv.com/one23/devBackResp7pwDvbfe9i';
$config['one23_info'] = "You have to pay the fee (40) which includes in your amount. 
We are happy with your shopping. 
Please contact us to webmaster@doonee.tv Call Center 02-884-6172.";

//if(ENVIRONMENT=='production'){
//	$config['one23_frontrespurl'] = 'http://www.dooneetv.com/payment/fontResponse';
//	$config['one23_backrespurl'] = 'http://www.dooneetv.com/one23/devBackResp7pwDvbfe9i';
//}else{
	$config['one23_frontrespurl'] = 'http://dev.dooneetv.com/payment/fontResponse';
	$config['one23_backrespurl'] = 'http://dev.dooneetv.com/one23/devBackResp7pwDvbfe9i';
//}


//$config['one23_frontrespurl'] = "http://uat.123.co.th/DemoShopping/merchantUrl.aspx";
//$config['one23_backrespurl'] = "http://uat.123.co.th/DemoShopping/apicallurl.aspx";


$config['one23_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['one23_decrypt_path'] = APPPATH.'logs/decrypt/';


$config['one23_inquiryurl'] = "http://uat.123.co.th/Payment/inquiryapi.aspx";


