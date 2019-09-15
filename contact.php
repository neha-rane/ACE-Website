<?php
if (isset($_POST['comment']) && isset($_POST['f_name']) && isset($_POST['f_email'])) {
	include_once("admin/dbconnect.php");
    $feed = mysqli_real_escape_string($conn, $_POST['comment']);
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $fmail = mysqli_real_escape_string($conn, $_POST['f_email']);
    //$message = mysqli_real_escape_string($_POST['message']);
    //$message = "";

	
    if($conn->query("INSERT INTO feeds( email_id, from_name, message) VALUES ('$fmail', '$fname', '$feed');"))
	{
		echo "<script type='text/javascript'>alert('Thanks for your feedback!');</script>";
	}
    
}
else{
	//echo "<script type='text/javascript'>alert('Something went wrong, feedback not submitted!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ACE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1">

	<!--Offline connection-->
	<link rel="stylesheet" href="bootstrap-3.3.7-dist\css\bootstrap.min.css">
	<link rel="javascript"src="bootstrap-3.3.7-dist\js\jquery.js">
	<link rel="javascript" src="bootstrap-3.3.7-dist\js\jquery.min.js">


	<link href="css/master.css" rel="stylesheet" />

	
	<!--Online connection-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		
		#main
		{
			background-color: white;
		}
		
	</style>
	
	<script type='text/javascript'>
    		function validate_feedback() 
    		{
        		fname = document.getElementById("f_name").value;
				fmail = document.getElementById("f_email").value;
					if (fname == "" || fmail == "") 
					{
						alert("Please fill in all details!");
						return false;
					}
					emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					if (!fmail.match(emailRegex)) 
					{
            			alert("Please enter a valid email!");
						return false;
					}
					else
					{
						document.getElementById("feedForm").submit()
					}
    		}
    	</script>
</head>
<body>
	<!-- Outer Fluid container-->
	<div class="container-fluid" style="background-color:#1c1919;"> 
		<!-- Main Container -->
		<div  class="fluid-container" id="main">
			<!-- Header Starts -->
			<header>
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-2 col-sm-2 col-xs-3">
								<a class="navbar-brand pull-left">
									<img src="images/ACE_logo_transparent.png" height="400%" width="120%" alt="ace" />
								</a>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-9">
								<br>
								<p>Bharatiya Vidya Bhavans</p>
								<h2>Sardar Patel Institute of Technology</h2>
								<p>Autonomous Institute Affiliated to Mumbai University</p>
							</div>
							<div class="col-md-3 col-sm-3 col-sm-3 hidden-xs">
								<a class="navbar-brand pull-right" >
									<img src="images/SPIT.jpg"  height="100px" width="100px" alt="spit" />
								</a>
							</div>
						</div>
					</div>
				</div><br>

				<div class="navbar navbar-default navbar-static-top" id="navbar">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse ">
							<ul class="nav navbar-nav">
								<ul class="nav navbar-nav">
									<li><a href="index.html">Home</a></li>
									<li><a href="home.html">About</a></li>
									<li><a href="members.html">Members</a></li>
									<li><a href="eventsall.php">Events</a></li>
									<li><a href="gallery.php">Gallery</a></li>
									<li><a href="contact.php">Contact</a></li>
									<li><a href="login.php">Login</a></li>
								</ul>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<!-- Header Ends -->
			
			<!-- Contact US -->
			<div class="container">			
				<div class="row"> 
					<div class="col-md-6">
						<form class="form-horizontal" action="#" method="post" id="feedForm">
							<p><b> Please help us to serve you better by taking a couple of minutes.</b></p><br>
							<p class="msg"><b> If you have specific feedback, please write to us... </b></p>
						
							<div class="form-group">
								<label for="uname" class="col-md-2 control-label">Name: </label>
								<div class="col-md-8">
									<input type="text" name="f_name" class="form-control" placeholder="eg. Jane Doe" required/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="col-md-2 control-label">Email ID: </label>
								<div class="col-md-8">
									<input type="email" name="f_email" class="form-control" placeholder="janedoe@something.com" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="message" class="col-md-2 control-label">Message: </label>
								<div class="col-md-8">
									<textarea class="form-control" rows="8" name="comment" required ></textarea>
								</div>								
							</div>
							<br>
							<button class="col-md-2 col-md-offset-2" type="submit" class="btn btn-primary" onclick="validate_feedback()">Send</button><br>
							
						</form>
					
					</div>
					<div class="col-md-6">
						<address>
								<strong>Sardar Patel Institue of Technology</strong><br>
								Bhavans Campus, Munshi Nagar,<br> Andheri West, Mumbai, Maharashtra 400058<br>
								Phone: (123) 456-7890<br>
								Mail us at: <a href="mailto:#">first.last@spit.ac.in</a>
						</address>
						<iframe src ="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.646049226283!2d72.83392671451583!3d19.12317758706089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c9d90e067ba9%3A0x16268e5d6bca2e6a!2sBharatiya+Vidya+Bhavan's+Sardar+Patel+Institute+of+Technology!5e0!3m2!1sen!2sin!4v1516978145209"
						    width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>			
			</div>
			
			<!-- End of Contact US -->
			
		</div>	<!-- Main Container End -->
	</div> <!-- Outer Container End -->
</body>
</html>