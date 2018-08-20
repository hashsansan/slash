<?php
	$access_token = "EAAavTO5gC2wBALXazCNmQ4rbujvXKkCUH1E8k5a7jp0VhteGhn9cQ7nDwXyIbqmvgvekoRX8EZBoCmI1edvFnwLidUWaCTnJXF55p0xlqARgAto8je75NEL03FmHIBZBiPOPQzFNHBIHNdLWqO8ZCpSWZBnWWDxzVUEO8ddQBAZDZD";
	$challenge = $_REQUEST['hub_challenge'];
	$verify_token = $_REQUEST['hub_verify_token'];

	if ($verify_token === 'slashytesttoken') {
	  echo $challenge;
	}

	$input = json_decode(file_get_contents('php://input'), true);

	$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
	$message = $input['entry'][0]['messaging'][0]['message']['text'];

	$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;

	$ch = curl_init($url);

	if($message=="hi")
	{
			$jsonData = '{
				"recipient":{
						"id":"'.$sender.'"
				},
				"message":{
						"text":"hello!"
				}
			}';
	}

	$jsonDataEncoded = $jsonData;

	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	$result = curl_exec($ch);
?>