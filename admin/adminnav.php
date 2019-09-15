<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin</title>

		<!--Offline connection-->
		<link rel="stylesheet" href=".. /bootstrap-3.3.7-dist\css\bootstrap.min.css">
		<link rel="javascript"src=".. /bootstrap-3.3.7-dist\js\jquery.js">
		<link rel="javascript" src=".. /bootstrap-3.3.7-dist\js\jquery.min.js">

	
		<!--Online connection-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<link href="css/mainadmin.css" rel="stylesheet" />
	
	</head>

	
	<body>
		<div class="fluid-container">
			
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
								<li><a href="adminhome.php">Home</a></li>
								<li><a href="listevents.php">Events</a></li>
								<li><a href="listgallery.php">Gallery</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</ul>
					</div>
				</div>
			</div>
		</div> <!-- /menu -->
	</body>
</html>