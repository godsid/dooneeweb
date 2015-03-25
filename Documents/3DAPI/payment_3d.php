<?php

	//Merchant Account Information
	$merchantID = "JT01";				//Get MerchantID when opening account with 2C2P
	$secretKey = "7jYcp4FxFdf0";		//Get SecretKey from 2C2P PGW Dashboard

	//Product Information
	$uniqueTransactionCode = "Invoice".time();		
	$desc = "1 room for 2 nights";
	$amt = "000000000010";			//12 digit format
	$currencyCode = "702";			//Ref: http://en.wikipedia.org/wiki/ISO_4217

	//Customer Information
	$cardholderName = "John Doe"; 	 
	$country = "SG";

	//Request Information
	$timeStamp = time();
	$apiVersion = "8.0";
	$stringToHash = $merchantID . $uniqueTransactionCode . $amt; 
	$hash = strtoupper(hash_hmac('sha1', $stringToHash ,$secretKey, false));  	//Calculate Hash Value
	$encryptedCardInfo = $_POST['encryptedCardInfo'];							//Retrieve encrypted credit card data
 
	//Construct payment request message
	$xml = "<PaymentRequest>
			<version>$apiVersion</version> 
			<merchantID>$merchantID</merchantID>
			<uniqueTransactionCode>$uniqueTransactionCode</uniqueTransactionCode>
			<desc>$desc</desc>
			<amt>$amt</amt>
			<currencyCode>$currencyCode</currencyCode>  
			<panCountry>$country</panCountry> 
			<cardholderName>$cardholderName</cardholderName>   
			<hashValue>$hash</hashValue>
			<encCardData>$encryptedCardInfo</encCardData>
			</PaymentRequest>"; 
		
		
		//Full request elements:
			/*
			$xml = "<PaymentRequest>
			<version>$apiVersion</version>						//request version number (8.0)
			<timeStamp>$timeStamp</timeStamp>					//request timestamp
			<merchantID>$merchantID</merchantID>				//Merchant MID
			<uniqueTransactionCode>$uniqueTransactionCode</uniqueTransactionCode>	//Merchant's transaction ID
			<desc>$desc</desc>									//Transaction descrption
			<amt>$amt</amt>										//Transaction amount in 12 digit format
			<currencyCode>$currencyCode</currencyCode>			//Transaction Currency code
			<storeCardUniqueID></storeCardUniqueID> 			//For authorization with Stored Card Token
			<panBank></panBank> 								//Card holder bank name
			<panCountry></panCountry> 							//Card holder bank country
			<cardholderName>$cardholderName</cardholderName> 	//Card holder name
			<cardholderEmail></cardholderEmail> 				//Card holder email
			<payCategoryID></payCategoryID> 					//Transaction category ID
			<userDefined1></userDefined1> 						//Merchant defined field
			<userDefined2></userDefined2>  						//Merchant defined field
			<userDefined3></userDefined3>  						//Merchant defined field
			<userDefined4></userDefined4>  						//Merchant defined field
			<userDefined5></userDefined5>  						//Merchant defined field
			<storeCard>N</storeCard>  							//Store card details after transaction completed Y/N
			<recurring></recurring> 							//Recurring - transaction Y/N
			<invoicePrefix></invoicePrefix> 					//Recurring - invoice prefix (max 15 chars)
			<recurringAmount></recurringAmount> 				//Recurring - transaction amount
			<allowAccumulate></allowAccumulate> 				//Recurring - allow transaction amount to accumulate over draft
			<maxAccumulateAmt></maxAccumulateAmt> 				//Recurring - maximum over draft amount allowed
			<recurringInterval></recurringInterval> 			//Recurring - interval in days
			<recurringCount></recurringCount> 					//Recurring - number of occurance
			<chargeNextDate></chargeNextDate> 					//Recurring - next charge date
			<promotion></promotion> 							//Promotion code
			<hashValue>$hash</hashValue>						//Request hash value
			<encCardData>$encryptedCardInfo</encCardData>		//Encrypted card data
			</PaymentRequest>"; 
			*/

	$payload = base64_encode($xml);		//Convert payload to base64
?>

<!--Construct form to submit authorization request to 2c2p PGW-->
<!--Payment request data should be sent to 2c2p PGW with POST method inside parameter named 'paymentRequest'-->
<form action='http://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx' method='POST' name='authForm'>
	<!--display wait message to user when page is loading-->
	Please wait for a while. Do not close the browser or refresh the page.		
	<!--load request data-->
	<?php echo "<input type='hidden' name='paymentRequest' value='".$payload."'>"; ?>
</form>

<script language="JavaScript">
	document.authForm.submit();			//submit form to 2c2p PGW
</script>
