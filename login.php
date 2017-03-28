<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<script src="https://use.fontawesome.com/4f50358355.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
</head>
<body>
	<div class="container">
		<!-- NavBar -->
		<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="index.php"></a><i class="fa fa-star fa-2x" aria-hidden="true"></i>Tsarbucks</a>
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="registration.php"></i> Register</a>
				</li>
			</ul>
		</nav>

	<!-- Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="display-1 text-center">Login</h1>
		</div>
	</div>

	<?php
		require('db.php');
		session_start();
		// If form submitted, insert values into the database.
		if (isset($_POST['username'])){
			// removes backslashes
			$username = stripslashes($_REQUEST['username']);
		  //escapes special characters in a string
			$username = mysqli_real_escape_string($con,$username);
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con,$password);

			//Checking is user existing in the database or not
			$query = $con->query("SELECT * FROM `users` WHERE username='$username'and password='".sha1($password)."'");

			//If only one row returned
			if ($query->num_rows == 1) {
				$_SESSION['username'] = $username;
				//The row returned as an array to get the string value of display_name
			 	while ($row = $query->fetch_assoc()) {
					$display_name=$row["display_name"];
				 	$_SESSION['sessCustomerID'] = $row["user_id"];
			 	}
				//Check if the user is a Customer or Barista
			  if($display_name == "Customer"){
					header("Location: cust_home.php");
			 	} else {
				 	header("Location: bar_home.php");

			 	}

		  	} else {
					//Incorrect Password
					echo "<div class='form'>
								<h3>Username/password is incorrect.</h3>
								<br/>Click here to <a href='login.php'>Login</a></div>";
							}
						} else {
		?>
							<!-- Login form -->
							<div class="row justify-content-center">
								<div class="col-6">
									<form action="login.php" method="post" role="form">
										<div class="form-group">
											<label for="username"><h4>Username</h4></label>
											<input type="text" class="form-control" name="username"  placeholder="Enter username" required>
										</div>
										<div class="form-group">
											<label for="password"><h4>Password</h4></label>
											<input type="password" class="form-control" name="password" placeholder="Password" required>
										</div>
										<button type="submit" class="btn btn-primary">Login</button>
									</form>
									<div class="col-6 ">
										<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
									</div>
								</div>
							</div>


	<?php 		} ?>

	</div>
</body>
</html>
