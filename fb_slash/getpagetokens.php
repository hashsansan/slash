<?php
include('core.php');

$user_access_token = getusertoken('100005911843363');

$accounts = "https://graph.facebook.com/v2.7/me/accounts?access_token=".$user_access_token;
$pg_token = file_get_contents($accounts);
$pagetokens = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $pg_token), true, 512);


for($x = 0; $x <= count($pagetokens); $x++){
	$page_token =  trim($pagetokens['data'][$x]['access_token']); 
	$page_id =  trim($pagetokens['data'][$x]['id']); 
	if(empty($page_id)) {
		$page_id = "00";
	} else {
		$page_id = $page_id;
	}
	dbquery("update fb_token set token='".$page_token."' where pageid = '".$page_id."'");
	
	//echo "update fb_token set token='".$page_token."' where pageid = '".$page_id."'" . "<br>";
}
var_dump($pagetokens);




?>
