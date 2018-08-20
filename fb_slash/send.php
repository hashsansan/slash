<?php
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 0);


include('core.php');
include("Functions/Send_API.php");

//$channelToken	= "EAADmoMigd3oBAABvqg9T9EvlkExRQNHfHt63zELt5ttJ11pQnb1URWPglK6yE2yVRlB60bHJbzsZBZB7wHHZCAO147VoNp113zKOVh7DuDV8XiLyH6d5t3PJZCVhtPF8159rKZCYzio5V8OpPUqAakA1mY6YdiS0ZD";
#$channelToken	= "EAAavTO5gC2wBADs7UVakhCTJVJgg4uq8XHd5OgzEPVs1Hv5ZAMhBnyGt2CMZBHVALIFJEH65ZCAvZBgfKnjQK7kryzCwo5f0ZBDBZCPGviYfwD8i4zLpU07vuiEZAhZCdF8ZCYObJgcPZBYrT0GVu6YfxeY9PQqi4t6l1vuZCqQlCDjoQZDZD";

#From Slash AppV1 RMD Slash
#EAAavTO5gC2wBAM4fZACnycNQvCZA2twQjkoJuFRbZCnmZBxCoFsZC1fevE7ZAtRPbwK1UFzPDLpneQVrabWMZCZBR9o1kERZB5XHh8DWbtpwnyWOTrlaTLfFGhnDE0wBVK6ZBLyOrQsVdjWMMcZA38SbwWbZBatylufgItWm7g3nWZCi6kwZDZD
#slashdotph page
#$channelToken	= "EAAavTO5gC2wBAM4fZACnycNQvCZA2twQjkoJuFRbZCnmZBxCoFsZC1fevE7ZAtRPbwK1UFzPDLpneQVrabWMZCZBR9o1kERZB5XHh8DWbtpwnyWOTrlaTLfFGhnDE0wBVK6ZBLyOrQsVdjWMMcZA38SbwWbZBatylufgItWm7g3nWZCi6kwZDZD";
#destiny cable
#$channelToken	= "EAAavTO5gC2wBALQGksWZBUrQSxrMvmX8Cc6RZB6hLUc20k0oXCuqqGMjFUTrwA7D6geXJqtZANXxJfBtQT35Ht9brP6warBfYbpKLzUqJaEmuFvOMECpZCenZC1XPMwXZCO631vIvQhTNGsanxfZAQAduDTqfkYQyR5EsVneg7r6AZDZD";

#from fb token
#EAAavTO5gC2wBADn8pc2OI7T09tnKj2oEVjzyRpWEjAf1nMZALSkJFpeCxmOyvL3diEbwMpY1jN2gnAgFEsr6nJgcSeelEzPh3MfI8Sp8FWaoGXbPK96FcKCnenIsz2aZAMORznZAFJ4DnsXL7XmOI7bqlk5W1bHml3edYSVrAZDZD
#$channelToken	= "EAAavTO5gC2wBADn8pc2OI7T09tnKj2oEVjzyRpWEjAf1nMZALSkJFpeCxmOyvL3diEbwMpY1jN2gnAgFEsr6nJgcSeelEzPh3MfI8Sp8FWaoGXbPK96FcKCnenIsz2aZAMORznZAFJ4DnsXL7XmOI7bqlk5W1bHml3edYSVrAZDZD";

#Slash Page ID
#$pageid = "228362557544701"; 

#Destiny Cable Page ID
#$pageid = "357138337716463";
#$argv[1]

if($argv[1] <> ""){
	
	$pageid = $argv[1]; 
	
}else{
	
	$pageid = $_GET['pageid']; 
	
}


$channelToken = getpageToken($pageid);

