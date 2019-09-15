<?php
include_once 'events.php';?>
<html>
<body>
	<!-- Outer Fluid container-->
	<div class="container-fluid" style="background-color:#1c1919;"> 
		<!-- Main Container -->
		<div  class="fluid-container" id="main">
			
			<div class="row">
				<div class="col-md-12" align="center">
					<?php
					include_once 'admin/dbconnect.php';
					$file_path = 'admin/Images/Events';
					$image_query = mysqli_query($conn,"select * from events where startdate > CURDATE()");
					
				    while($rows = mysqli_fetch_array($image_query))
				  		{
				            $event_name = $rows['eventname'];
				            $event_desc = $rows['description'];
				            $event_startdate = $rows['startdate'];
				            $event_enddate = $rows['enddate'];
				            $event_venue = $rows['venue'];
				            $event_time = $rows['event_time'];
				            $event_fees = $rows['fees'];
				            $img_src = $rows['photo'];

							echo "<div class='col-md-4' style='height:500px;'>";
							echo "<div class='well well-lg'>";
								
									echo 	"<img src='$file_path/$img_src' alt='' width='300' height='200' class='img-responsive'/>";
									echo 	"<h3>$event_name</h3>";
									echo 	"<p>$event_desc</p>";
									echo 	"<p><strong>Start Date:</strong> $event_startdate </p>";
									echo 	"<p><strong>End Date:</strong> $event_enddate</p>";
									echo 	"<p><strong>Venue:</strong> $event_venue </p>";
									echo 	"<p><strong>Time:</strong> $event_time </p>";
									echo 	"<p><strong>Fees:</strong> $event_fees </p>";
									
									//<!--<a href="#" class="lineBtn">Read More</a>-->
									
							echo "</div></div>";
				        }
				    
				?>
						
				</div>
			</div>
		</div>	<!-- Main Container End -->
	</div> <!-- Outer Container End -->
</body>
</html>
				