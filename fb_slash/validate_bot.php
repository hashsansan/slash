<?php

include("core.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '89'"; // DONE HERE SUBS REPLY PLAIN TEXT
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '12252'"; // DONE HERE PAGE REPLY PLAIN TEXT
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '7025'"; //wall posted items--- error due to string is passed by webhook instead of json
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '7074'"; // DONE HERE SUBS WALL POST STICKERS MESSAGE, NO STICKIE FOUND ON URL 
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '5855'"; //DONE HERE FOR HIT LIKE FOR COMMENT
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '751'";  //DONE HERE FOR REACTIONS

///////////////////////////////

//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '6845'"; //DONE HERE SUBS SEND TEXT ONLY
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '6858'"; //DONE HERE PAGE REPLY TEXT ONLY
///$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '7017'"; //DONE HERE SUBS SEND STICKERS

/////////////////////////////////////

//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '3963'"; //PAGE POST STATUS   //DONE HERE
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '4004'"; // PAGE POST VIDEO   //DONE HERE
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '5909'"; // PAGE POST PICTURE		//DONE HERE
//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '37'"; /// PAGE SHARE WEB //DONE HERE

//$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE rowid = '13969'";

///////////
/*
$sql = "SELECT rowid, msg FROM fb_logs_sky WHERE seen = 0 order by rowid desc limit 100";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
		
$uncleanmsg = $row['msg'];
*/

$uncleanmsg = file_get_contents('php://input');

		//$parsevar = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $uncleanmsg), true, 512,JSON_BIGINT_AS_STRING);
		$parsevar = json_decode(preg_replace("/\r\n|\r|\n/",'<br>', $uncleanmsg), true, 512);
			
		
		if(strpos($uncleanmsg,'published') !== false){
		
			///process page feeds including wall posts, photos, vids
			
			$x_object_type = $parsevar['entry'][0]['changes'][0]['value']['item'];
			
			switch ($x_object_type) {
				case "photo":
				$x_object_id = $parsevar['entry'][0]['changes'][0]['value']['photo_id'];
				break;
				case "video":
				$x_object_id = $parsevar['entry'][0]['changes'][0]['value']['video_id'];
				break;
				
			default:
				$x_object_id = "xx";
			}
			
				if(isset($parsevar['entry'][0]['changes'][0]['value']['message'])){
					$x_msg = str_replace("'", "",str_replace('\r\ n', '', $parsevar['entry'][0]['changes'][0]['value']['message']));
				}else{
					$x_msg = "no message";
				}
				
				if(isset($parsevar['entry'][0]['changes'][0]['value']['created_time'])){
					$x_createdtime = $parsevar['entry'][0]['changes'][0]['value']['created_time'];
				}else{
					$x_createdtime = "000000000";
				}
				
				if(isset($parsevar['entry'][0]['changes'][0]['value']['link'])){
					$postlink = $parsevar['entry'][0]['changes'][0]['value']['link'];
				}else{
					$postlink = "no link available";
				}
			
			$_sendername = $parsevar['entry'][0]['changes'][0]['value']['from']['name'];
			$x_post_id = $parsevar['entry'][0]['changes'][0]['value']['post_id'];
			$x_verb = $parsevar['entry'][0]['changes'][0]['value']['verb'];
			$x_published = $parsevar['entry'][0]['changes'][0]['value']['post']['is_published'];
			$x_page_id = $parsevar['entry'][0]['id'];
			
			
			$checkqry = "select post_id from fb_mypost where post_id='".$x_post_id."' and actor_id='". $x_page_id ."'";
			$upd = "";//"update fb_logs_sky set seen=1 where rowid='".$row['rowid']."'"; 
			
			$insert = "insert into fb_mypost set post_id = '".$x_post_id ."', actor_id='". $x_page_id ."', message='". $x_msg ."', created_time='". $x_createdtime ."', type='". $x_object_type ."', href1='".$postlink."', href2='".$postlink."', fb_object_type='".$x_object_type."', fb_object_id='".$x_object_id."', can_comment='".$x_published."', alt='".$x_verb."'";
			$result = mysqli_query($conn, $insert);
			if(!$result)
			{
				echo mysqli_error();
			}
			
			if($x_verb <> 'add'){
			
				$updatequery = "update fb_mypost set post_id = '".$x_post_id ."', actor_id='". $x_page_id ."', message='". $x_msg ."', created_time='". $x_createdtime ."', type='". $x_object_type ."', href1='".$postlink."', href2='".$postlink."', fb_object_type='".$x_object_type."', fb_object_id='".$x_object_id."', can_comment='".$x_published."',alt='".$x_verb."' where  post_id='".$x_post_id."' and actor_id='". $x_page_id ."'";
				$result = mysqli_query($conn, $updatequery);
			}else{
			
				$updatequery = "";
			}
			
			prcFeeds($checkqry, $insert, $updatequery, $upd);
			
			$attachmentquery = "insert into fb_mypost_attachment set att_type= '".$x_object_type."', att_id='".$x_object_id."', post_id='".$x_post_id."', created_time='".				$x_createdtime."', fb_page_id='".$x_page_id."', att_url = '".$postlink."'";
			$checkattachment = "select att_id from fb_mypost_attachment where att_id='".$x_object_id."' and fb_page_id='".$x_page_id."'";
			
			prcFeedsAttachments($checkattachment, $attachmentquery, $postlink);
			
			echo "type :" . $x_object_type;
			echo "<br>";
			echo "object_id :" . $x_object_id;
			echo "<br>";
			echo "sender_name :" . $_sendername;
			echo "<br>";
			echo "post_id :" . $x_post_id;
			echo "<br>";
			echo "verb :" . $x_verb;
			echo "<br>";
			echo "link :" . $postlink;
			echo "<br>";
			echo "published :" . $x_published;
			echo "<br>";
			echo "created_time :" . $x_createdtime;
			echo "<br>";
			echo "message :" . $x_msg;
			echo "<br>";
			echo "-----------";
						
		}elseif(strpos($uncleanmsg,'reaction_type') !== false){
		
			//hit reaction button
		
			$x_item = $parsevar['entry'][0]['changes'][0]['value']['item'];
			$x_reaction_type = $parsevar['entry'][0]['changes'][0]['value']['reaction_type'];
			$x_sender_name = $parsevar['entry'][0]['changes'][0]['value']['from']['name'];
			$x_sender_id = $parsevar['entry'][0]['changes'][0]['value']['from']['id'];
			$x_post_id = $parsevar['entry'][0]['changes'][0]['value']['post_id'];
			$x_created_time = $parsevar['entry'][0]['changes'][0]['value']['created_time'];
			$x_page_id = $parsevar['entry'][0]['id'];
			
			
			$ins = "insert into fb_reactions set reaction_type='". $x_reaction_type ."', sender_name='". $x_sender_name ."', sender_id='". $x_sender_id ."', post_id='". $x_post_id ."', created_time='". $x_created_time ."', page_id='". $x_page_id ."'";
			
			$upd = "";//"update fb_logs_sky set seen=1 where rowid='".$row['rowid']."'"; 
			
			echo "item :" . $x_item;
			echo "<br>";
			echo "reaction_type :" . $x_reaction_type;
			echo "<br>";
			echo "sender_name :" . $x_sender_name;
			echo "<br>";
			echo "sender_id :" . $x_sender_id;
			echo "<br>";
			echo "post_id :" . $x_post_id;
			echo "<br>";
			echo "created_time :" .$x_created_time;
			echo "<br>";
			echo "page_id :" . $x_page_id;
			
			selectInsert("", $ins, $upd);
			getProfile($x_sender_id, "COMMENT", $x_page_id);

		}else{
			
			if(isset($parsevar['entry'][0]['messaging'][0]['message']['mid'])){
			
				//handles messaging
				
				$x_sender_id = $parsevar['entry'][0]['messaging'][0]['sender']['id'];
				$x_mid = $parsevar['entry'][0]['messaging'][0]['message']['mid'];
				$x_time = $parsevar['entry'][0]['time'];
				$x_recipient_id = $parsevar['entry'][0]['messaging'][0]['recipient']['id'];
				$x_seq = $parsevar['entry'][0]['messaging'][0]['message']['seq'];
				$x_page_id = $parsevar['entry'][0]['id'];
				
				//added by dmax
				$forbotmessages = strtoupper(str_replace("'", "", $parsevar['entry'][0]['messaging'][0]['message']['text']));
				
				$mylastrans = GetLastTransaction($x_sender_id);
				$TimeThreshold = CheckThreshold($mylastrans['date_retrieved']);
				$Timelimit = 10;
				$AgentStatus = array("VOID", "DONE", "PENDING");
				
				//if(($mylastrans['stat'] <> "BOT ANSWER")&&($TimeThreshold > $Timelimit)){
				//if(($mylastrans['stat'] == "VOID")||($mylastrans['stat'] == "DONE")||($mylastrans['stat'] == "PENDING")&&($TimeThreshold > $Timelimit)){
				if(in_array($mylastrans['stat'], $AgentStatus)&&($TimeThreshold > $Timelimit)){
				//if($TimeThreshold > $Timelimit){
					$forbotmessages = "INACTIVE";
				}
				
				$answerkey = GetBotResponse($forbotmessages);
				$agenttransfer = AgentTransfer($forbotmessages);
				
				//Daya
				if(($forbotmessages == "BAL INQUIRY")&&($x_sender_id <> 1483362198411860)){
					$answerkey = "Your Facebook Account is not yet Registered";
				}
				if(($forbotmessages == "LAST PAYMENT")&&($x_sender_id <> 1483362198411860)){	
					$answerkey = "Your Facebook Account is not yet Registered";
				}

				//GetLastTransaction($fbid)
				//$mylastrans = GetLastTransaction($x_sender_id);
				
				//check if sticker is present
				if(isset($parsevar['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['sticker_id'])){
					$x_sticker_id = $parsevar['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['sticker_id'];				
				}else{
					$x_sticker_id = "00000";
				}
				
				//check if attachment is present
				if(isset($parsevar['entry'][0]['messaging'][0]['message']['attachments'][0]['type'])){
					$isattachpresent = 1;
					$x_type = $parsevar['entry'][0]['messaging'][0]['message']['attachments'][0]['type'];				
					$x_url = $parsevar['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['url'];
				}else{
					$isattachpresent = 0;
					$x_type = "";
					$x_url = "";
				}
				
				if(isset($parsevar['entry'][0]['messaging'][0]['message']['text'])){
					$x_text = str_replace("'", "", $parsevar['entry'][0]['messaging'][0]['message']['text']);
				}else{
					$x_text = "no message included";
				}
				
				$chk = "select message_id from fb_private_message where message_id='". $x_mid ."' and fb_page_id ='".$x_page_id ."'";
				
				if ($x_page_id == $x_sender_id){
						
					$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='MY COMMENT', sticker_id='".$x_sticker_id."'";
					
				}else{
						
					//insert auto response here					
					if($x_text == "no message included"){
						$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
					}else{
						
						$header = array(
								"Content-Type: application/json"
							);
							$message = array(
								"recipient" => array(
									"id" => $x_sender_id
								),
								"message" => array(
									"text" => $answerkey
								)
							);
							
							$context = stream_context_create(array(
								"http" => array(
									"method" => "POST",
									"header" => implode("\r\n", $header),
									"content" => json_encode($message),
								),
							));

							if(($mylastrans['stat'] == 'BOT ANSWER')||($TimeThreshold > $Timelimit)||($forbotmessages == "CHAT TO SYSTEM")){
								$response = file_get_contents('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken, false, $context);
							}
									if($agenttransfer == 1){
										
										$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
										
									}else{

										//if($mylastrans['stat'] == "PENDING"){
										//if(($mylastrans['stat'] == "PENDING")&&($TimeThreshold < $Timelimit)){
										if(in_array($mylastrans['stat'], $AgentStatus)&&($TimeThreshold < $Timelimit)){
												if($forbotmessages == "CHAT TO SYSTEM"){
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='BOT ANSWER', sticker_id='".$x_sticker_id."'";			
												}else{
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
												}
												
										/*}elseif(($mylastrans['stat'] == "VOID")&&($TimeThreshold < $Timelimit)){
												if($forbotmessages == "CHAT TO SYSTEM"){
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='BOT ANSWER', sticker_id='".$x_sticker_id."'";			
												}else{
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
												}
										}elseif(($mylastrans['stat'] == "DONE")&&($TimeThreshold < $Timelimit)){
												if($forbotmessages == "CHAT TO SYSTEM"){
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='BOT ANSWER', sticker_id='".$x_sticker_id."'";			
												}else{
														$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
												}											
										*/
										}else{
											$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='BOT ANSWER', sticker_id='".$x_sticker_id."'";							
										}

										
									}

							
							
					}
					
					
					//$ins = "insert into fb_private_message set fbfrom_id='".$x_sender_id."', message='".str_replace("'", "", $x_text) ."', message_id='". $x_mid ."', created_time=from_unixtime('".$x_time."'), fbto_id='". $x_recipient_id ."', object_id='". $x_seq ."', fb_page_id='". $x_page_id ."', stat='PENDING', sticker_id='".$x_sticker_id."'";
				
				}
					$upd ="";
					//$upd = "update fb_logs_sky set seen=1 where rowid='".$row['rowid']."'"; 
					
					selectInsert($chk, $ins, $upd);
					

					if ($isattachpresent > 0){
						$chkattach = "select message_id from fb_private_message_attachment where message_id='". $x_mid ."' and fb_page_id ='".$x_page_id ."'";
						$insertattach = "insert into fb_private_message_attachment set message_id='". $x_mid ."', fbfrom_id='".$x_sender_id."', att_id = '". $x_type ."', att_name='attach_name', fb_page_id = '".$x_page_id."', att_url='".$x_url."'";
						
						prcAttahment($chkattach, $insertattach, $x_url, $x_sticker_id);
					}	
					
					if ($x_page_id == $x_sender_id){
						getProfile($x_page_id, "MESSAGING", $x_page_id);
					}else{
						getProfile($x_sender_id, "MESSAGING", $x_page_id);
					}
					
					
					
					
					echo "senders_id :" . $x_sender_id;
					echo "<br>\n";
					echo "text :" . $x_text;
					echo "<br>\n";
					echo "mid :" . $x_mid;
					echo "<br>\n";
					echo "time :" . $x_time;
					echo "<br>\n";
					echo "recipient_id :" . $x_recipient_id;
					echo "<br>\n";
					echo "seq :" . $x_seq;
					echo "<br>\n";
					echo "page_id :" . $x_page_id;
					echo "<br>\n";
					echo "keyword :" . $answerkey;
					echo "<br>\n";
					echo "transfer :" . $agenttransfer;
					echo "<br>\n";					
					echo "stat :" . $mylastrans['stat'];
					echo "<br>\n";					
					echo "last date:" . $mylastrans['date_retrieved'];
					echo "<br>\n";					
					echo "current date:" . date("Y-m-d H:i:s");
					echo "<br>\n";					
					echo "Threshold:" . $TimeThreshold;
					echo "<br>\n";
					
					
					
							
					
			
			}elseif(isset($parsevar['entry'][0]['changes'][0]['value']['item'])){

				//wall comment handling
				
					if($parsevar['entry'][0]['changes'][0]['value']['item'] == "comment"){
				
						$x_item =  $parsevar['entry'][0]['changes'][0]['value']['item'];
						$x_sender_name =  $parsevar['entry'][0]['changes'][0]['value']['sender_name'];
						$x_comment_id =  $parsevar['entry'][0]['changes'][0]['value']['comment_id'];
						$x_sender_id = $parsevar['entry'][0]['changes'][0]['value']['sender_id'];
						$x_post_id =  $parsevar['entry'][0]['changes'][0]['value']['post_id'];
						$x_parent_id =  $parsevar['entry'][0]['changes'][0]['value']['parent_id'];
						$x_created_time =  $parsevar['entry'][0]['changes'][0]['value']['created_time'];
						
						if(isset($parsevar['entry'][0]['changes'][0]['value']['message'])){
							$x_message = preg_replace("/\r\n|\r|\n/",'<br>', $parsevar['entry'][0]['changes'][0]['value']['message']);
						}else{
							$x_message = "{ stickies }";
						}

						$x_page_id = $parsevar['entry'][0]['id'];
						
						$chk = "select id from fb_mypost_comment where id='".$x_comment_id."' and fb_page_id='". $x_page_id ."'";
						
							if($x_page_id == $x_sender_id){
								
								//check if page wall reply
								
								$ins = "insert into fb_mypost_comment set id='".$x_comment_id."', post_id='".$x_post_id."', aid='".$x_sender_name."', fromid='".$x_sender_id."', post_fbid='".$x_post_id."', parent_id='".$x_parent_id."', time='".$x_created_time."', text='".$x_message."', fb_page_id='".$x_page_id."', status='MY COMMENT'";
				
							}else{
								
								//assumes subs reply
								
								$ins = "insert into fb_mypost_comment set id='".$x_comment_id."', post_id='".$x_post_id."', aid='".$x_sender_name."', fromid='".$x_sender_id."', post_fbid='".$x_post_id."', parent_id='".$x_parent_id."', time='".$x_created_time."', text='".$x_message."', fb_page_id='".$x_page_id."', status='PENDING', fb_page_name='Slashdotph'";

							}
						
							$upd = ""; 
						
							selectInsert($chk, $ins, $upd);
							
							getProfile($x_sender_id, "COMMENT", $x_page_id);
							
							echo "item :" . $x_item;
							echo "<br>";
							echo "sender_name :" . $x_sender_name;
							echo "<br>";
							echo "comment_id :" . $x_comment_id;
							echo "<br>";
							echo "sender_id :" . $x_sender_id;
							echo "<br>";
							echo "post_id :" . $x_post_id;
							echo "<br>";
							echo "parent_id :" . $x_parent_id;
							echo "<br>";
							echo "created_time :" . $x_created_time;
							echo "<br>";
							echo "message :" . $x_message;
							echo "<br>";
							echo "page_id :" . $x_page_id;
							
					
					}else{

						//subs hit like to a comment
				
					$x_item = $parsevar['entry'][0]['changes'][0]['value']['item'];
					$x_sender_name = $parsevar['entry'][0]['changes'][0]['value']['sender_name'];
					$x_post_id =  $parsevar['entry'][0]['changes'][0]['value']['post_id'];
					$x_sender_id =  $parsevar['entry'][0]['changes'][0]['value']['sender_id'];
					$x_created_time = $parsevar['entry'][0]['changes'][0]['value']['created_time'];
					$x_page_id = $parsevar['entry'][0]['id'];
						
					$ins = "insert into fb_reactions set reaction_type='". $x_item ."', sender_name='". $x_sender_name ."', sender_id='". $x_sender_id ."', post_id='". $x_post_id ."', created_time='". $x_created_time ."',page_id='". $x_page_id ."'";
				
					$upd = ""; 
					
					getProfile($x_sender_id, "COMMENT", $x_page_id);
					selectInsert("", $ins, $upd);
					
					echo "item :" . $parsevar['entry'][0]['changes'][0]['value']['item'];
					echo "<br>";
					echo "sender_name :" . $parsevar['entry'][0]['changes'][0]['value']['sender_name'];
					echo "<br>";
					echo "comment_id :" . $parsevar['entry'][0]['changes'][0]['value']['post_id'];
					echo "<br>";
					echo "sender_id :" . $parsevar['entry'][0]['changes'][0]['value']['sender_id'];
					echo "<br>";
					echo "page_id :" . $parsevar['entry'][0]['id'];
					
					//var_dump($parsevar);
					
				}	
			
			}else{
			
					unParse($uncleanmsg);
					//var_dump($parsevar);
					
			}
			
		}
		
		
/* -------- 0000000 
	}

} else {
    echo "0 results";
}
$conn->close();
------- 00000000 */

$file = 'log.txt';
$current = file_get_contents($file);
file_put_contents($file, $uncleanmsg.PHP_EOL , FILE_APPEND | LOCK_EX);

?>

<script>
	FB.ui({
	  method: 'send',
	  link: 'http://www.nytimes.com/interactive/2015/04/15/travel/europe-favorite-streets.html',
	  to: '1499967966787857',
	});
</script>