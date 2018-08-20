<?php

$pageid = '537019949683349';
include('core.php');
include('Functions/Send_API.php');

$channelToken = retfunction($pageid, "MESSAGING");
//$channelToken = "EAADmoMigd3oBAG3OvfVyCW4B5BjJtZAwCwk8roAtlkmhqDIxxt9S4dHMxn0nsPgdiVLu4ZAe8D7BZCIbmex2qV2ice7sfATgIMnUTtVP82JrdNUmVyKsaKtdZCUSOzlcTsNfuLk0PKZBKNGvYhgIkjMVuvTJg78AZD";
/*
$rcvr_id = "1288246164623713";
$sender_id = "";
$message = "Hello";
$type="text";
*/

$rcvr_id 		= "1288246164623713"; // mojo on phub
//$rcvr_id		= "1347559928671371";
$sender_id 		= "537019949683349";
$message		= "Hello 4";
$type 			= "text";

//echo $channelToken;
var_dump(Send_message($channelToken,$rcvr_id,$sender_id,$message,$type));



//echo getProfile('1288246164623713', "MESSAGING", '537019949683349');
//getProfile('781591848526101', "COMMENT", '537019949683349');
//echo retfunction('781591848526101', "COMMENT");
//echo getpageToken('537019949683349');
//echo getusertoken('781591848526101')



?>