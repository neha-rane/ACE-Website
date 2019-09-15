<?php
include_once 'admineventsmain.php';

//Check if all fields are filled
if ( isset($_POST['eventname']) && isset($_POST['descr']) && isset($_POST['event_start_date']) && isset($_POST['event_end_date']) && isset($_POST['venue']) && isset($_POST['time']) && isset($_POST['fee']) && (!empty($_FILES['image']))) {
		
		include_once('dbconnect.php');  //Connect DB
		
		//Get all values in variables
		$name = mysqli_real_escape_string($conn, $_POST['eventname']);
	    $desc = mysqli_real_escape_string($conn, $_POST['descr']);
	    $start = mysqli_real_escape_string($conn, $_POST['event_start_date']);
		$end = mysqli_real_escape_string($conn, $_POST['event_end_date']);
	    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
	    $time = mysqli_real_escape_string($conn, $_POST['time']);
		$fee = mysqli_real_escape_string($conn, $_POST['fee']);
		
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

	    //Store dates in variables
	    $date1 = strtotime($_POST['event_start_date']);
		$date2 = strtotime($_POST['event_end_date']);

		$valid_date = false;
		//compare the dates
		if($date1 < $date2){
		   	$valid_date = true;		//Start Date smaller than End Date
		}
		else if($date1 == $date2){
			$valid_date = true;
		}
		else{
			$valid_date = false;	
		   	echo "<script type='text/javascript'>alert('End Date can not be before start date');</script>";
		}

		//Fetching year
		$date = $_POST['event_start_date'];
		list($e_year) = explode("-", $date);
		//echo $year;

		//Check if eventname exists
		$eventExists = false;
		$query = "SELECT * from events where eventname = '" . $name . "'";
	    $result = mysqli_query($conn, $query);

	    if (mysqli_num_rows($result) == 1) {
	    	$eventExists = true;
	        echo "<script type='text/javascript'>alert('Event Already Exists.');</script>";
	    }
	    else {
	        $eventExists = false;
	    }

		//If everything is fine Insert Details!
	    if(empty($errors)==true && $valid_date && !$eventExists){
	    	$newname = $name.".$file_ext";
	        move_uploaded_file($file_tmp,"Images/Events/".$newname);
	        mysqli_query($conn,"INSERT INTO `events` (eventname, startdate, enddate, eventyear, description, venue, fees, photo, event_time) VALUES ('$name', '$start', '$end', '$e_year', '$desc','$venue','$fee','$newname', '$time')");
	        //echo "Success";
	        echo "<script type='text/javascript'>alert('Values Inserted');</script>";
	    }
	    else{
	        //print_r($errors);
	    }	        
}
else
{
	//echo "<script type='text/javascript'>alert('Something went wrong!');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
	<h3 align="center">Adding New Event</h3><br>
    <div class="container">
        <form name="updateForm" class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
            <div class="form-group">
				<label class="col-md-2 control-label">Event Name: </label>
				<div class="col-md-10">
					<input type="text" name="eventname" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Description: </label>
				<div class="col-md-10">
					<textarea name="descr" class="form-control" required /></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Event Start Date: </label>
				<div class="col-md-10">
					<input type="date" name="event_start_date" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Event End Date: </label>
				<div class="col-md-10">
					<input type="date" name="event_end_date" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Venue: </label>
				<div class="col-md-10">
					<input type="text" name="venue" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Time: </label>
				<div class="col-md-10">
					<input type="text" pattern="\d{1,2}:\d{2}([ap]m)?" placeholder="eg: 10:00am OR 18:30" name="time" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Fees: </label>
				<div class="col-md-10">
					<input type="number" name="fee" class="form-control" min="0.0" max="999.99" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Choose Image: </label>
				<div class="col-md-10">
					<input type="file" name="image" id="imageupload" value="" class="form-control" required />
				</div>
			</div><br>
            <button id="submit" name="submit" type="Submit" class="btn btn-primary col-md-2 col-md-offset-5">Add</button>
        </form>
    </div>
  </body>
</html>