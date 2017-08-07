<?php
session_start();
require_once("conf.ini.php");

if (isset($_SESSION['logged_in']) && isset($_POST['subject'])) {
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$connection = mysqli_connect("127.0.0.1", $username, $password, $database);
	$query = mysqli_query($connection, "SELECT * FROM `users`;");
	
	$mail->setFrom('hack@lahs.club', 'LAHS Hack Club');
	$mail->addAddress('hack@lahs.club', 'LAHS Hack Club');
	
	while ($row = mysqli_fetch_array($query)) {
		$mail->addBCC($row['email']);
	}

	$mail->addBCC('hack@lahs.club');
	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = "<head><link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'></head><body style='font-family: \"Roboto\", sans-serif;'><div style='width: 90%; height: 100%; padding: 5% 5%;'><div style='width: calc(100% - 20px); padding: 10px; background-color: #1565c0; color: white; text-align: center; font-size: 2em; margin: 0'>$subject</div><div style='background-color: #efefef; padding: 10px;'>$message</div></div></body>";

	$mail->send();

	$slack_message = str_replace("</p><p>", "\n\n", $message);
	$slack_message = str_replace("<p>", "", $slack_message);
	$slack_message = str_replace("</p>", "", $slack_message);
	$slack_message = str_replace("<b>", "*", $slack_message);
	$slack_message = str_replace("</b>", "*", $slack_message);
	$slack_message = str_replace("<em>", "_", $slack_message);
	$slack_message = str_replace("</em>", "_", $slack_message);
	$slack_message = preg_replace('/<[^>]*>/', "\n\n", $slack_message);

	$url = 'https://slack.com/api/chat.postMessage';
	$data = array(
		'token' => $token,
		'channel' => $announcements_channel,
		'as_user' => 'true',
		'parse' => 'full',
		'mrkdwn' => 'true',
		'attachments' => '[{
            "fallback": "' . $subject . '",
            "color": "#1565c0",
            "pretext": "@everyone New announcement by the LAHS Hack Club staff: *' . $subject . '*",
            "mrkdwn_in": ["pretext", "text"],
            "text": "' . $slack_message . '",
            "unfurl_links": "false",
            "unfurl_media": "false",
            "footer": "LAHS Hack Club Slack Bot"
        }]'
	);

	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	echo "success";
}