<?php
	session_start();
	// if already logged IN
	if (isset($_SESSION['loggedIN'])) {
		header('Location: index.php');
		exit();
	}

	include('db.php');

	


	// condition signup
	if(isset($_POST['signup'])) {
		$f_name = $_POST['f_name'];
		$l_name = $_POST['l_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		// condition check on email
		$data = $connection->query("SELECT id FROM users WHERE email='$email'");
		if ($data->num_rows > 0) {
			exit('<font color="red">The email already exists....</font>');
		}

		if ($password == $confirm_password) {
			$sql = "INSERT INTO `users`( `first_name`, `last_name`, `password`, `email`) VALUES ('$f_name','$l_name',MD5('".$password."'),'$email')";
			if (mysqli_query($connection, $sql)) {
				// everyting OK, lets signup
				$_SESSION['loggedIN'] = '1';
				$_SESSION['email'] = $email;
				$_SESSION['first_name'] = $f_name;
				$_SESSION['last_name'] = $l_name;
				exit('<font color="green">Login success....</font>');
			} 
			else {
				exit('<font color="red">Pleas check your inputs</font>');
			}
			mysqli_close($connection);
		} else {
			exit('<font color="red">Pleas check your confirm password</font>');
		}

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="make form">
		<title>sign up</title>
		<!-- style css signup -->
		<link rel="stylesheet" href="css/signup.css">
	</head>
	<body>
		<div>
		
		<h1> Sign Up <hr> </h1> 
		
		<!-- message response  -->
		<h3 id="response"></h3>

		<!-- form sign up -->
		<form action="index.php" method="post">
	     
			<label class="label"  > First Name </label>         
			<br> 
			<input  type="text" id="first_name" placeholder="Enter your  First Name">  
			<br> <br>
			
			<label class="label" >Last Name</label>         
			<br> 
			<input   type="text" id="last_name" placeholder="Enter your  Last Name"> 
			<br> <br>
				
			<label class="label" >Email</label>           
			<br> 
			<input  type="email" id="email" placeholder="abc@gmail.com"> 
			<br> <br>
			
			<label class="label">password</label>
			<br> 
			<input  type="password" id="password" maxlength="11"> 
			<br> <br>
			
			<label class="label"> Confirm password</label>            
			<br> 
			<input  type="password" id="confirm_password" maxlength="11"> 
			<br> <br> <br> <br>
			
			<input type="button" value="Sign Up" id="signup"> 
			<br> <br>

			<label> Already have Account? </label>  <a href="login.php" >  Login </a>
		
		</form>
		</div>

		<script src="js/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<!-- code signup ajax  -->
		<script src="js/signup.js" ></script>
	</body>
</html>