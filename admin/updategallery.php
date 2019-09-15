<?php
include_once 'admingallerymain.php';
include_once 'dbconnect.php';
session_start();

if (isset($_POST['details'])) {
	$new_value = mysqli_real_escape_string($conn, $_POST['details']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];

	if(mysqli_query($conn,"UPDATE gallery SET ".$selected_column." = '".$new_value."' WHERE event_name = '".$name."'")){
		echo "<script type='text/javascript'>alert('Details Updated');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
	}
}
	

if (isset($_POST['newdate'])) {
	$new_date = mysqli_real_escape_string($conn, $_POST['newdate']);
	$name = $_SESSION["event_name"];
	$selected_column = $_POST['selField'];

	if(mysqli_query($conn,"UPDATE gallery SET ".$selected_column." = '".$new_date."' WHERE event_name = '".$name."'")){
		echo "<script type='text/javascript'>alert('Date Updated');</script>";
	}
	else{
		//echo("Error description: " . mysqli_error($conn));
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

    

    if(empty($errors)==true){
    	$newname = $name.".$file_ext";
    	//echo "$newname";
    	$image_query = mysqli_query($conn,"select event_image from gallery");
		while($rows = mysqli_fetch_array($image_query)){
			$img_src = $rows['event_image'];
			unlink("Images/Gallery/".$img_src);
		}
        move_uploaded_file($file_tmp,"Images/Gallery/".$newname);
        if(mysqli_query($conn,"UPDATE gallery SET event_image = '".$newname."' WHERE event_name = '".$name."'")){
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
	<h3 align="center">Updating Existing Items in Gallery</h3><br>
	
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


		<script> 
		function test(){
			var colName = document.forms["updateForm"]["selField"].value;
			//alert(colName);
			if(colName == 'event_image'){
				//alert("hello");
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = false;
			}
			else if(colName == 'event_date'){
				document.getElementById("newdetails").disabled = true;
				document.getElementById("newdate").disabled = false;
				document.getElementById("newimage").disabled = true;
			}
			else{
				document.getElementById("newdetails").disabled = false;
				document.getElementById("newdate").disabled = true;
				document.getElementById("newimage").disabled = true;
			}
		}

		</script>

        <form name="updateForm" class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        	<div class="form-group">
				<label for="sel" class="col-md-2 control-label">Select Field: </label>
				<div class="col-md-4">
					<select class="form-control" name="selField" onchange="test()">
						<option disabled selected>Select Field</option>
						<option value="event_date">Date</option>
						<option value="description">Description</option>
						<option value="event_image">Photo</option>
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
			<div>
				<button id="submit" name="submit" type="Submit"  class="btn btn-primary col-md-2 col-md-offset-3">Update</button>
				<a id="submit" href="innergalleryupdate.php" type="Submit"  class="btn btn-primary col-md-2 col-md-offset-2">Update Carousel Images</a>
			</div>
        </form>
      </div>
    </div> <!-- /container -->
  </body>
</html>