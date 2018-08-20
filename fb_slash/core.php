<?php
date_default_timezone_set('Asia/Manila');
/*
$servername = "120.28.99.56";
$username = "su";
$password = "suadmin";
$dbname = "unified";
$port = "8888";

*/

$hubVerifyToken = 'slashytesttoken';

//$accessToken ="EAADmoMigd3oBAFTEGbCxcNrIbZCIosbL5ceNIapijfVnl7gNXWOK1qu65eeG5qNZAM73wH1qY8MNWGLYkZC4kRiMyeAVqHlv2mfZAMiEUpMTiT3t3MKmRx6ylseSgXII8872NPwgnH9dJNLprOqHhHkvtZBzHceDHKFOneynp4gZDZD";
//$accessToken ="EAADmoMigd3oBAHytReN7DWyGBj1eYveTBpdMo4az9Kk0hcaUfSRbaZBpFzMNmvdK1V27sHI20fvcpgXGRH2oBqJSwOd8wUyS3ZAHzEpO0XaZAk7X7U6ewcgOnM2rH8Q5paxngxisXQ8n9JdDs8eZADwZBvRPWZBPNVso6tGRx6uPlt3zNsvxdkrdt2Wsh69jcZD";
//$accessToken ="EAADmoMigd3oBAJVeqZCAslYHhSKTZC6gEcMVxRCI23ZC1eB0ZBZB4Kc4fDEOD8JPZCR2PYbcN5FPZBkyi2nLqcXZAuk1fllocedyciHu92Vb0vHOJQe2JHIEuthdNSUZAALUq3yEJZAK1Fh62YZBPhsO1UAcybo7pQ88OB3VTXpcsQg0wZDZD";
//$accessToken ="EAADmoMigd3oBAOvWVBBkVT8TGxto2GtwpTTHDrlzIywQ79LT7ZCpchX4XuMOogR6FiKjmBjRLGSgxxAUS3Piafqr1CT7Hfr6LfN1f8t5ZAKF3Qd5lQplJc1dSKl4rTvL7gvx22P7iSRiBBHuLZCZAyxHxhVrwnLBeBoUbfa6tQZDZD";
//$accessToken ="EAADmoMigd3oBAF9ehq4eON4Q5VX4y9yFAEfkIsWP7hElZC5VU2APzZCHuRzZBhKWJc5H4sttF2WZCueUiVBtRRv2fOCGeZAbmAo2XV4qoztuzxX1JvMW1v0lY1KFtWF8ZBuuPPkHrwXqZC16LV28YIZCHmur8Dc7gjoTpitkZAoQsJgZDZD";
//$accessToken ="EAAavTO5gC2wBACNf9ZC4lmZAqMkTFNv0btXrKmkbyC3rxAFSrQbx5anaVHs0GjCu6ooLx5kIy4JfTZBKXFf7uVovzAqvOWhyRSzslZBAmE2vjO9E3cRRayNfnP8axByWYU6m7htzSNVwxBjJHQZBWfgpHzORlMa0lQv24cLJBUgZDZD";
//$accessToken ="EAAavTO5gC2wBAFqZCyALvGIb0lmJR9wYKBZAn4nMRjc0pAiuLTQ7Pg42WnSVuH38sO14TaUFUWY1cgdcwsji652owD0ZCGFKDipQkAYKt1JvyzvfjbSsa8EmconJdZBjfp1oBn29BxkAiNGhZA8KZBy8c8JPZC2cJSxp409LSe8CwZDZD";
//$accessToken ="EAAC4pMybEzQBAE6ymoiBkDJSh5nygC0tclsXbXzeY8WF1AGeXhKnPkkuPhmB6ZA2gMvKhmM2EWZAXrbSzvWdxfhsLeGxhtAUa5I9tqZCxElsUGZAG3psszWtGRg5ZBtkLqVHn3RAvZAoqg3UgjXpyJHdx33H8PZAXvBSMZCx6WgLCQZDZD";
//$accessToken ="EAADmoMigd3oBAOai3quxhPsfsSGBxuV6QBdogrwy0KFdZARyZC9D360l417TZAfoZC0J11IYDxVGZBpePxG09l1Vr5c0XcbSEF9YD9ZAUuxovbIAkaGalCWDdoTf01e55e5ZBVvCxrt5ZCEZCAUwccpR7NrCNVIBdIYLezeAgzsEvpjwHZCSQp1roqNl4txvrMOf2vCq3JtQaNLAZDZD";
//$accessToken ="EAAavTO5gC2wBAKzh44ppnoxCedBONF2NCpR9fnr0BglpyA6noghZBQgzrrUySb1mk3V4zebWXNOKOYfNfmUveETifyYtRXSwjUjjENG1dODD12eEjU6M6DlQdzHtrKf7FE3LV8ZAQlUIZBmDZApuXmjUS2aFwoaHz0YFTJGmkBO4ihroGOgz";
//$accessToken ="EAAavTO5gC2wBAEKCkZChddAEYqMkDjTaSkwnfAX9Nqkk5NKhVvAhfWaR1q4B1LhB0U1uRjnw7pMCTkaFvUG7MYbATlPCD6rx7pEJ89Tecyn9K9sjXXhuu9frtKvyBwUFLtLdfhOcTZCB4IjN2MbBpZBaain00ZBVZCN5MdprtusY9Kcs28VFg";
#SlashdotPH
#$accessToken ="EAAavTO5gC2wBADn8pc2OI7T09tnKj2oEVjzyRpWEjAf1nMZALSkJFpeCxmOyvL3diEbwMpY1jN2gnAgFEsr6nJgcSeelEzPh3MfI8Sp8FWaoGXbPK96FcKCnenIsz2aZAMORznZAFJ4DnsXL7XmOI7bqlk5W1bHml3edYSVrAZDZD";

