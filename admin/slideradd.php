<?php
include_once 'innergalleryupdate.php';

if((!empty($_FILES['image']))){
	$total = count($_FILES['image']['name']);
	$selected_event = $_POST['selevent'];
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
		if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
		}

		if(empty($errors)==true){
			$newname = $selected_event."_".$i.".$file_ext";
			$FilePath = "Images/Gallery/".$newname;
			move_uploaded_file($file_tmp, $FilePath);
			if(mysqli_query($conn,"INSERT INTO images (event_name, image_path) VALUES ('".$selected_event."','".$newname."')")){
			    //echo "<script type='text/javascript'>alert('Images Added');</script>";
			}
		}
	}
	echo "<script type='text/javascript'>alert('Images Added');</script>";
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
					<select class="form-control" name="selevent">
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
			<div class="form-group">
				<label for="inner_images" class="col-md-2 control-label">Choose Gallery Image: </label>
				<div class="col-md-10">
					<input type="file" name="image[]" id="Image" multiple="multiple" value="" class="form-control"><br>
					<p><b><i>These Gallery Images will be visible Carousel.</b></i></p>
				</div>
			</div><br>
            <button id="submit" name="submit" type="Submit" class="btn btn-primary col-md-2 col-md-offset-5">Add</button>	
		</form>
	</div>	
</body>
</html>