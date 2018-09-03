<?php
session_start();
require_once("conf.ini.php");
if (!isset($_SESSION['logged_in'])) {
	header("Location: .");
}
$user = $_SESSION['logged_in'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>LAHS Hack Club | Admin</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/panel.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
  <nav class="blue darken-3" role="navigation">
    <div class="nav-wrapper container">
    <ul class="right hide-on-med-and-down">
		<li><a href="logout.php">Log Out</a></li>
	</ul>

	<ul id="nav-mobile" class="side-nav">
		<li><a href="logout.php">Log Out</a></li>
	</ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
	<ul id="navigation-sidebar" class="side-nav fixed">
		<li>
			<div class="user-view">
				<a href="panel.php"><span class="name"><img src="img/lahshackclub.png" />&nbsp;&nbsp;&nbsp;&nbsp;Logged in as <?php echo $user; ?></span></a>
			</div>
		</li>
		<br>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="panel.php?list">Mailing List</a></li>
		<li><a class="waves-effect" href="panel.php?email">Send New Email</a></li>
		<li><a class="waves-effect" href="panel.php?custom">Custom Domain</a></li>
	</ul>

	<div class="row" style="padding: 10px 25px">
	<?php
	if (isset($_GET['list'])) {
		?>
		<table class="responsive-table">
	        <thead>
	          <tr>
	              <th>First Name</th>
	              <th>Last Name</th>
	              <th>Email</th>
	              <th>Year of Graduation</th>
	              <th>Delete</th>
	          </tr>
	        </thead>
	        <tbody>
	    <?php
		$connection = mysqli_connect("127.0.0.1", $username, $password, $database);
		$query = mysqli_query($connection, "SELECT * FROM `users`;");
		while ($row = mysqli_fetch_array($query)) {
			echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['year'] . "</td><td><a class='waves-effect waves-light btn red delete' id='" . $row['email']. "'>delete</a></td></tr>";
		}
		?>
			</tbody>
		</table>
		<?php
	} else if (isset($_GET['email'])) {
	?>
		<h5 class='center'>This will be sent to everyone on the mailing list.</h5>
		<div class="container">
			<div class="input-field">
	          <input id="subject" type="text" class="validate">
	          <label for="subject">Subject</label>
	        </div>
	        <div class="input-field">
	          <textarea id="message" class="materialize-textarea"></textarea>
	          <label for="message">Message</label>
	        </div>
			<div class="input-field">
				<a class="btn waves-effect waves-light col s12 blue darken-3" id="send-mail">Send</a>
			</div>
        </div>
        <?php
	} else if (isset($_GET['custom'])) {
	?>
	<div class="container">
	    <div class="row">
	    	<div class="input-field col s12 m6 l6">
		      <input id="custom_username" type="text" class="validate" maxlength="255">
		      <label for="custom_username">Username</label>
		    </div>
		    <div class="input-field col s6 l6">
				<input id="custom_email" type="email" class="validate">
				<label for="custom_email" data-error="Invalid Email!" data-success="Valid Email">Email</label>
		    </div>
			<h6 class="center"><a class="btn waves-effect waves-light col s12 blue darken-3" id="custom_submit">Submit</a></h6>
	    </div>
    </div>
	<?php
	} else {
		echo "<h4 class='center'>Choose an option on the left to get started.</h4>";
	}
	?>
	</div>

  <div id="info-modal" class="modal">
    <div class="modal-content">
      <h4 id="info-modal-header"></h4>
      <p id="info-modal-content"></p>
    </div>
    <div class="modal-footer">
      <a class="modal-action waves-effect waves-green btn-flat" id="continue-delete">Continue</a>
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Dismiss</a>
    </div>
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/panel.js"></script>
  </body>
</html>
