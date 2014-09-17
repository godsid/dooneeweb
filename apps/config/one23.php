<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['one23_version'] = '1.1';
$config['one23_merchantid'] = 'webmaster@mediaplex.co.th';//'webmaster@mediaplex.co.th';//446
$config['one23_requesturl'] = 'http://uat.123.co.th/payment/paywith123.aspx';
$config['one23_secretkey'] = '2MRNV5XE6BY6Y9ZU8ADWUPKO6NOPN4HH';
$config['one23_public_certificate'] = APPPATH.'libraries/one23pay/MerchantPublic.pem';




$config['one23_currencycode'] = 'THB';
$config['one23_countrycode'] = 'THA';
$config['one23_frontrespurl'] = 'http://www.dooneetv.com/payment/fontResponse';
$config['one23_backrespurl'] = 'http://www.dooneetv.com/one23/devBackResp7pwDvbfe9i';


$config['one23_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['one23_decrypt_path'] = APPPATH.'logs/decrypt/';

