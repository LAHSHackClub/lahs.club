$("#login-button").click(function() { submitForm(); });
$("#password").keypress(function(e) { if (e.which == 13) submitForm(); });

function submitForm() {
	$("#login-form-modal").modal('open');
	if ($("#username").val() == "" || $("#password").val() == "") {
		$("#login-form-header").html("Error");
		$("#login-form-content").html("You have not completed all required fields!");
	} else {
		$("#login-form-header").html("Loading...");
		$("#login-form-content").html("");
		$.post("login.php", {"username": $("#username").val(), "password": $("#password").val()}, function(e) {
			if (e == "success") {
				$("#login-form-header").html("Success!");
				$("#login-form-content").html("Successfully logged in. Redirecting you to panel...");
				setTimeout(function() {
					window.location.replace("panel.php");
				}, 1000);
			} else if (e == "failure") {
				$("#login-form-header").html("Error");
				$("#login-form-content").html("Incorrect username or password.");
			} else {
				$("#login-form-header").html("Error");
				$("#login-form-content").html("An unknown error occurred, please contact our system administrators at <a href='mailto:hack@lahs.club'>hack@lahs.club</a> immediately!");
			}
		});
	}
}