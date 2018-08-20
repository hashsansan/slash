<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include('core.php');
include("Functions/Send_API.php");

//$channelToken	= "EAADmoMigd3oBAABvqg9T9EvlkExRQNHfHt63zELt5ttJ11pQnb1URWPglK6yE2yVRlB60bHJbzsZBZB7wHHZCAO147VoNp113zKOVh7DuDV8XiLyH6d5t3PJZCVhtPF8159rKZCYzio5V8OpPUqAakA1mY6YdiS0ZD";

//$pageid = "537019949683349";
//$pageid = "1808417492743293"; 
$pageid = "228362557544701"; 
$channelToken = getpageToken($pageid);

global $servername;
global $username;
global $password;
global $dbname;
global $port;
 
$conn = new mysqli($servername, $username, $password, $dbname, $port);

	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	$fbqueue = "SELECT rowid, fbid, msge, msg_ref_id, fb_page_id, source, msg_type FROM fb_sent_test WHERE stat='queue' and execid = ".$_GET['execid'];
	//$fbqueue = "select rowid, screen_name, conversation_id, msge, stat, msg_type, msg_source, pageid from fb_sent where stat='queue'";
	$result = $conn->query($fbqueue);
	
	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {

			if($row["source"] == "MESSENGER"){
				
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
				
			}else{
				
				$rowid 		= $row['rowid'];
				$rcvr_id 	= $row['fbid'];
				$message 	= $row['msge'];
				$sender_id 	= $row['fb_page_id'];
				$type 	 	= $row['msg_type'];
				
				$postcomment = "https://graph.facebook.com/v2.8/".trim($rcvr_id)."/comments/?access_token=".$channelToken."&message=".trim(urlencode($message))."&method=POST";
				$result = file_get_contents($postcomment);
				
				
				//echo $postcomment;
				$update = "update fb_sent set stat='sent', sent_date=sysdate(), error_msg='".$result."' where rowid='".$rowid."'";
				echo $result;
				$conn->query($update);
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
