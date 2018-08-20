<?php
// parameters
error_reporting(1);
$hubVerifyToken = 'slashytesttoken';

//$accessToken ="EAADmoMigd3oBAFTEGbCxcNrIbZCIosbL5ceNIapijfVnl7gNXWOK1qu65eeG5qNZAM73wH1qY8MNWGLYkZC4kRiMyeAVqHlv2mfZAMiEUpMTiT3t3MKmRx6ylseSgXII8872NPwgnH9dJNLprOqHhHkvtZBzHceDHKFOneynp4gZDZD";
$accessToken ="EAADmoMigd3oBAOvWVBBkVT8TGxto2GtwpTTHDrlzIywQ79LT7ZCpchX4XuMOogR6FiKjmBjRLGSgxxAUS3Piafqr1CT7Hfr6LfN1f8t5ZAKF3Qd5lQplJc1dSKl4rTvL7gvx22P7iSRiBBHuLZCZAyxHxhVrwnLBeBoUbfa6tQZDZD";

//$accessToken = "EAADmoMigd3oBAPT1VgAjlpNvDCLXZAh0R2f8O55rlsffVX1JPIIklV2T5ZAXtr4hLOEka40TwPkfUcHj8Udd0pdzeSlXjqylQaqHRVXtJOEaXFgvMJ2HfMDOKCjp1mSHF5xBVZCBgpFiKK9USBhB9oXjOKyGb6EaWsnuNxxqgZDZD";

// check token at setup
if ($_GET['hub_verify_token'] == $hubVerifyToken) {
  echo $_GET['hub_challenge'];
  exit;
}
// handle bot's anwser

$inp = file_get_contents('php://input');

$nn = json_decode($inp,TRUE);


/*

admin@123
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die("Err: Failed to Connect to DB");
}else{
if(!empty($nn['entry'][0]['changes'])) {	
$sql = "INSERT INTO unified.fb_logs_phub set msg='". trim($inp) ."', 
photo_id = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['photo_id'])."',
item = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['item'])."',
sender_name = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['sender_name'])."',
sender_id = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['sender_id'])."',
post_id = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['post_id'])."',
verb = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['verb'])."',
link = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['link'])."',
published = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['published'])."',
created_time = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['created_time'])."',
message = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['message'])."'
";
} else {
$sql = "INSERT INTO unified.fb_logs_phub set msg='". trim($inp) ."', 
photo_id = '',
item = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['item'])."',
sender_name = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['sender_name'])."',
sender_id = '".$conn->real_escape_string($nn['entry'][0]['messaging'][0]['sender']['id'])."',
post_id = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['post_id'])."',
verb = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['verb'])."',
link = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['link'])."',
published = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['published'])."',
created_time = '".$conn->real_escape_string($nn['entry'][0]['changes'][0]['value']['created_time'])."',
message = '".$conn->real_escape_string($nn['entry'][0]['messaging'][0]['message']['text'])."'
";
}
if (mysqli_query($conn, $sql)) {
	//echo "inserted";
	} else {
	//echo "error ";
	}
	mysqli_close($conn);
}
		
*/
if(!empty($nn['entry'][0]['messaging'][0]['message']['text'])) {	
	$senderId = $nn['entry'][0]['messaging'][0]['sender']['id'];
	$messageText = strtoupper ($nn['entry'][0]['messaging'][0]['message']['text']);


	switch($messageText) {
		
		/*case "HELLO":
			$answer = "Hi! How may I help you!";
		break;*/
		
		case "PROMOS":
			$answer = "Here are the list of Promo:
					   Promo1: Voice Service
					   Promo2: Non Voice Service
					   Promo3: Voice and Non Service";
			$table = "msg_keyword";
			$key = "PROMO";
		break;
		
		case "BAL INQUIRY":
			$answer = "As of today available your balance is 1,500 Pesos";
			$table = "fbaccount";
			$key = "balance";
			$id = $senderId;
		break;
		
		case "HELP":
			$answer = "HERE ARE THE FOLLOWING KEYWORDS:
					   PROMOS - to inquire about promos
					   BAL INQUIRY - to know your current balance
					   LAST PAYMENT - to know your last payment transaction";
			$table = "msg_keyword";
			$key = "HELP";
		break;		
		
		case "LAST PAYMENT":
			$answer = "Your last payment is 5th of November 2017";
			$table = "fbaccount";
			$key = "lastpayment";
			$id = $senderId;
		break;
		
		default:
			$answer = "Hi! the message you have sent is not recognize! Type HELP to see Keywords";
			$table = "none";
		break;
	}
	
		$servername = "localhost";
		$username = "root";
		$password = "admin@123";
		$database = "slashsns";
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			//$conx = "0";
			die("Err: Failed to Connect to DB");
		}else{
			
			//$conx = "1";
			
			if($table == "msg_keyword"){

								$sql = "SELECT reply FROM ".$table." WHERE keyword = '".$key."'";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {

									while($row = $result->fetch_assoc()) {
										$answerkey = $row["reply"];
									}
								} else {
									#echo "0 results";
								}						
						
						} elseif ($table == "fbaccount") {
						
						
								$sql = "SELECT * FROM ".$table." WHERE fbid = '".$id."'";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {

									while($row = $result->fetch_assoc()) {

									if($key == "balance"){
										$answerkey = "Hi! ".$row['title']." ".$row['fullname']." your current balance on Account No: ".$row['acctno']." is : ".$row['currentbal'];
									}else{
										$answerkey = "Hi! ".$row['title']." ".$row['fullname']." your last payment transaction on Account No: ".$row['acctno']." was made on ".$row['lastpayment'];
									}
										#$answerkey = $row["reply"];
									
									}
								} else {
									#echo "0 results";
									$answerkey = "Sorry! your account is not Registered!";
								}						
						
						
						} else {
						
							$answerkey = $answer;
						}
	
		}	
	
	$header = array(
        "Content-Type: application/json"
    );
	$message = array(
		"recipient" => array(
			"id" => $senderId
		),
		"message" => array(
			#"text" => $answer
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

    $response = file_get_contents('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken, false, $context);

	
}
?>