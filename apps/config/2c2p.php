<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

//For Development
$config['2c2p_version'] = '8.0';
$config['2c2p_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['2c2p_currencycode'] = '764';//Bath
$config['2c2p_countrycode'] = 'TH';
$config['2c2p_requesturl'] = 'http://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx';
$config['2c2p_secretkey'] = '4LpFOphCqLeE';
$config['2c2p_merchant_publickey'] = APPPATH.'libraries/2c2ppay/demo2.crt';
$config['2c2p_merchant_privatekey'] = APPPATH.'libraries/2c2ppay/demo2.pem';
$config['2c2p_merchant_password'] = '2c2p';
$config['2c2p_frontrespurl'] = 'http://dev.dooneetv.com/payment/response/creditcard3d';
$config['2c2p_backrespurl'] = 'http://dev.dooneetv.com/twoc2p/devBackRespCyb5Z2Wnhu';
*/

//For Production
$config['2c2p_version'] = '8.2';
$config['2c2p_merchantid'] = '446';//'webmaster@mediaplex.co.th';//446
$config['2c2p_currencycode'] = '764';//Bath
$config['2c2p_countrycode'] = 'TH';
$config['2c2p_requesturl'] = 'https://s.2c2p.com/SecurePayment/paymentauth.aspx';
//$config['2c2p_requesturl'] = 'https://s.2c2p.com/storedCardPaymentV2/AuthPayment.aspx';
$config['2c2p_secretkey'] = 'yjc3ve4gwqxp';
$config['2c2p_merchant_publickey'] = APPPATH.'libraries/2c2ppay/demo2.crt';
$config['2c2p_merchant_privatekey'] = APPPATH.'libraries/2c2ppay/demo2.pem';
$config['2c2p_merchant_password'] = '2c2p';
//$config['2c2p_merchant_password'] = 'Media@plex';
$config['2c2p_frontrespurl'] = 'http://www.dooneetv.com/payment/response/creditcard3d';
$config['2c2p_backrespurl'] = 'http://www.dooneetv.com/twoc2p/proBackRespEcJz8eMMCE';



$config['2c2p_encrypt_path'] = APPPATH.'logs/encrypt/';
$config['2c2p_decrypt_path'] = APPPATH.'logs/decrypt/';


