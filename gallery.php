<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
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
	
				<!-- Gallery Loop-->
				<?php
					include_once 'admin/dbconnect.php';
					$file_path = 'admin/Images/Gallery';
					$image_query = mysqli_query($conn,"select * from gallery;");
				    while($rows = mysqli_fetch_array($image_query))
				  		{
				  			//echo "hello";
				            $eventname = $rows['event_name'];
				            $event_name = $eventname;
				            $desc = $rows['description'];
				            $eventdate = $rows['event_date'];
				            $img_src = $rows['event_image'];

				            for($i = 0 ; $i < strlen($eventname)-1 ; $i++ )
							{
							 if($eventname[$i] == " ") 
							 {
							  $eventname = str_replace(' ','',$eventname);
							 }
							}
				?>

							<div class="col-md-4">
						        <div class='img-block btn btn-default' data-toggle='modal' 
						        data-target=<?php echo "'.bs-example-modal-lg-$eventname'";?>>
							    <?php
							        echo 	"<img src='$file_path/$img_src' alt='' title='$event_name' width='400px' height='300px' class='img-responsive'/>";
							        echo 	"<p><strong> $event_name </strong></p>";
							    ?>
							    
						        </div>

						        <div class=<?php echo "'modal fade bs-example-modal-lg-$eventname'";?> tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>"; 
						        

  									<div class="modal-dialog modal-lg">
    									<div class="modal-content">
      										<div id=<?php echo "'carousel-generic-$eventname'"?> class="carousel slide" data-ride="carousel">
											  <!-- Wrapper for slides -->
											  	<div class="carousel-inner">
											  		<div class='item active'>
														<?php echo "<img class='img-responsive' src='$file_path/$img_src'>" ?>
											    	</div>
											  		<?php 
											  			$image_query_inner = mysqli_query($conn,"SELECT image_path FROM images WHERE event_name = '".$event_name."'");
											  			while($rows = mysqli_fetch_array($image_query_inner)){
				            								$img_inner_src = $rows['image_path'];
													?>	
											    			<div class='item'>
											    			<img class='img-responsive' src= <?php echo"'$file_path/$img_inner_src'";?>/>
											    			</div>
											    	<?php
											    		}
											     	?>
											    </div>    	
											</div>


											<!-- Controls -->
											<a class="left carousel-control" href=<?php echo "'#carousel-generic-$eventname'"?> role="button" data-slide="prev">
											   	<span class="glyphicon glyphicon-chevron-left"></span>
											</a>
											<a class="right carousel-control" href=<?php echo "'#carousel-generic-$eventname'"?> role="button" data-slide="next">
											   	<span class="glyphicon glyphicon-chevron-right"></span>
											</a>
										</div>
									</div>
								</div>
							</div>
				<?php
				        }
				?>
				
			</div>	
	</div>

</body>
</html>