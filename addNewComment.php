<?php 
	//html for form which allows adding a new comment
	session_start();

	//var_dump($_POST);

	require('connection.php');

	if (isset($_POST['new_comment'])) {

	checkCommentValidity();
	addCommentToDatabase();

} else {

	$_SESSION['errors']['new_comment'] = false;
}

function checkCommentValidity(){

	if (!empty($_POST['new_comment'])) {
		;//good, its not empty, we can move on
	} else {
		$_SESSION['errors']['new_comment'] = 'empty';
		header("Location: home.php");
	}
}

function addCommentToDatabase(){

	$messageId = $_POST['messageId'];
	$userId = $_SESSION['userid'];
	$comment = $_POST['new_comment'];

	//run escape_this_string to protect against malicious sql injection
	$comment = escape_this_string($comment);

	$query = "

		INSERT INTO `wall`.`comments`
			(
			`message_id`,
			`user_id`,
			`comment_text`,
			`created_at`,
			`updated_at`)
			VALUES
			(
			'".$messageId."',
			'".$userId."',
			'".$comment."',
			NOW(),
			NOW()
			);";

	$result = run_mysql_query($query);

	header("Location: home.php");

	die();
}


 ?>