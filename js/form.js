$("#submit-button").click(function() {
	$('#form-action').modal('open');
	if ($("#first_name").val() == "" || $("#last_name").val() == "" || $("#email").val() == "" || $("#year").val() == null) {
		$('#form-action-header').html("Error");
		$('#form-action-content').html("You have not completed all required fields!");
	} else {
		$('#form-action-header').html("Loading...");
		$('#form-action-content').html("");
		$.post("form.php", {"first_name": $("#first_name").val(), "last_name": $("#last_name").val(), "email": $("#email").val(), "year": $("#year").val()}, function(e) {
			if (e == "success") {
				$("#form-action-dismiss").attr("href", ".");
				$('#form-action-header').html("Success!");
				$('#form-action-content').html("You have successfully registered for the LAHS Hack Club mailing list, and an invite to our Slack has been emailed to your account. Please join our Slack, and enjoy your stay!");
			} else if (e == "email_exists") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("That email already exists. You are already on our mailing list, and you can try logging into our Slack at <a href='https://lahshackclub.slack.com'>https://lahshackclub.slack.com</a>.");
			} else if (e == "invalid_email") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("That email is not a valid school email. Please do not use your personal email, instead use your school-issued email. If you do not have one, please contact us at <a href='mailto:hack@lahs.club'>hack@lahs.club</a>.");
			} else if (e == "first_name_too_long") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("Your first name is too long!");
			} else if (e == "last_name_too_long") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("Your last name is too long!");
			} else if (e == "invalid_characters") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("Invalid characters! Your name can only contain letters from the alphabet.");
			} else if (e == "cloudflare_error") {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("There was an error with CloudFlare! Please email hack@lahs.club immediately with a screenshot of this. Thank you!");
			} else {
				$('#form-action-header').html("Error");
				$('#form-action-content').html("An unknown error occurred, please contact our system administrators at <a href='mailto:hack@lahs.club'>hack@lahs.club</a> immediately!");
			}
		});
	}
});