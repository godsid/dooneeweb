<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
//For Developer

$config['one23_version'] = '1.1';
$config['one23_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['one23_requesturl'] = 'http://uat.123.co.th/payment/paywith123.aspx';
$config['one23_apikey'] = '2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH';
$config['one23_merchant_publickey'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';
$config['one23_merchant_privatekey'] = APPPATH.'libraries/one23pay/MerchantPrivate(123).pem';
$config['one23_merchant_password'] = '123';
$config['one23_server_publickey'] = APPPATH.'libraries/one23pay/123Public.pem';
$config['one23_frontrespurl'] = 'http://www.dooneetv.com/payment/response';
$config['one23_backrespurl'] = 'http://www.dooneetv.com/one23/devBackResp7BFxA4CXm9Y';
*/
//For Production

$config['one23_version'] = '1.1';
$config['one23_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['one23_requesturl'] = 'https://secure.123.co.th/Payment/paywith123.aspx';
$config['one23_apikey'] = '44YKY08L290XBQYJVBY6FYW8MWPV58I5';
$config['one23_merchant_publickey'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';
$config['one23_merchant_privatekey'] = APPPATH.'libraries/one23pay/MerchantPrivate(123).pem';
$config['one23_merchant_password'] = '123';
$config['one23_server_publickey'] = APPPATH.'libraries/one23pay/secure.123.co.th.cer';

$config['one23_frontrespurl'] = 'http://www.dooneetv.com/payment/response';
$config['one23_backrespurl'] = 'http://www.dooneetv.com/one23/proBackRespXhMdkag7eR';



//$config['one23_public_certificate'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';
//$config['one23_privatekey'] = APPPATH.'libraries/one23pay/MerchantPrivate(123).pem';




$config['one23_currencycode'] = 'THB';
$config['one23_countrycode'] = 'THA';

$config['one23_info'] = "ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ info@mediaplex.co.th โทร. 02 884 6188";

$config['one23_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['one23_decrypt_path'] = APPPATH.'logs/decrypt/';


$config['one23_inquiryurl'] = "http://uat.123.co.th/Payment/inquiryapi.aspx";


