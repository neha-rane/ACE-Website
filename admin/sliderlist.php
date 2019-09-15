<?php
include_once 'innergalleryupdate.php';
?>


<!DOCTYPE html>
<html lang="en">

<body>
	<br><br><br>
	<div class="row" align="center">
		<?php
			include_once 'dbconnect.php';
			$file_path = 'Images/Gallery';
				if($result = mysqli_query($conn,"SELECT * FROM images")){
	    			while($rows = mysqli_fetch_array($result)){
	   					$event_name = $rows['event_name'];
	   					$image_id = $rows['image_id'];
			    		$img_src = $rows['image_path'];
			?>
						<div class="col-md-4">
				    		<div class='img-block btn btn-default' data-toggle='modal'>
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
</body>
</html>

