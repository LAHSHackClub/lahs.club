var candidate = null;

$(".delete").click(function() {
	candidate = event.target.id;
	$("#info-modal").modal('open');
	$("#continue-delete").css("display", "block");
	$("#info-modal-header").html("Are you sure?");
	$("#info-modal-content").html("If you hit continue, you will remove this user from the mailing list.");
});

$("#continue-delete").click(function() {
	$("#info-modal-header").html("Loading...");
	$("#info-modal-content").html("");
	$.post("delete.php", {"email": candidate}, function(e) {
		if (e == "success") {
			$("#info-modal-header").html("Success!");
			$("#info-modal-content").html("Successfully deleted user with email " + candidate + " from the database. Reloading...");
			setTimeout(function() {
				window.location.reload();
			}, 2500);
		} else {
			$("#info-modal-header").html("Error");
			$("#info-modal-content").html("An unknown error occurred, please contact our system administrators at <a href='mailto:hack@lahs.club'>hack@lahs.club</a> immediately!");
		}
	});
});

$("#send-mail").click(function() {
	$("#info-modal").modal('open');
	if ($("#subject").val() == "" || $("#message").val() == "") {
		$("#info-modal-header").html("Error");
		$("#info-modal-content").html("Please fill out all required fields!");
	} else {
		$("#info-modal-header").html("Loading...");
		$("#info-modal-content").html("");
		$.post("mail.php", {"subject": $("#subject").val(), "message": $("#message").val()}, function (e) {
			if (e == "success") {
				$("#subject").val("");
				$("#message").val("");
				$('#message').trigger('autoresize');
				$("#info-modal-header").html("Success!");
				$("#info-modal-content").html("Successfully sent out email to all users on the mailing list. A copy was sent to <b>hack@lahs.club</b> for reference!");
			} else {
				$("#info-modal-header").html("Error");
				$("#info-modal-content").html("An unknown error occurred, please contact our system administrators at <a href='mailto:hack@lahs.club'>hack@lahs.club</a> immediately!");
			}
		});
	}
});