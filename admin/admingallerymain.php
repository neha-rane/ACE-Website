<?php
include_once 'adminnav.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gallery Admin Side</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	</head>


	<body>
		<div class="container">
			<div class="masthead"><br/>
				<h3 class="text-muted" align="center">Gallery</h3><br/>

				<div class="row" align="center">
					<div class="col-md-3">
						<a href="addgallery.php" class="btn btn-default" role="button">Add</a>
					</div>
					<div class="col-md-3">
						<a href="updategallery.php" class="btn btn-default" role="button">Update</a>
					</div>
					<div class="col-md-3">
						<a href="deletegallery.php"class="btn btn-default" role="button">Delete</a>
					</div>
					<div class="col-md-3">
						<a href="listgallery.php"class="btn btn-default" role="button">List</a>
					</div>
				</div>
				
			</div>
		</div> <!-- /menu -->
  </body>
</html>