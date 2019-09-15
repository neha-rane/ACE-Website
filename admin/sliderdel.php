<?php
include_once 'innergalleryupdate.php';
session_start();

if(isset($_POST['submit']))
{
	$id = $_POST['submit'];
	//echo $id
	$name = $_SESSION["event_name"];
	$img_src = "";
	
	$image_query_inner = mysqli_query($conn,"select image_path from images where image_id = '".$id."'");
	while($rows = mysqli_fetch_array($image_query_inner))
	{
		$img_src_inner = $rows['image_path'];
		unlink("Images/Gallery/".$img_src_inner);
	}

	if(mysqli_query($conn,"DELETE FROM images WHERE image_id = '".$id."'")){
		echo "<script type='text/javascript'>alert('Record Deleted');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<body>
	<br><br><br>
	<div class="container">
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="sel" class="col-md-2 control-label" disabled >Event Name: </label>
				<div class="col-md-4">
					<select class="form-control" name="selevent"  onchange="this.form.submit()">
						<option disabled selected>Select Event</option>
						<?php
						if($result = mysqli_query($conn,"select DISTINCT event_name FROM images")){
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

		<?php
			if(isset($_POST['selevent'])){
				$selected_event = $_POST['selevent'];
				$_SESSION["event_name"] = $selected_event ;
			}
		?>

		<div class="row">
			<form  class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<div class="form-group">
			<div class="col-md-12" align="center">
				<h3>List of All Items in Gallery</h3><br><br>
				<table class="table table-hover"  align="center">
					<tr>
						<td align="center"><b>Photo</b></td>
						<td align="center"><b>Event Name</b></td>
						<td align="center"><b>Option</b></td>
					</tr>
		<?php
					include_once 'dbconnect.php';
					$file_path = 'Images/Gallery';
					$name = $_SESSION["event_name"];
					if($result = mysqli_query($conn,"SELECT * FROM images WHERE event_name = '".$name."'")){
	    				while($rows = mysqli_fetch_array($result)){
	   						$event_name = $rows['event_name'];
			    			$img_src = $rows['image_path'];
			    			$image_id = $rows['image_id'];
		
							echo "<tr>";
							echo "<td align='center'> <img src='$file_path/$img_src' alt='' title='$event_name' width='400px' height='300px' class='img-responsive'/> </td> ";
							echo "<td align='center'> $event_name </td>";
							echo "<td><button value='$image_id' name='submit' type='Submit' class='btn btn-primary'>Delete</button></td>";
							echo "</tr>";
						}
					}		
		?>
				</table>
			</div>
			</form>	
		</div>
</body>
</html>