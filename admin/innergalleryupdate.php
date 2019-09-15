<?php
include_once 'adminnav.php';
include_once 'dbconnect.php';
?>


<!DOCTYPE html>
<html lang="en">

<body >
	<a id="submit" href="updategallery.php" type="Submit"  class="btn btn-primary col-md-offset-1 ">Back</a><br><br>
	<h3 align="center">Carousel Images</h3><br>
	
    <div class="container">
		<div class="container">
			<div class="masthead"><br/>
				<div class="row" align="center">
					<div class="col-md-4">
						<a href="slideradd.php" class="btn btn-default" role="button">Add</a>
					</div>
					<div class="col-md-4">
						<a href="sliderdel.php"class="btn btn-default" role="button">Delete</a>
					</div>
					<div class="col-md-4">
						<a href="sliderlist.php"class="btn btn-default" role="button">List</a>
					</div>
				</div>
				
			</div>
		</div> <!-- /menu -->
    </div>
  </body>
</html>