global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	$uncleanmsg = file_get_contents('php://input');
	$parsevar = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $uncleanmsg), true, 512);
	$msg = $parsevar['entry'][0]['messaging'][0]['message']['text'];
	$message_type = $parsevar['entry'][0]['messaging'][0]['message'][0]['attachments']['type'];

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	//$fbqueue = "SELECT rowid, fbid, msge, msg_ref_id, fb_page_id, source, msg_type FROM fb_sent WHERE stat='queue'";
	#$fbqueue = "SELECT * FROM fb_sent WHERE stat='queue'";
	$fbqueue = "SELECT * FROM fb_sent WHERE stat='queue' AND fb_page_id = '".$pageid."'";
	//$fbqueue = "select rowid, screen_name, conversation_id, msge, stat, msg_type, msg_source, pageid from fb_sent where stat='queue'";
	$result = mysqli_query($conn, $fbqueue);
	
	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if(strpos($row['msg_ref_id'], "PRIVATE POST") !== FALSE)
			{
				if($row["source"] == "MESSENGER")
				{
					
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					#echo "[0]".$rcvr_id. " ".$message. " ".$sender_id. " ".$type."[0]";
					$result = Send_message($channelToken,$rcvr_id,$sender_id,$message,$type);
					
					$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
					echo $result;
					 
					$conn->query($update);
					
				}
				elseif($row['msge'] <> "")
				{
					
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					//$postcomment = "https://graph.facebook.com/v2.8/".trim($rcvr_id)."/comments/?access_token=".$accessToken."&message=".trim(urlencode($message))."&method=POST";
					$input = json_decode(file_get_contents('php://input'), true);
					$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
					$message = $input['entry'][0]['messaging'][0]['message']['text'];
					
					$url = 'https://graph.facebook.com/v2.12/me/messages?access_token='.$accessToken;
					
					$ch = curl_init($url);
					$jsonData = '{
							"recipient":{
									"id":"'.$row['fbid'].'"
							},
							"message":{
									"text":"'.$row['msge'].'"
							}
						}';
						
					$jsonDataEncoded = $jsonData;
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$result = curl_exec($ch);
					curl_close ($ch);
					//$result = file_get_contents($postcomment);
					
					if($result)
					{
						//echo $postcomment;
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
						echo $result;
						$conn->query($update);
					}
					else
					{
						echo mysqli_error();
					}
				}
				elseif($row['msg_type'] == "IMAGE")
				{
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken;
					
					$ch = curl_init($url);
					$jsonData = '{
							"recipient":{
								"id":"'.$row['fbid'].'"
							},
							"message":{
								"attachment":{
									"type":"image", 
									"payload":{
										"is_reusable":"true",
										"url":"'.$row['attachment'].'"
									}
								}
							}
						}';
						
					$jsonDataEncoded = $jsonData;
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$result = curl_exec($ch);
					curl_close ($ch);
					
					if($result)
					{
						//echo $postcomment;
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
						echo $result;
						$conn->query($update);
					}
					else
					{
						echo mysqli_error();
					}
				}
				elseif($row['msg_type'] == "FILE")
				{
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken;
					
					$ch = curl_init($url);
					$jsonData = '{
							"recipient":{
								"id":"'.$row['fbid'].'"
							},
							"message":{
								"attachment":{
									"type":"file", 
									"payload":{
										"is_reusable":"true",
										"url":"'.$row['attachment'].'"
									}
								}
							}
						}';
						
					$jsonDataEncoded = $jsonData;
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$result = curl_exec($ch);
					curl_close ($ch);
					
					if($result)
					{
						//echo $postcomment;
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
						echo $result;
						$conn->query($update);
					}
					else
					{
						echo mysqli_error();
					}
				}
				elseif($row['msg_type'] == "VIDEO")
				{
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken;
					
					$ch = curl_init($url);
					$jsonData = '{
							"recipient":{
								"id":"'.$row['fbid'].'"
							},
							"message":{
								"attachment":{
									"type":"video", 
									"payload":{
										"is_reusable":"true",
										"url":"'.$row['attachment'].'"
									}
								}
							}
						}';
						
					$jsonDataEncoded = $jsonData;
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$result = curl_exec($ch);
					curl_close($ch);
					
					if($result)
					{
						//echo $postcomment;
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
						echo $result;
						$conn->query($update);
					}
					else
					{
						echo mysqli_error();
					}
				}
				elseif($row['msg_type'] == "AUDIO")
				{
					$rowid 		= $row['rowid'];
					$rcvr_id 	= $row['fbid'];
					$message 	= $row['msge'];
					$sender_id 	= $row['fb_page_id'];
					$type 	 	= $row['msg_type'];
					
					$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken;
					
					$ch = curl_init($url);
					$jsonData = '{
							"recipient":{
								"id":"'.$row['fbid'].'"
							},
							"message":{
								"attachment":{
									"type":"audio", 
									"payload":{
										"is_reusable":"true",
										"url":"'.$row['attachment'].'"
									}
								}
							}
						}';
						
					$jsonDataEncoded = $jsonData;
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					$result = curl_exec($ch);
					curl_close($ch);
					
					if($result)
					{
						//echo $postcomment;
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
						echo $result;
						$conn->query($update);
					}
					else
					{
						echo mysqli_error();
					}
				}
			}
			elseif(strpos($row['msg_ref_id'], "PUBLIC POST") !== FALSE)
			{
				$go = json_decode($row['conversation_id'], TRUE);
				if( isset($row['conversation_id']) )
				{
					$url = "https://graph.facebook.com/{$row['conversation_id']}/comments";

					$attachment =  array(
							#'access_token'  => $accessToken,
							'access_token'  => $channelToken,
							'message'       => $row['msge'],
					);

					// set the target url
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
					curl_close($ch);
					$result = json_decode($result, TRUE);
					print_r($result);
					
					
					if($result)
					{
						$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$row['rowid']."'";
						$conn->query($update);
						echo $result;
					}
					else
					{
						echo mysqli_error();
					}
				}
				
				if($row['is_like'] == "1")
				{
					$url = "https://graph.facebook.com/{$row['conversation_id']}/likes";
					
					$ch = curl_init();

					// set URL and other appropriate options
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HEADER, 0);

					// grab URL and pass it to the browser
					curl_exec($ch);

					// close cURL resource, and free up system resources
					curl_close($ch);
				}
				
			}

		}

	}
	//$conn->query($updrec);

 $conn->close();




