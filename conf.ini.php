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
	// Usernames
	$admin_usernames = array(
		"username" => "Full Name",
		"username2" => "Full Name 2"
	);
	// Hashed md5 password (yes, I know it's insecure, but it doesn't really matter)
	$admin_password = "";

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