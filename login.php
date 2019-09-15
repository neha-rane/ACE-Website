<?php

if (isset($_POST["username"]) && isset($_POST["pswd"])){
    require_once('admin/dbconnect.php');

    $query = "SELECT * from login where username = '" . $_POST["username"] . "' and password = '" . $_POST["pswd"] . "'";
    $result = mysqli_query($conn, $query);

    // login successful
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION["username"] = $username;
		header("location:admin/adminhome.php");
        exit();
    }
    else {
        echo '<div align="center">Incorrect credentials</div>';
    }
}
?>

<html>
<head>
	<title>Login</title>
   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	
	<link rel="stylesheet" type="text/css" href="css\logstyle.css">
	
	<style>
		body{
			background-image: url('images/login.jpg');
		}
	</style>
	
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				
			</div>
			<div class="card-body">
				<form action="#" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="pswd" class="form-control" placeholder="password">
					</div>
					<br>
					<div class="form-group">
						<div class="container" align="center">
							<div class="row">
								<div class="col-md-12">
									<input type="submit" value="Login" class="btn login_btn">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-12">
									<a href="home.html" class="btn btn-default login_btn" role="button" >Back</a>
								</div>
							</div>
						</div>	
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>