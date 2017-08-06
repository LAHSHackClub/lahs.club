<?php
session_start();
if (isset($_SESSION['logged_in'])) {
  header("Location: panel.php");
}
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
</head>
<body>
  <nav class="blue darken-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="." class="brand-logo">LAHS Hack Club</a>
      <ul class="right hide-on-med-and-down">
        <li><a href=".">Home</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href=".">Home</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <br />
  
  <div class="row">
    <div class="col s12 l4 z-depth-4 card-panel push-l4">
      <form class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            <h3 class="center">Please Log In!</h3>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="username" type="text" id="username">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock</i>
            <input id="password" type="password" id="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a class="btn waves-effect waves-light col s12 blue darken-3" id="login-button">Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div id="login-form-modal" class="modal">
    <div class="modal-content">
      <h4 id="login-form-header"></h4>
      <p id="login-form-content"></p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Dismiss</a>
    </div>
  </div>

  <?php require_once("templates/footer.php"); ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/admin.js"></script>

  </body>
</html>
