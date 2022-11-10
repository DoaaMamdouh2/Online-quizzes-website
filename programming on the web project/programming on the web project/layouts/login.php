<?php
	session_start();
	// if already logged IN
	if (isset($_SESSION['loggedIN'])) {
		header('Location: index.php');
		exit();
	}

	include('db.php');

	// condition Login
	if(isset($_POST['login'])) {
		$email = $connection->real_escape_string($_POST['emailPHP']);
		$password = md5($connection->real_escape_string($_POST['passwordPHP']));

		// query login
		$data = $connection->query("SELECT id, first_name, last_name FROM users WHERE email='$email' AND password='$password'");
		$show = mysqli_fetch_assoc($data);
		$id = $show['id'];
		$first_name = $show['first_name'];
		$last_name = $show['last_name'];

		// condition check on user
		if ($data->num_rows > 0) {
			// everyting OK, lets login
			$_SESSION['loggedIN'] = '1';
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $email;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;

			exit('<font color="green" margin-bottom="10px">Login success....</font>');
		}else {
			exit('<font color="red" margin-bottom="10px">Pleas check your input</font>');
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="make a form">
		<title>login page</title>
		<!-- style css login -->
		<link rel="stylesheet" href="css/login.css">
	</head>
	<body>
		<div>
			<h1 >Login Page </h1>
			
			<!-- message response  -->
			<h5 id="response"></h5>

			<!-- form login -->
			<form action="start_quiz.php" method="post">
				<label>email </label>
				<input type="email" id="email" placeholder="write email" >
				<br><br>
				<label>password</label>
				<input type="password" id="password">
				<br><br>
				<input type="checkbox">
				<label>Remember Me</label>
				<br><br>
				<input type="button" value="log in" id="login">
			</form>	
			<br>
			<label> Create a new account? </label>  <a href="signup.php" >  Sign up </a>
		</div>

		<script src="js/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<!-- code login ajax  -->
		<script src="js/login.js" ></script>
	</body>
</html>

