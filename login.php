<?php
session_start();
require_once("conf.ini.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
	if (array_key_exists($_POST['username'], $admin_usernames) && md5($_POST['password']) == $admin_password) {
		$_SESSION['logged_in'] = $admin_usernames[$_POST['username']];
		echo "success";
	} else echo "failure";
}
?>