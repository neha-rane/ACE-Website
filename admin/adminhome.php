<?php
include_once 'adminnav.php';
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
				<div class="col-md-6 col-md-offset-3" align="center">
					<h2>Feedbacks</h2><br><br>
					<table class="table table-hover" >
						<tr>
							<td align="center"><b>Name</b></td>
							<td align="center"><b>Message</b></td>
						</tr>
						<?php
							include_once 'dbconnect.php';
							$query = mysqli_query($conn,"select * from feeds");
						    while($rows = mysqli_fetch_array($query))
						  		{
						            $name = $rows['from_name'];
						            $message = $rows['message'];
						?>
									<tr>
										<td align="center"><?php echo "$name" ?></td>
										<td align="center"><?php echo "$message" ?></td>
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