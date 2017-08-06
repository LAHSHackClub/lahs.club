<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Join LAHS Hack Club</title>

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
  <div class="section no-pad-bot" id="index-banner">
    <h2 class="center">Join Now!</h2>
    <h6 class="center"><a class="waves-effect waves-light btn blue lighten-1 modal-trigger" href="#not-a-student">Not a Student at LAHS?</a></h6>
    <div class="container">
	    <div class="row">
	    	<div class="input-field col s12 m6 l6">
		      <input id="first_name" type="text" class="validate">
		      <label for="first_name">First Name</label>
		    </div>
		    <div class="input-field col s6 l6">
		      <input id="last_name" type="text" class="validate">
		      <label for="last_name">Last Name</label>
		    </div>
	    </div>
	    <div class="row">
	    	<div class="input-field col s12 m6 l6">
				<select id="year">
				  <option value="" disabled selected>Select One</option>
				  <option value="2021">2021</option>
				  <option value="2020">2020</option>
				  <option value="2019">2019</option>
				  <option value="2018">2018</option>
				</select>
				<label>Year of Graduation</label>
		    </div>
		    <div class="input-field col s6 l6">
				<input id="email" type="email" class="validate">
				<label for="email" data-error="Invalid Email!" data-success="Valid Email">Email (School Email)</label>
		    </div>
			<h6 class="center"><a class="btn waves-effect waves-light green" id="submit-button">Submit</a></h6>
	    </div>
    </div>
  </div>

  <div id="not-a-student" class="modal">
    <div class="modal-content">
      <h4>Not a student at LAHS?</h4>
      <p>Not a problem! We'll definitely allow people that are not LAHS students to join our Slack and mailing list, but for security reasons we'll need to add you manually, so please shoot us a message at <a href="mailto:hack@lahs.club">hack@lahs.club</a>! Thanks.</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Dismiss</a>
    </div>
  </div>

  <div id="form-action" class="modal">
    <div class="modal-content">
      <h4 id="form-action-header"></h4>
      <p id="form-action-content"></p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat" id="form-action-dismiss">Dismiss</a>
    </div>
  </div>

  <?php require_once("templates/footer.php"); ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/form.js"></script>
  </body>
</html>
