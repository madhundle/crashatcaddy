<?php
	$error = "";
	$success = "";

	if ($_POST) {
		// Do I need these as well as the JavaScript at the bottom?
		if (!$_POST["name"]) { $error .= "<p>*The Name field is required.</p>"; }
		if (!$_POST["email"]) { $error .= "<p>*The Email field is required.</p>"; }
		if (!$_POST["subject"]) { $error .= "<p>*The Subject field is required.</p>"; }
		if (!$_POST["message"]) { $error .= "<p>*The Message field is required.</p>"; }
		
		if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
			$error .= "<p>*The email address is not valid.</p>"; // email is not a valid address
		}
		
		if ($error != "") {
			$error = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
		} else {
			$emailTo = "madeline.hundley@gmail.com";
			$subject = $_POST["subject"];
			$content = $_POST["message"];
			$headers = "From: ".$_POST["email"];
			
			if ( mail($emailTo, $subject, $content, $headers) ) {
				$success = '<div class="alert alert-success" role="alert">Your message has been successfully sent. Thank you.</div>';
			} else {
				$error = '<div class="alert alert-success" role="alert">Your message failed to send. Please try again later.</div>';
			}
		}
	}
?>

<!doctype html>
<html lang="en">
<head>
	<title>Caddyshack Crash Pad</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pinyon+Script">
	<link rel="stylesheet" type="text/css" href="cscp.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</head>
<body>
	
	<nav class="navbar navbar-expand-sm navbar-custom fixed-top">

		<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		  <span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="collapsibleNavbar">

			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="about_us.html">About Us</a></li>
				<li class="nav-item"><a class="nav-link" href="calendar.html">Calendar</a></li>
				<li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
				<li class="nav-item"><a class="nav-link active" href="contact.php">Contact Us</a></li>
			</ul>
			</ul>
		</div>
	</nav>

	<div class="d-sm-flex flex-row align-items-center text-center">
		<div class="col-sm">
			<div class="title">Caddyshack Crash Pad</div>
			<div class="subtitle">Subtitle</div>
		</div>
		<div class="col-sm pt-3">
			<table class="table m-0" id="contact">
				<tr class="row"><th scope="row" class="col-sm-4 italic">Email:</th><td class="col-sm">yadayada@yahoo.com</td></tr>
				<tr class="row"><th scope="row" class="col-sm-4 italic">Telephone:</th><td class="col-sm">(XXX) XXX-XXXX</td></tr>
			</table>
		</div>
	</div>
	<hr>
	
	<div class="container-fluid">
		<form id="contactForm" method="post">
			<div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control italic" id="name" name="name" placeholder="Your name here">
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control italic" id="email" name="email" placeholder="email@address.com">
				</div>
			</div>
			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Subject</label>
				<div class="col-sm-10">
					<input type="text" class="form-control italic" id="subject" name="subject" placeholder="Hello, Caddyshack">
				</div>
			</div>
			<div class="form-group row">
				<label for="message" class="col-sm-2 col-form-label">Message</label>
				<div class="col-sm-10">
					<textarea class="form-control italic" id="message" name="message" placeholder="Your message here..."></textarea>
				</div>
			</div>
			<div class="row">
				<button type="submit" id="contactButton" class="btn-lg mx-auto">Contact Us</button>
			</div>
		</form>
		<div id="error"><? echo $error.$success; ?></div>
	</div>

	<div class="copyrightFooter">Copyright &copy; 2019 Caddyshack CP, LLC</div>
	
	<script type="text/javascript">
		$("#contactForm").submit(function(e) {
			var error = ""; // for building our error message
			
			if ($("#name").val() == "") { error += "<p>*The Name field is required.</p>"; }
			if ($("#email").val() == "") { error += "<p>*The Email field is required.</p>"; }
			if ($("#subject").val() == "") { error += "<p>*The Subject field is required.</p>"; }
			if ($("#message").val() == "") { error += "<p>*The Message field is required.</p>";	}
			
			if (error != "") { // if there are errors, issue alert
				$("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>'); 
				return false; // does not submit
			} else {
				return true; // does submit
			}
		});
	</script>
	
</body>
</html>