/*

$db = new PDO('mysql:host=localhost;dbname=unified;charset=utf8mb4', 'su', 'suadmin');
try {
    $stmt = $db->query("SELECT rowid,user_id,msge,msg_type FROM fb_sent WHERE stat = 'queue' ORDER BY rowid LIMIT 1");
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	$rowid 		= $rows['rowid'];
	$rcvr_id 	= $rows['user_id'];
	$message 	= $rows['msge'];
	$sender_id 	= "";
	$type 	 	= $rows['msg_type'];
} catch(PDOException $ex) {
    echo $ex->getMessage();
}



$result = Send_message($channelToken,$rcvr_id,$sender_id,$message,$type);

if($result === true) {
	try {
		$stmt = $db->query("UPDATE fb_sent SET stat = 'sent', sent_date = NOW() WHERE rowid = '".$rowid."'");
		$affected_rows = $stmt->rowCount();
		if($affected_rows > 0) {
			echo "Success!";
		} else {
			echo "Failed!";
		}
	} catch(PDOException $ex) {
		echo $ex->getMessage();
	}
} else {
	var_dump($result);
}

*/

?>

	<script>
		'use strict';

			// Imports dependencies and set up http server
		const
		express = require('express'),
		bodyParser = require('body-parser'),
		app = express().use(bodyParser.json()); // creates express http server

		// Sets server port and logs message on success
		app.listen(process.env.PORT || 80, () => console.log('webhook is listening'));
	</script>
