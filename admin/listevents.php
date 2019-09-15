<?php
include_once 'admineventsmain.php';
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
					<h3>List of All Events</h3><br><br>
					<table class="table table-hover"  align="center">
						<tr>
							<td align="center"><b>Photo</b></td>
							<td align="center"><b>Name</b></td>
							<td align="center"><b>Description</b></td>
							<td align="center"><b>From Date</b></td>
							<td align="center"><b>To Date</b></td>
							<td align="center"><b>Venue</b></td>
							<td align="center"><b>Time</b></td>
							<td align="center"><b>Fees</b></td>
						</tr>
						<?php
							include_once 'dbconnect.php';
							$file_path = 'Images/Events';
							$image_query = mysqli_query($conn,"select * from events");
						    while($rows = mysqli_fetch_array($image_query))
						  		{
						            $event_name = $rows['eventname'];
						            $event_desc = $rows['description'];
						            $event_startdate = $rows['startdate'];
						            $event_enddate = $rows['enddate'];
						            $event_venue = $rows['venue'];
						            $event_time = $rows['time'];
						            $event_fees = $rows['fees'];
						            $img_src = $rows['photo'];
						?>
									<tr>
										<td align="center"><?php echo "<img src='$file_path/$img_src' alt='' width='300' height='200' class='img-responsive'/>"; ?></td>
										<td align="center"><?php echo "$event_name" ?></td>
										<td align="center"><?php echo "$event_desc" ?></td>
										<td align="center"><?php echo "$event_startdate" ?></td>
										<td align="center"><?php echo "$event_enddate" ?></td>
										<td align="center"><?php echo "$event_venue" ?></td>
										<td align="center"><?php echo "$event_time" ?></td>
										<td align="center"><?php echo "$event_fees" ?></td>
									</tr>
						<?php
						        }
						?>
					</table><br><br>
				</div>
				
				
			</div>
						
		</div>
  </body>
</html>