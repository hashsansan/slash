<?php


function Send_message($channelToken,$rcvr_id,$sender_id,$textmsg,$type) {
	$header = array(
        "Content-Type: application/json"
    );
	
	if($type == "TEXT") {
		$message = array(
			"recipient" => array(
				"id" => $rcvr_id
			),
			"message" => array(
				"text" => $textmsg
			)
		);
	} elseif($type == "AUDIO") {
		$message = array(
			"recipient" => array(
				"id" => $rcvr_id
			),
			"message" => array(
				"attachment" => array(
					"type" => "audio",
					"payload" => array(
						"url" => $textmsg
					)
				)
			),
		);
	} elseif($type == "FILE") {
		$message = array(
			"recipient" => array(
				"id" => $rcvr_id
			),
			"message" => array(
				"attachment" => array(
					"type" => "file",
					"payload" => array(
						"url" => $textmsg
					)
				)
			),
		);
	} elseif($type == "IMAGE") {
		$message = array(
			"recipient" => array(
				"id" => $rcvr_id
			),
			"message" => array(
				"attachment" => array(
					"type" => "image",
					"payload" => array(
						"url" => $textmsg
					)
				)
			),
		);
	} elseif($type == "VIDEO") {
		$message = array(
			"recipient" => array(
				"id" => $rcvr_id
			),
			"message" => array(
				"attachment" => array(
					"type" => "video",
					"payload" => array(
						"url" => $textmsg
					)
				)
			),
		);
	}
	
    $context = stream_context_create(array(
        "http" => array(
			"method" => "POST",
			"header" => implode("\r\n", $header),
			"content" => json_encode($message),
        ),
    ));

	#print_r($message);
	
    $response = file_get_contents('https://graph.facebook.com/v2.6/me/messages?access_token='.$channelToken, false, $context);
    if (strpos($http_response_header[0], '200') === false) {
		return "Error Code: " . print_r($http_response_header);
    } else {
		return $response;
	}
}