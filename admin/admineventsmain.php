<?php
include_once 'adminnav.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Events Admin Side</title>

		<!--Offline connection-->
		<link rel="stylesheet" href=".. /bootstrap-3.3.7-dist\css\bootstrap.min.css">
		<link rel="javascript"src=".. /bootstrap-3.3.7-dist\js\jquery.js">
		<link rel="javascript" src=".. /bootstrap-3.3.7-dist\js\jquery.min.js">

	
		<!--Online connection-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>


	<body>
		<div class="container">
			
			<div class="masthead"><br/>
				<h3 class="text-muted" align="center">Events</h3><br/>

				<div class="row" align="center">
					<div class="col-md-3">
						<a href="addevent.php" class="btn btn-default" role="button">Add</a>
					</div>
					<div class="col-md-3">
						<a href="updateevent.php" class="btn btn-default" role="button">Update</a>
					</div>
					<div class="col-md-3">
						<a href="deleteevents.php" class="btn btn-default" role="button">Delete</a>
					</div>
					<div class="col-md-3">
						<a href="listevents.php" class="btn btn-default" role="button">List</a>
					</div>
				</div>
				
			</div>
		</div> <!-- /menu -->
  </body>
</html>