#Destiny Cable
$accessToken ="EAAavTO5gC2wBALQGksWZBUrQSxrMvmX8Cc6RZB6hLUc20k0oXCuqqGMjFUTrwA7D6geXJqtZANXxJfBtQT35Ht9brP6warBfYbpKLzUqJaEmuFvOMECpZCenZC1XPMwXZCO631vIvQhTNGsanxfZAQAduDTqfkYQyR5EsVneg7r6AZDZD";

#EAAavTO5gC2wBADBd13WFvMmJ9CBimvckSQVDzuekPR8Dx3vjOJc5pp9OGzzPA3PIINfOYOkOXpJsFBxcxyWunQG7hKQdxRDETKtKZBjrN3UGS5mystQ2ZCHX4jd8hjlaoLk6QjvYvZBf2KnyvI4qomQJvSi81zs6dXRJJ5kO10zYtis1UcrjYmdYAtXfwATbobcblTKfwZDZD
#EAAavTO5gC2wBAPVsZBqprZBtKeECaP5Wld3PdFLfL6ftS29tsqlsF7shnAHtTIa82PXeM1UKkv4bjADgcsZB6HAMB60A2gNSmX4uQ9Y6lJxDKL1ZAhmSrrJZBolI37gtLX0w0wZAx10D7SqZBZCDdtTWZCinip5fmzmhBXo3PvV06ZCluIexq2tyXITXm8knfAZARCwQoJhN3WP7wZDZD
#EAAavTO5gC2wBAGAUUp0ZBnoo6FNQXSqgrAZAP8RWND0ZBazMhwXBfQxnZCPFyIkpnOG3KnMiavU3rlIuZBFGYCbZAheWJUpfZA9H8wXW29cw5pb1yGngCZAXr5AiHzQQhUFJs9b2uQUw6MZCXo99f404R4DSqymt7tK9hktnoZADgBHgZDZD
$arraypage = array(
    'Destiny Cable' => '357138337716463',
     'Slashdotph' =>'228362557544701'
);

#$pagename="Slashdotph";



if (isset($_GET['hub_verify_token']) && $_GET['hub_verify_token'] == $hubVerifyToken) {
  echo $_GET['hub_challenge'];
  exit;
}

 /*
 $servername = "localhost";
 $username = "root";
 $password = "admin@123";
 $dbname = "unified";
 $port = "3306";*/

$servername = "10.237.143.138";
 $username = "su";
 $password = "suadmin";
 #$dbname = "unified";
 $dbname = "unified_demo";
 $port = "3306";


function selectInsert($checkquery, $insertquery, $updatequery){

 global $servername;
 global $username;
 global $password;
 global $dbname;
 global $port;
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if($checkquery == ""){
	if($conn->query($insertquery) == true){
		//$conn->query($updatequery);
	}else{
		echo $conn->error;
	}	
}else{
	$result = $conn->query($checkquery);
	if ($result->num_rows < 1) {
		$conn->query($insertquery);
		//$conn->query($updatequery);
	}
}

$conn->close();
}


