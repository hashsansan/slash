<?php

/*
$user_token = $_GET['code'];

$redirect = "https://graph.facebook.com/oauth/access_token?client_id=253578235115386&client_secret=3ed2202c1bc2671f8d89692ea4daf1a4&redirect_uri=https://bbc680d2.ngrok.io/fb_parser/slash_sns.php&code=". $user_token;

$tk = file_get_contents($redirect);

/*
$servername = "120.28.99.56";
$username = "su";
$password = "suadmin";
$dbname = "unified";
$port = "8888";

*/

 $servername = "localhost";
 $username = "su";
 $password = "suadmin";
 $dbname = "unified_web";
 $port = "3306";

 $tokie = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $tk), true, 512, JSON_BIGINT_AS_STRING);
 
 
 $insrt = "insert into fb_token set type='user_access_token', token='".$tokie['access_token'] ."'";

$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->query($insrt);
$conn->close();
*/
?>