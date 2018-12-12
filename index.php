<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<style type="text/css">
			body {
				font-family: arial;
			}
			input{
				margin: 0.5em 0em 0.5em 0em;
				padding: 0.5em;
			}

			input[type="submit"]{
				padding: 0.3em 1em 0.3em 1em;
				background: rgb(100, 100, 200);
				border: 0px solid black;
				color: white;
				border-radius: 4px;
			}
			input.credentials{
				border: 1px solid gray;
				background: #F0F0F0;

			}
		</style>
	</head>
	<body>
		<?php
			include('database.php');

			// if user is logged in, redirect to review.php
			if (logged_in())
				redirect("reviews.php");

			// print_r($_POST)

			// login			
			if (isset($_POST['nie']) && isset($_POST['password']) & isset($_POST['login'])) {
				$nie  = $_POST['nie'];
				$password  = $_POST['password'];

				login($dbc, $nie, $password);
			}

			// registration
			if (isset($_POST['nie']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['register'])) {
				$nie  = $_POST['nie'];
				$password  = $_POST['password'];
				$password2  = $_POST['password2'];

				if (strlen($nie) >= 3 && strlen($password) >= 3) {
					if ($password == $password2) {
						// insert user
						register($dbc, $nie, $password);
					} else {
						echo "Passwords should match.";
					}
				} else {
					echo "Name/ID/Email/Password should be at least 3 characters long.";
				}
			}
		?>

		<form action='' method='POST'>
			<center>
				<h1>Login</h1>
			</center>
			<center>
				<input type="text" name='nie' class="credentials" placeholder="Name/ID/Email">
			</center>
			<center>
				<input type="password" name='password' class="credentials" placeholder="Password">
			</center>
			<input name='login' type='hidden'/>
			<center>
				<input type="submit" value="Login" >
			</center>
		</form>
		
		<form method='POST' action=''>
			<center>
				<h1>Register</h1>
			</center>
			<center>
				<input type="text" name='nie' class="credentials" placeholder="Name/ID/Email">
			</center>
			<center>
				<input type="password" name='password' class="credentials" placeholder="Password">
			</center>
			<center>
				<input type="password" name='password2' class="credentials" placeholder="Password confirm">
			</center>
			<input name='register' type='hidden'/>
			<center>
				<input type="submit" value="Register" >
			</center>
		</form>
	</body>
</html>