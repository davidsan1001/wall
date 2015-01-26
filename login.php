<?php

	session_start();

	// Make sure we are in the right place home or login page
	if (isset($SESSION['logged_in'])) {
	 	//we have an active session, go to home page
	 	header("Location: home.php");
	} else {
		//no active session, go to stay here
	}



 ?>

 <html>
 <head>
 	<title>Login - Wall</title>

 	<style type="text/css">

 	#container{
 		margin: 0 auto;
 		width: 780px;
 		height: 700px;
 	}

 	#login{
 		display: inline-block;
 		vertical-align: top;
 		width: 350px;
 		height: 500px;
 		border: 1px solid black;
 		background-color: orange;
 	}

 	#registration{
 		display: inline-block;
 		vertical-align: top;
 		width: 350px;
 		height: 500px;
 		border: 1px solid black;
 		background-color: white;
 	}

 	h3{
 		text-align: center;
 		border-bottom: 2px solid black;
 		padding-bottom: 10px;
 	}

 	label {
 		display: inline-block;
 		vertical-align: top;
 		width: 150px;
 		margin-top: 7px;
 		text-align: right;
 	}

 	input[type="text"]{
 		display: inline-block;
 		vertical-align: top;
 		width: 150px;
 		margin-top: 5px;
 	}

 	input[type="submit"]{
 		margin-top: 20px;
 		margin-left: 250px;
 	}

 	.error{
 			color: red;
 			margin: 0;
 			padding: 0;
 			margin-left: 85px;
 			margin-top: 5px;
 	}

 	</style>
 </head>
 <body>

 	<div id="container">
 		<div id="login">
 			<h3>Login</h2>
 			<form action="process.php" method="post">
 				<?php if (isset($_SESSION['errors']['login_email'])) {echo '<p class="error">Email Can\'t Be Empty</p>';} ?>
 				<label>Email:</label>
 				<input type="text" name="login_email"><br>
 				<?php if (isset($_SESSION['errors']['login_password'])) {echo '<p class="error">Password Can\'t Be Empty</p>';} ?>
 				<label>Password:</label>
 				<input type="text" name="login_password"><br>
 				<input type="submit" name="login" value="Login">
 			</form>
 		</div>
 		<div id="registration">
 			<h3>Registration</h2>
 				<?php if (isset($_SESSION['errors']['in_use'])) {echo '<p class="error">Sorry, email already in use. Try again.</p>';} ?>
 			<form action="process.php" method="post">
 				<?php if (isset($_SESSION['errors']['first_name'])) {echo '<p class="error">First Name Can\'t Be Empty</p>';} ?>
 				<label>First Name:</label>
 				<input type="text" name="first_name"><br>
 				<?php if (isset($_SESSION['errors']['last_name'])) {echo '<p class="error">Last Name Can\'t Be Empty</p>';} ?>
 				<label>Last Name:</label>
 				<input type="text" name="last_name"><br>
 				<?php if (isset($_SESSION['errors']['email'])) {echo '<p class="error">Email Can\'t Be Empty</p>';} ?>
 				<label>Email:</label>
 				<input type="text" name="email"><br>
 				<?php if (isset($_SESSION['errors']['password'])) {echo '<p class="error">Password Can\'t Be Empty</p>';} ?>
 				<label>Password:</label>
 				<input type="text" name="password"><br>
 				<?php if (isset($_SESSION['errors']['confirmpassword'])) {echo '<p class="error">Confirm Password Can\'t Be Empty</p>';} ?>
 				<label>Confirm Password:</label>
 				<input type="text" name="confirmpassword">
 				<input type="submit" name="register" value="Submit">
 			</form>
 			<form action="logout.php" method="post">
 				<input type="submit" name="reset" value="Reset">
 			</form>

 	</div>
 
 </body>
 </html>