<?php
// MySQL Database Info
$username = "";
$password = "";
$database = "";

// Slack Token
$token = "";
// Slack Announcements Channel ID
$announcements_channel = "";

// Admin Panel Settings
	// Username
	$admin_usernames = array(
		"username" => "Full Name"
	);
	// Hashed md5 password (yes, I know it's insecure, but it doesn't really matter)
	$admin_password = "";

// Cloudflare settings
$cf_zone_id = '';
$cf_email = '';
$cf_authkey = '';
$cf_ip = '';

// Mail Settings
require 'phpmailer/PHPMailerAutoload.php';
$mail = new \PHPMailer;

$mail->isSMTP();
$mail->Host = '';
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = '';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