function prcAttahment($chkquery, $insertquery, $url, $stick_id){

 global $servername;
 global $username;
 global $password;
 global $dbname;
 global $port;
	
 $parseurl = substr($url, 0, strpos($url, "?"));
 $filename = basename($parseurl);
	//$unparstype = split("\.", $filename); 
	//$filetype = $filetye[1];
	
 $content = addslashes(file_get_contents($url));
 $new_insert = str_replace('attach_name', $filename, $insertquery);
		
 $conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

	$result = $conn->query($chkquery);
	if ($result->num_rows < 1) {
			$conn->query($new_insert." ,att_bin='".$content."'");
		}
	if($stick_id <> "00000"){
	$sticker_check = "select sticker_id from fb_stickers where sticker_id='".$stick_id."'";
	$sticker_exist = $conn->query($sticker_check);
		
		if ($sticker_exist->num_rows < 1) {
			$insert_sticker = "insert into fb_stickers set sticker_id='".$stick_id."', sticker_bin='".$content."'";
			$conn->query($insert_sticker);
		}
			
	}

  $conn->close();
	 
}


function prcFeeds($checkquery, $insertquery, $updatequery, $updrec){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

	$result = $conn->query($checkquery);
	if ($result->num_rows < 1) {
		$conn->query($insertquery);
	}else{
		if($updatequery <> ""){
			$conn->query($updatequery);
		}
	}	
	//$conn->query($updrec);

  $conn->close();
}

function prcFeedsAttachments($chk, $ins, $link){

global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);
	//$content = addslashes(file_get_contents($link));
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	$result = $conn->query($chk);
	if ($result->num_rows < 1) {
			
		if($link <> "no link available"){
			$conn->query($ins . ", att_bin='".$content."'");
		}else{
			$conn->query($ins);
		}
	}
	
$conn->close();

}


function unParse($rw){

global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);
		
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	$err = "insert into fb_logs_sky set msg = '".$rw."'";
	$conn->query($err);

$conn->close();

}


function retfunction($funckey, $type){
	if($type == "MESSAGING"){
		return getpageToken($funckey);
	}else{
		return getusertoken($funckey);
	}
}


function getProfile($id, $src, $pg){

global $servername;
global $username;
global $password;
global $dbname;
global $port;


$fbid = "";
$fbname = "";
$fbphoto = "";


$actk  = retfunction($pg, "MESSAGING");
$utoken = retfunction($pg, "COMMENT");

$conn = new mysqli($servername, $username, $password, $dbname, $port);
		
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	if($src == "MESSAGING"){
		$chk = "select fb_id from fb_friends where fb_id = '".$id."' and page_id = '".$pg."'";
	}else{
		$chk = "select fb_id from fb_friends where fb_id = '".$id."'";
	}
	

	
	//echo "chk: ".$chk." src: ".$src;
	$result = $conn->query($chk);
	if ($result->num_rows < 1) {
	
		if($src == "MESSAGING"){
			$url = "https://graph.facebook.com/v2.9/".$id."?fields=first_name%2Clast_name%2Cprofile_pic%2Clocale%2Ctimezone%2Cgender&access_token=" . $actk;
			$db_date = file_get_contents($url);
			//$json = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $db_date), true, 512,JSON_BIGINT_AS_STRING);
			$json = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $db_date), true, 512);
			
			$fbname = $json['first_name'] . " " . $json['last_name'];
			$fbid =  $id;
			$fbphoto =  $json['profile_pic'];
			
			$img = addslashes(file_get_contents($fbphoto));
			
			//$img = addslashes(file_get_contents($fbphoto));

			if(strpos($img,"request failed") > 0){
				//$fbphoto = "http://localhost/fb_parser/noprofile.gif";
				$fbphoto = "http://localhost/fb_parser/noprofile.gif";
				$img = addslashes(file_get_contents($fbphoto));
			}

			
			$insertfriend = "INSERT INTO fb_friends SET fb_id = '".$fbid ."', fb_name ='".$fbname."', fb_photo_url='".$fbphoto."', fb_photo='".$img."', page_id = '".$pg."', source='MESSENGER'";
		
	
			
			$conn->query($insertfriend);
			
			//echo $url;
			
				
			
		}else{
			
			$url = "https://graph.facebook.com/v2.9/".$id."?fields=last_name%2Cfirst_name%2Cpicture&access_token=". $utoken;
			$db_date = file_get_contents($url);
			
			//$json = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $db_date), true, 512,JSON_BIGINT_AS_STRING);
			$json = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $db_date), true, 512);
			$fbname = $json['first_name'] . " ". $json['last_name'];
			$fbid =  $id;
			$fbphoto =  $json['picture']['data']['url'];
			
			$img = addslashes(file_get_contents($fbphoto));
			
			if(strpos($img,"request failed") > 0){
				$fbphoto = "http://localhost/fb_parser/noprofile.gif";
				$img = addslashes(file_get_contents($fbphoto));
			}
			
			$insertfriend = "INSERT INTO fb_friends SET fb_id = '".$fbid ."', fb_name ='".$fbname."', fb_photo_url='".$fbphoto."', fb_photo='".$img."', page_id = '".$pg."', source='FB'";
			$conn->query($insertfriend);
			
			//echo $insertfriend;
			echo $url;

			$file = 'url.txt';
			$current = file_get_contents($file);
			file_put_contents($file, $url);				
			
		}
	

	}
	
