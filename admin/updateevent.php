<?php
include_once 'admineventsmain.php';
include_once 'dbconnect.php';
session_start();

if (isset($_POST['details'])) {
	$new_value = mysqli_real_escape_string($conn, $_POST['details']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];

	if(mysqli_query($conn,"UPDATE events SET ".$selected_column." = '".$new_value."' WHERE eventname = '".$name."'")){
		echo "<script type='text/javascript'>alert('Details Updated');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}
	

if($selected_column == 'fees'){
	$new_value = mysqli_real_escape_string($conn, $_POST['details']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];
		
	if(mysqli_query($conn,"UPDATE events SET ".$selected_column." = ".$new_value." WHERE eventname = '".$name."'")){
		echo "<script type='text/javascript'>alert('Fees Updated');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}

if (isset($_POST['time'])) {
	$new_time = mysqli_real_escape_string($conn, $_POST['time']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];
	if(mysqli_query($conn,"UPDATE events SET ".$selected_column." = '".$new_date."' WHERE eventname = '".$name."'")){
		echo "<script type='text/javascript'>alert('Date Updated');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}

if (isset($_POST['newdate'])) {
	$new_date = mysqli_real_escape_string($conn, $_POST['newdate']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];
	$valid_date=false;
	if($result = mysqli_query($conn,"SELECT startdate, enddate FROM events WHERE eventname = '".$name."'")){
	    while($rows = mysqli_fetch_array($result)){
			$start = $rows['startdate'];
			$end = $rows['enddate'];
    		$date1 = strtotime($start);
			$date2 = strtotime($end);
			
			if($selected_column == 'startdate'){
				$newstart = strtotime($_POST['newdate']);
				if($newstart < $date2)
				{
					$valid_date = true;
				}
				else{
					$valid_date = false;
					echo "<script type='text/javascript'>alert('End Date can not be before start date');</script>";
				}
			}
			else
			{
				$newend = strtotime($_POST['newdate']);
				if($newend > $date1)
				{
					$valid_date = true;
				}
				else{
					$valid_date = false;
					echo "<script type='text/javascript'>alert('End Date can not be before start date');</script>";
				}
			}
		}
	}

	if($valid_date){
		if(mysqli_query($conn,"UPDATE events SET ".$selected_column." = '".$new_date."' WHERE eventname = '".$name."'")){
			echo "<script type='text/javascript'>alert('Date Updated');</script>";
		}
		else{
			//echo("Error description: " . mysqli_error($conn));
		}      
	}
}

if (!empty($_FILES['image'])) {
	$name = $_SESSION["event_name"];
	//echo $name;
	$errors= array();
    $file_name = $_FILES['image']['name'];                              //File name without ext
    $file_size =$_FILES['image']['size'];								//File size	
    $file_tmp =$_FILES['image']['tmp_name'];							//
    $file_type=$_FILES['image']['type'];								//File type
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));	//File Extension
	      
    $expensions= array("jpeg","jpg","png");			//Expected Extensions
      
    //Match Extensions
    if(in_array($file_ext,$expensions)=== false){ 
       $errors[]="Please choose a JPEG or PNG file.";
    }
      
    //Check Size
    if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
    }

    $image_query = mysqli_query($conn,"select photo from events");
	while($rows = mysqli_fetch_array($image_query)){
		$img_src = $rows['photo'];
	}

    if(empty($errors)==true){
    	$newname = $name.".$file_ext";
    	//echo "$newname";
    	unlink("Images/Events/".$newname);
        move_uploaded_file($file_tmp,"Images/Events/".$newname);
        if(mysqli_query($conn,"UPDATE `events` SET photo = '".$newname."' WHERE eventname = '".$name."'")){
        	echo "<script type='text/javascript'>alert('Image Updated');</script>";
        }
        else{
        	//echo("Error description: " . mysqli_error($conn));
        }
    }
    else{
        print_r($errors);
    }	  
}
?>





<!DOCTYPE html>
<html lang="en">

<body >
	<h3 align="center">Updating Existing Event</h3><br>
	
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


		<script> 
		function test(){
			var colName = document.forms["updateForm"]["selField"].value;
			//alert(colName);
			if(colName == 'photo'){
				//alert("hello");
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = false;
				document.getElementById("newtime").disabled = true;
				document.getElementById("newfees").disabled = true;
			}
			else if(colName == 'startdate' || colName == 'enddate'){
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = false;
				document.getElementById("newimage").disabled = true;
				document.getElementById("newtime").disabled = true;
				document.getElementById("newfees").disabled = true;
			}
			else if(colName == 'event_time'){
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = true;
				document.getElementById("newtime").disabled = false;
				document.getElementById("newfees").disabled = true;
			}
			else if(colName == 'fees'){
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = true;
				document.getElementById("newtime").disabled = true;
				document.getElementById("newfees").disabled = false;
			}
			else{
				document.getElementById("newdetails").disabled = false;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = true;
				document.getElementById("newtime").disabled = true;
				document.getElementById("newfees").disabled = true;
			}
		}

		</script>

        <form name="updateForm" class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        	<div class="form-group">
				<label for="sel" class="col-md-2 control-label">Select Field: </label>
				<div class="col-md-4">
					<select class="form-control" name="selField" onchange="test()">
						<option disabled selected>Select Field</option>
						<option value="startdate">Start Date</option>
						<option value="enddate">End Date</option>
						<option value="description">Description</option>
						<option value="venue">Venue</option>
						<option value="event_time">Time</option>
						<option value="fees">Fees</option>
						<option value="photo">Photo</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="event_details" class="col-md-2 control-label">New Values: </label>
				<div  class="col-md-10">
					<input type="text" id="newdetails" name="details" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Fees: </label>
				<div class="col-md-10">
					<input type="number" id="newfees" name="fee" class="form-control" min="0.0" max="999.99" required disabled="true" />
				</div>
			</div>
			<div class="form-group">
				<label for="event_files" class="col-md-2 control-label">New Time: </label>
				<div  class="col-md-10">
					<input type="text" id="newtime" pattern="\d{1,2}:\d{2}([ap]m)?" placeholder="eg: 10:00am OR 18:30" name="time" class="form-control" disabled="true" required />
				</div>
			</div>
			<div class="form-group">
				<label for="event_date" class="col-md-2 control-label">Choose Date: </label>
				<div  class="col-md-10">
					<input type="date" id="newdate" name="newdate" disabled="true" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="event_files" class="col-md-2 control-label">Choose Image: </label>
				<div  class="col-md-10">
					<input type="file" id="newimage" name="image" disabled="true" class="form-control">
				</div>
			</div>
			<button id="submit" name="submit" type="Submit"  class="btn btn-primary col-md-2 col-md-offset-5">Update</button>
        </form>
      </div>
    </div> <!-- /container -->
  </body>
</html>