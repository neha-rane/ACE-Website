<?php
include_once 'admineventsmain.php';
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
	$image_query = mysqli_query($conn,"select photo from events where eventname = '".$name."'");
	while($rows = mysqli_fetch_array($image_query))
	{
		$img_src = $rows['photo'];
	}

	if(mysqli_query($conn,"DELETE FROM events WHERE eventname = '".$name."'")){
		unlink("Images/Events/".$img_src);
		echo "<script type='text/javascript'>alert('Record Deleted for Event Name : '".$name.");</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}
?>

<body >
	<h3 align="center">Deleting An Event</h3><br>
	
    <div class="container">
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="sel" class="col-md-2 control-label" disabled >Event Name: </label>
				<div class="col-md-4">
					<select class="form-control" name="selevent" onchange="this.form.submit()">
						<option disabled selected>Select Event</option>
						<?php
						if($result = mysqli_query($conn,"select DISTINCT eventname FROM events")){
    							while($rows = mysqli_fetch_array($result)){
    								$name = $rows['eventname'];
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
				<td align="center"><b>From Date</b></td>
				<td align="center"><b>To Date</b></td>
				<td align="center"><b>Venue</b></td>
				<td align="center"><b>Time</b></td>
				<td align="center"><b>Fees</b></td>
			</tr>
			
			<?php
			include_once 'dbconnect.php';
			$file_path = 'Images/Events';
			if(isset($_POST['selevent'])){
				$selected_event = $_POST['selevent'];
				$_SESSION["event_name"] = $selected_event ;
				if($result = mysqli_query($conn,"SELECT * FROM events WHERE eventname = '".$selected_event."'")){
		    		while($rows = mysqli_fetch_array($result)){
						$event_name = $rows['eventname'];
						$event_desc = $rows['description'];
						$event_startdate = $rows['startdate'];
						$event_enddate = $rows['enddate'];
						$event_venue = $rows['venue'];
						$event_time = $rows['event_time'];
						$event_fees = $rows['fees'];
						$img_src = $rows['photo'];
									
						echo "<tr>";
						echo "<td align='center'> <img src='$file_path/$img_src' alt='' width='300' height='200' class='img-responsive </td>'/>";
						echo "<td align='center'> $event_name </td>";
						echo "<td align='center'> $event_desc </td>";
						echo "<td align='center'> $event_startdate </td>";
						echo "<td align='center'> $event_enddate </td>";
						echo "<td align='center'> $event_venue </td>";
						echo "<td align='center'> $event_time </td>";
						echo "<td align='center'> $event_fees </td>";
						echo "</tr>";
					}
				}
			}
			?>
				
		</table><br><br>

        <form name="updateForm" class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
			<button id="submit" name="submit" type="Submit" onclick="getConfirmation()" class="btn btn-primary col-md-2 col-md-offset-5">Delete</button>
        </form>
      </div>
    </div> <!-- /container -->
  </body>
</html>