$conn->close();

}



function getpageToken($pageid){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	$tkquery = "select token from fb_token where page_id='".$pageid."' order by rowid desc limit 1";
	$result = $conn->query($tkquery);
	if ($result->num_rows > 0) {
		$row=mysqli_fetch_assoc($result);
		$dbtoken = $row['token'];
	}else{
		$dbtoken = $tkquery;
	}
	//$conn->query($updrec);

return $dbtoken;
 $conn->close();
 
}

function getusertoken($fbid){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	$tkquery = "select token from fb_token where type='user' order by rowid desc limit 1";
	$result = $conn->query($tkquery);
	if ($result->num_rows > 0) {
		$row=mysqli_fetch_assoc($result);
		$dbtoken = $row['token'];
	}else{
		$dbtoken = $tkquery;
	}

$conn->close();
 
return $dbtoken;
 
}



function dbquery($qry){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	$result = $conn->query($qry);
	//echo $result;
	
$conn->close();
 
//return $dbtoken;
 
}


function GetBotResponse($keyword){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	$tkquery = "select reply from bot_msg_keyword WHERE keyword = '".str_replace("'", "", $keyword)."' order by rowid desc limit 1";
	$result = $conn->query($tkquery);

	if ($result->num_rows > 0) {
		$row=mysqli_fetch_assoc($result);
		$dbreply = $row['reply'];
		#$dbtransfer = $row['agenttransfer'];
	}else{
		$tkquery = "select reply from bot_msg_keyword WHERE keyword IS NULL order by rowid desc limit 1";
		$result = $conn->query($tkquery);
		if ($result->num_rows > 0) {
			$row=mysqli_fetch_assoc($result);
			$dbreply = $row['reply'];
			#$dbtransfer = $row['agenttransfer'];
		}else{
			$dbreply = "An Error Occurred";
			#$dbtransfer = "0";
		}
	}

	//echo $tkquery;
$conn->close();
 
    $dbmsg = $dbreply;
    #$dbmsg['agenttransfer'] = $dbtransfer;
 
return $dbmsg;

}


function AgentTransfer($keyword){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	$tkquery = "select agenttransfer from bot_msg_keyword WHERE keyword = '".str_replace("'", "", $keyword)."' order by rowid desc limit 1";
	$result = $conn->query($tkquery);
	if ($result->num_rows > 0) {
		$row=mysqli_fetch_assoc($result);
		$dbtransfer = $row['agenttransfer'];
	}else{
		$dbtransfer = "0";
	}

	//echo $tkquery;
$conn->close();
 
    $dbmsg = $dbtransfer;
 
return $dbmsg;

}

function GetLastTransaction($fbid){
	
global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	$tkquery = "SELECT stat, date_retrieved FROM `fb_private_message` WHERE fbfrom_id = ".$fbid." ORDER BY object_id DESC LIMIT 1";
	$result = $conn->query($tkquery);
	if ($result->num_rows > 0) {
		$row=mysqli_fetch_assoc($result);
		$mylast['stat'] = $row['stat'];
		$mylast['date_retrieved'] = $row['date_retrieved'];
	}else{
		//$dbtransfer = "0";
		$mylast['stat'] = "BOT ANSWER";
		$mylast['date_retrieved'] = date("Y-m-d H:i:s");
	}

	//echo $tkquery;
$conn->close();
 
return $mylast;

}

function CheckThreshold($lastdatetrans){
	
	// Create two new DateTime-objects...
	$date1 = new DateTime($lastdatetrans);
	$date2 = new DateTime(date("Y-m-d H:i:s"));

	// The diff-methods returns a new DateInterval-object...
	$diff = $date2->diff($date1);

	// Call the format method on the DateInterval-object
	return $diff->format('%i');
	
}
?>