<?php
session_start();
ignore_user_abort(true);

if (!isset($_SESSION['logged_in'])) {
	header("Location: .");
}

if (isset($_POST['uname'])) {
	$uname = $_POST['username'];
	$email = $_POST['email'];

	require_once("conf.ini.php");

	if (!ctype_alpha($uname)) {
		echo "invalid_characters";
		die();
	}

	if (strlen($uname) > 255) {
		echo "uname_too_long";
		die();
	}

	$password = generateRandomString(8);

	$mail->setFrom('hack@lahs.club', 'LAHS Hack Club');
	$mail->addAddress($email);
	$mail->addBCC('hack@lahs.club');
	$mail->isHTML(true);

	$mail->Subject = 'Your Custom Domain';
	$mail->Body = "<head><link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'></head><body style='font-family: \"Roboto\", sans-serif;'><div style='width: 90%; height: 100%; padding: 5% 5%;'><div style='width: calc(100% - 20px); padding: 10px; background-color: #1565c0; color: white; text-align: center; font-size: 2em; margin: 0'>Your Custom Domain</div><div style='background-color: #efefef; padding: 10px;'><p>Greetings!</p><p>Thank you for agreeing to create the website for <b>$uname</b>, we really appreciate your commitment towards the <b>get.lahs.club</b> program. Please login with ssh using the following credentials:<br><b>uname: </b>$uname<br><b>Password: </b>$password<br><b>Host: </b>server.lahs.club<br><b>Port: </b>22</p><p>Please ask on Slack or reply to this email if you are having any issues logging in.</p><p>Best Regards,<br>The LAHS Hack Club Team</p></div></div></body>";

	$mail->send();

	exec('yes "" | adduser ' . $uname . ' --disabled-login');
	exec('yes "' . $password . '" | passwd ' . $uname);
	exec('chown -hR ' . $uname . ' /home/' . $uname);
	exec('chage -d 0 ' . $uname);
	exec('chmod 700 /home/' . $uname);
	exec('mkdir /var/www/' . $uname);
	exec('chown ' . $uname . ':www-data /var/www/' . $uname);
	exec('ln -s /var/www/' . $uname . ' /home/' . $uname . '/www');
	exec('touch /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "  ServerName ' . $uname . '.lahs.club" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "  ServerAdmin hack@lahs.club" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "  DocumentRoot /var/www/' . $uname . '" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "  #ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "  #CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('echo "</VirtualHost>" >> /etc/apache2/sites-available/' . $uname . '.lahs.club.conf');
	exec('cp /root/index.php /var/www/' . $uname . '/');
	exec('chown ' . $uname . ':' . $uname . ' /var/www/' . $uname . '/index.php');
	exec('a2ensite ' . $uname . '.lahs.club');
	exec('service apache2 reload');

	$url = 'https://api.cloudflare.com/client/v4/zones/' . $cf_zone_id . '/dns_records';
	$fields = array('type' => 'A', 'name' => $uname, 'content' => $cf_ip, 'ttl' => 1, 'proxied' => true);
	$fields_string = json_encode($fields);

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    	"X-Auth-Email: $cf_email",
    	"X-Auth-Key: $cf_authkey",
    	"Content-type: application/json"
    ));

	$result = curl_exec($ch);
	curl_close($ch);

	echo "success";
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
