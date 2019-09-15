<?php
include_once 'admingallerymain.php';
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
	</head>


	<body>
		<div class="container">
			
			<div class="row">
				<div class="col-md-12" align="center">
					<h3>List of All Items in Gallery</h3><br><br>
					<table class="table table-hover"  align="center">
						<tr>
							<td align="center"><b>Photo</b></td>
							<td align="center"><b>Name</b></td>
							<td align="center"><b>Description</b></td>
							<td align="center"><b>Date</b></td>
						</tr>
			
						<?php
						include_once 'dbconnect.php';
						$file_path = 'Images/Gallery';
						
						if($result = mysqli_query($conn,"SELECT * FROM gallery")){
					    	while($rows = mysqli_fetch_array($result)){
								$event_name = $rows['event_name'];
								$event_desc = $rows['description'];
								$event_date = $rows['event_date'];
								$img_src = $rows['event_image'];
												
								echo "<tr>";
								echo "<td align='center'> <img src='$file_path/$img_src' alt='' width='300' height='200' class='img-responsive </td>'/>";
								echo "<td align='center'> $event_name </td>";
								echo "<td align='center'> $event_desc </td>";
								echo "<td align='center'> $event_date </td>";
								echo "</tr>";
								}
							}
						
						?>
				
					</table><br><br>
					<h4 align="center"><b>Carousel Images</b></h4>
						<div class="row">
						<?php
							include_once 'dbconnect.php';
							$file_path = 'Images/Gallery';
							if($result = mysqli_query($conn,"SELECT * FROM images")){
				    			while($rows = mysqli_fetch_array($result)){
				    				$event_name = $rows['event_name'];
							    	$img_src = $rows['image_path'];
						?>
									<div class="col-md-4">
									    <div class='img-block btn btn-default' style='height:250px;' data-toggle='modal'>
											<?php
											    echo "<img src='$file_path/$img_src' alt='' title='$event_name' width='400px' height='300px' class='img-responsive'/>";
										    	echo "<p>$event_name</p>";
											?>    
										</div>
									</div>
						<?php
								}
							}
						?>
					</div>
				</div>
			</div>
  </body>
</html>