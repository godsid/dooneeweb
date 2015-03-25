<?php

$secret = 'fdoonejifosofoi320'; // To make the hash more difficult to reproduce.
$baseuri = '/shc/hd/MISS_POTTER_HD'; // This is the file to send to the user.
//$uri	= "$baseuri/playlist.m3u8"; // This is the file to send to the user.

 
	$uri	=  $_GET["contenturl"];  //change to your content location ex. "media.imovie.com/movie1.mp4"

$e = time() + 6000; // At which point in time the file should expire. time() + x; would be the usual usage.

$rawhash=$secret . $baseuri . $e . $_SERVER['REMOTE_ADDR'];
echo "<p>" . $rawhash . "</p>";
 
$m = base64_encode(md5($rawhash , true)); // Using binary hashing.

$m = strtr($m, '+/', '-_'); // + and / are considered special characters in URLs, see the wikipedia page linked in references.
$m = str_replace('=', '', $m); // When used in query parameters the base64 padding character is considered special.

echo "<html><body>"; 

echo "<p>You have 60 seconds to access via this link -> <br>";
echo "<a href=\"$uri?m=$m&e=$e\" target=\"_blank\">$uri?m=$m&e=$e</a></p>";
 
echo "<p> URI = $uri";
echo "";
echo "</body></html>";
?>