<?php 
	include_once('pkcs7.php');
  	
  	$response = $_REQUEST["paymentResponse"]; 
	$pkcs7 = new pkcs7();
	$response = $pkcs7->decrypt($response,"./keys/demo2.crt","./keys/demo2.pem","2c2p");   
	echo "Response:<br/><textarea style='width:100%;height:80px'>". $response."</textarea>"; 
?>


