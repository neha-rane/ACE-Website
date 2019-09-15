<?php
error_reporting(0);
include_once 'admingallerymain.php';
//Check if all fields are filled
if ( isset($_POST['eventname']) && isset($_POST['descr']) && isset($_POST['event_date']) && (!empty($_FILES['cover_image']))){
		//echo "hello";
		include_once('dbconnect.php');  //Connect DB
		
		//Get all values in variables
		$name = mysqli_real_escape_string($conn, $_POST['eventname']);
	    $desc = mysqli_real_escape_string($conn, $_POST['descr']);
	    $start = mysqli_real_escape_string($conn, $_POST['event_date']);
		$total = count($_FILES['image']['name']);



		//echo $total;
			    
		//Check if eventname exists
		$eventExists = false;
		$query = "SELECT * from gallery where event_name = '" . $name . "'";
	    $result = mysqli_query($conn, $query);

	    if (mysqli_num_rows($result) == 1) {
	    	$eventExists = true;
	        echo "<script type='text/javascript'>alert('Event Already Exists.');</script>";
	    }
	    else {
	        $eventExists = false;
	    }
	    if(!$eventExists){
	    	$errors= array();
			$file_name = $_FILES['cover_image']['name'];                              //File name without ext	
	    	$file_tmp =$_FILES['cover_image']['tmp_name'];
			$file_size =$_FILES['cover_image']['size'];								//File size
	    	$file_type=$_FILES['cover_image']['type'];								//File type
	    	$file_ext=strtolower(end(explode('.',$_FILES['cover_image']['name'])));	//File Extension
	      	//$file_ext = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
	      	//echo $ext;

	    	$expensions= array("jpeg","jpg","png");			//Expected Extensions
	      
	    	//Match Extensions
	    	if(in_array($file_ext,$expensions)== false){ 
	        	$errors[]="Please choose a JPEG or PNG file.";
	    	}	
	      
			//Check Size
			if($file_size > 2097152){
			    $errors[]='File size must be excately 2 MB';
			}

			if(empty($errors)==true){
			   	$newname = $name.".$file_ext";
		    	$FilePath = "Images/Gallery/" . $newname;
		    	move_uploaded_file($file_tmp, $FilePath);
		    	if(mysqli_query($conn,"INSERT INTO `gallery` (event_name, event_date, description, event_image) VALUES ('$name', '$start', '$desc','$newname')")){
					//echo "Success2";
				}
			}
			if((!empty($_FILES['image']))){
				for( $i=0 ; $i < $total ; $i++ ) {
					$errors= array();
					$file_name = $_FILES['image']['name'][$i];                              //File name without ext	
		    		$file_tmp =$_FILES['image']['tmp_name'][$i];
					$file_size =$_FILES['image']['size'][$i];								//File size
		    		$file_type=$_FILES['image']['type'][$i];								//File type
		    		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'][$i])));	//File Extension
		      		//$file_ext = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
		      		//echo $ext;

		    		$expensions= array("jpeg","jpg","png");			//Expected Extensions
		      
		    		//Match Extensions
		    		if(in_array($file_ext,$expensions)== false){ 
		        		$errors[]="Please choose a JPEG or PNG file.";
		    		}	
		      
				    //Check Size
				    if($file_size > 2097152){ //80000000
				        $errors[]='File size must be excately 2 MB';
				    }

				    if(empty($errors)==true){
				    	$newname = $name."".$i.".$file_ext";
			    		$FilePath = "Images/Gallery/" . $newname;
			    		move_uploaded_file($file_tmp, $FilePath);
			    		if(mysqli_query($conn,"INSERT INTO `images` (event_name, image_path) VALUES ('$name','$newname')")){
			    			//echo "Success";
			    		}
				    }
				}
			}

			echo "<script type='text/javascript'>alert('Values Inserted');</script>";
	    }
	    else{
	        echo "<script type='text/javascript'>alert('Event with same name already exists!');</script>";
	    }	        
	}
else
{
	//echo "<script type='text/javascript'>alert('Something went wrong!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
	<h3 align="center">Adding New Item to Gallery</h3><br>
    <div class="container">
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <div class="form-group">
				<label for="name" class="col-md-2 control-label">Event Name: </label>
				<div class="col-md-10">
					<input type="text" name="eventname" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="descr" class="col-md-2 control-label">Description: </label>
				<div class="col-md-10">
					<textarea name="descr" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="event_date" class="col-md-2 control-label">Event Date: </label>
				<div class="col-md-10">
					<input type="date" name="event_date" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="cover_image" class="col-md-2 control-label">Choose Cover Image: </label>
				<div class="col-md-10">
					<input type="file" name="cover_image" id="Image" value="" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="inner_images" class="col-md-2 control-label">Choose Gallery Image: </label>
				<div class="col-md-10">
					<input type="file" name="image[]" id="Image" multiple="multiple" value="" class="form-control"><br>
					<p><b><i>These Gallery Images will be visible Carousel under the given Cover Image, This field is optional.</b></i></p>
				</div>
			</div><br>
            <button id="submit" name="submit" type="Submit" class="btn btn-primary col-md-2 col-md-offset-5">Add</button>
          </form>
      </div>


    </div> <!-- /container -->


    
  </body>
</html>