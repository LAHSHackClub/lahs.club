<?php
session_start();
require_once("conf.ini.php");

if (isset($_SESSION['logged_in']) && isset($_POST['email'])) {
	$connection = mysqli_connect("127.0.0.1", $username, $password, $database);
	mysqli_query($connection, "DELETE FROM `users` WHERE `email` = '" . $_POST['email'] . "';");
	echo "success";
}