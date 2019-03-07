# LAHS Hack Club Main Site
Greetings! The LAHS Hack Club is a prominent computer and programming club at [Los Altos High School](http://mvla.net/LAHS), and our site can be found at [lahs.club](https://lahs.cub). This repository contains the source code for this website, which includes:
* Custom material blue theme (for our school colors).
* Custom join page which links to our backend user system.
* Ability to send updates to all users in our system via email and automatically hook into our Slack channel for announcements.
* Custom admin control panel with multiple users and login page.
* Integration with our club server, which automatically adds user accounts to it and emails them the password in their registration email (requires root access).

This requires a PHP webserver to be running on an account with `sudo` privelages, most likely root. Its backend is coded in PHP and hooks into MySQL, and the frontend is coded in HTML, CSS, and JavaScript, with a large thanks to [MaterializeCSS](http://materializecss.com) for the design. Everything can be configured in `conf.ini.php`!

## Database structure:
```sql
CREATE TABLE `users` (
	`first_name` VARCHAR(255),
	`last_name` VARCHAR(255),
	`email` VARCHAR(255),
	`year` INT(4)
);
```

## conf.ini.php
Please create the file `conf.ini.php` and set up your config with the following values:
```php
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
```