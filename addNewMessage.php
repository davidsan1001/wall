<?php 

session_start();
require('connection.php');

if (isset($_POST['new_message'])) {

	checkMessageValidity();
	addMessageToDatabase();

} else {

	$_SESSION['errors']['new_message'] = false;
}


function checkMessageValidity(){
	if (!empty($_POST['new_message'])) {
		;//good, its not empty, we can move on
	} else {
		$_SESSION['errors']['new_message'] = 'empty';
		header("Location: home.php");
	}
}

function addMessageToDatabase(){

	$userId = $_SESSION['userid'];
	$message = $_POST['new_message'];

	//run escape_this_string to protect against malicious sql injection
	$message = escape_this_string($message);

	$query = "

		INSERT INTO `wall`.`messages`
			(
			`user_id`,
			`message`,
			`created_at`,
			`updated_at`)
		VALUES
		(
			'".$userId."',
			'".$message."',
			NOW(),
			NOW()
		);";

	$result = run_mysql_query($query);

	echo "here";
	die();

	header("Location: home.php");
}

?>