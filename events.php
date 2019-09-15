<!DOCTYPE html>
<html>
<head>
	<title>Events</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1">

	<!--Offline connection-->
	<link rel="stylesheet" href="bootstrap-3.3.7-dist\css\bootstrap.min.css">
	<link rel="javascript"src="bootstrap-3.3.7-dist\js\jquery.js>
	<link rel="javascript" src="bootstrap-3.3.7-dist\js\jquery.min.js">


	<link href="css/master.css" rel="stylesheet" />

	
	<!--Online connection-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
									<img src="images/SPIT.jpg" height="100px" width="100px" alt="spit" />
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
								<li><a href="index.html">Home</a></li>
								<li><a href="home.html">About</a></li>
								<li><a href="members.html">Members</a></li>
								<li><a href="eventsall.php">Events</a></li>
								<li><a href="gallery.php">Gallery</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="login.php">Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<!-- Header Ends -->
			
			<!--Gallery Start-->
			
			<div class="container" align="center">
				<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
					<a href="eventsall.php" class="btn btn-default" type="Submit" name="all" >All</a>
              		<a href="EventsPast.php" class= "btn btn-default" type="Submit" name="past" >Past Events</a>
					<a href="EventsOn.php" class="btn btn-default" type="Submit" name="ongoing" >Ongoing Events</a>
					<a href="Eventscoming.php" class="btn btn-default" type="Submit" name="coming" >Coming Soon</a>
					<br><br>
				</form>
				<div class="row">
					<div class="col-md-12">
						
					</div>
				</div>
			</div>
			<!--Gallery End-->
		</div>	<!-- Main Container End -->
	</div> <!-- Outer Container End -->
</body>
</html>