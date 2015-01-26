<?php

session_start();
require('connection.php'); 

if (isset($_POST['register'])) {
    	checkRegistrationFieldsForEmptyFields();
    	checkIfEmailAlreadyInUse();
    	addUserToDatabase();
    	activateSessionForNewUser();
    	header("Location: home.php");
    	//echo "register";

	} else if (isset($_POST['login'])) {
    	checkLoginForEmptyFields();
    	checkLoginFromDatabase();
		$SESSION['logged_in'] = true;
    	header("Location: home.php");

	} else {
    	//no button pressed
    	echo "Uh Oh!";
	}

	function checkRegistrationFieldsForEmptyFields(){

		if (empty($_POST['first_name']))
			$_SESSION['errors']['first_name'] = 'empty';

		if (empty($_POST['last_name']))
			$_SESSION['errors']['last_name'] = 'empty';

		if (empty($_POST['email']))
			$_SESSION['errors']['email'] = 'empty';

		if (empty($_POST['password']))
			$_SESSION['errors']['password'] = 'empty';

		if (empty($_POST['confirmpassword']))
			$_SESSION['errors']['confirmpassword'] = 'empty';

		checkForErrorsAndRedirectIfNecessary();

	}

	function checkLoginForEmptyFields(){

		if (empty($_POST['login_email']))
			$_SESSION['errors']['login_email'] = 'empty';

		if (empty($_POST['login_password']))
			$_SESSION['errors']['login_password'] = 'empty';

		checkForErrorsAndRedirectIfNecessary();

	}

	function checkForErrorsAndRedirectIfNecessary(){
		if (!empty($_SESSION['errors'])) {
			header("Location: login.php");
		}
	}

	function checkIfEmailAlreadyInUse() {

		$email = $_POST['email'];

		$query = "

		SELECT *
		FROM `wall`.`users`
		WHERE email = '".$email."';

		";

		//echo $query . '<br>';

		$result = fetch_record($query);

		//var_dump($result);

		if (is_array($result)) {
			//add error, return to login page
			$_SESSION['errors']['in_use'] = true;
			checkForErrorsAndRedirectIfNecessary();
		} else {
			//its all good, move on
			//remove in use error if that had been a problem
			unset($_SESSION['errors']['in_use']);			
		}

	}

	function addUserToDatabase() {

		$firstname = $_POST['first_name'];
		$lastname = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		//run escape_this_string to protect against malicious sql injection
		$firstname = escape_this_string($firstname);
		$lastname = escape_this_string($lastname);
		$email = escape_this_string($email);
		$password = escape_this_string($password);

		$query = "

		INSERT INTO `wall`.`users`
			(
			`first_name`,
			`last_name`,
			`email`,
			`password`,
			`created_at`)
		VALUES
		(
			'".$firstname."',
			'".$lastname."',
			'".$email."',
			'".$password."',
			NOW()
		);";

		$result = run_mysql_query($query);

		//if user added, set session variables
		if ($result > 1) {
			$_SESSION['validsession'] = 'yes';
			$_SESSION['first_name'] = $firstname;
			$_SESSION['last_name'] = $lastname;
			$_SESSION['userid'] = $result;
		}
	}

	function checkLoginFromDatabase(){

		$query = "SELECT * FROM users WHERE email = '".$_POST['login_email']."' AND password = '".$_POST['login_password']."';";
		$result = fetch_record($query);

		if (is_array($result)) {
			//looks good, we have a valid user
			$_SESSION['validsession'] = 'yes';
			$_SESSION['first_name'] = $result['first_name'];
			$_SESSION['last_name'] = $result['last_name'];
			$_SESSION['userid'] = $result['id'];
			header("Location: home.php");

		} else {
			//login failed
			$_SESSION['errors']['login'] = 'failed';
			checkForErrorsAndRedirectIfNecessary();
		}

		var_dump($result);

	}

	function activateSessionForNewUser(){
		//
		//var_dump($result);
	}

 ?>