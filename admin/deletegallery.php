<?php
include_once 'admingallerymain.php';
include_once 'dbconnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function getConfirmation(){
        var retVal = confirm("Do you want to continue ?");
        if( retVal == true ){
            document.submit();
            return true;
        }
        else{
            document.submit();
            return false;
        }
    }
</script>

<?php
	if (isset($_POST['submit'])) {
	$name = $_SESSION["event_name"];
	$img_src = "";
	$image_query = mysqli_query($conn,"select event_image from gallery where event_name = '".$name."'");
	while($rows = mysqli_fetch_array($image_query))
	{
		$img_src = $rows['event_image'];
	}

	if(mysqli_query($conn,"DELETE FROM gallery WHERE event_name = '".$name."'")){
		unlink("Images/Gallery/".$img_src);

		$image_query_inner = mysqli_query($conn,"select image_path from images where event_name = '".$name."'");
		while($rows = mysqli_fetch_array($image_query_inner))
		{
			$img_src_inner = $rows['image_path'];
			unlink("Images/Gallery/".$img_src_inner);
		}

		if(mysqli_query($conn,"DELETE FROM images WHERE event_name = '".$name."'")){
			echo "<script type='text/javascript'>alert('Record Deleted for Event Name : '".$name.");</script>";
		}
		else{
			//echo("Error description: " . mysqli_error($conn));
		}
	}
}
?>

<body >
	<h3 align="center">Deleting An Item from Gallery</h3><br>
	
    <div class="container">
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="sel" class="col-md-2 control-label" disabled >Event Name: </label>
				<div class="col-md-4">
					<select class="form-control" name="selevent" onchange="this.form.submit()">
						<option disabled selected>Select Event</option>
						<?php
						if($result = mysqli_query($conn,"select DISTINCT event_name FROM gallery")){
    							while($rows = mysqli_fetch_array($result)){
    								$name = $rows['event_name'];
    								echo"<option value='".$name."'>".$name."</option>";
    							}
							}
						?>
					</select>
				</div>	
			</div>	
		</form>

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
			if(isset($_POST['selevent'])){
				$selected_event = $_POST['selevent'];
				$_SESSION["event_name"] = $selected_event ;
				if($result = mysqli_query($conn,"SELECT * FROM gallery WHERE event_name = '".$selected_event."'")){
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
			}
			?>
				
		</table><br><br>
		<h4 align="center"><b>Carousel Images</b></h4>
		<div class="row">
		<?php
		include_once 'dbconnect.php';
		$file_path = 'Images/Gallery';
		if(isset($_POST['selevent'])){
			$selected_event = $_POST['selevent'];
			$_SESSION["event_name"] = $selected_event ;
			if($result = mysqli_query($conn,"SELECT image_path FROM images WHERE event_name = '".$selected_event."'")){
	    		while($rows = mysqli_fetch_array($result)){
				    $img_src = $rows['image_path'];
				?>

					<div class="col-md-4">
					    <div class='img-block btn btn-default' data-toggle='modal' style='height:250px;'>
							<?php
							    echo 	"<img src='$file_path/$img_src' alt='' title='$event_name' width='400px' height='300px' class='img-responsive'/>";
							?>
							    
						</div>
					</div>
			<?php
				}
			}
		}
		?>
		</div>
				
		
        <form name="updateForm" class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        	<div class="form-group">
				<div class="row">
					<button id="submit" name="submit" type="Submit" onclick="getConfirmation()" class="btn btn-primary col-md-2 col-md-offset-5">Delete</button>	
				</div><br>
				<p align="center"><b><i>Details from Gallery and Carousel both will be deleted.</i></b></p>
			</div>
        	
        </form>
      </div>
    </div> <!-- /container -->
  </body>
</html>