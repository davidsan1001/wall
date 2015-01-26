<?php

	require('connection.php');

	//query string for finding all the messages
	$query_for_messages = "select * from messages;";

	//runnign the string and returning the results
	$result_messages = fetch_all($query_for_messages);

	//start the html string for all the entire messages section
	// I do this partly for troubleshooting purposes
	// partly for organizational purposes, its easier to track html going to s string
	// rather that just to an abstract browser window.
	$htmlOutput = '';

	//start the list of messages
	$htmlOutput = $htmlOutput . "<ul id='messages'>";

	foreach ($result_messages as $message_row) {

		//get the message id so its available for name, date, and comments for message
		$messageId = $message_row['id'];

		//add another message
		$htmlOutput = $htmlOutput . "<li>";

		include('displayMessageNameDate.php');

		$htmlOutput = $htmlOutput . "<p class='message_text'>" . $message_row['message'] . "</p>";

		//this will gather all comments for this message id, and do this once for every message
		include('displayComments.php');

		//end this message
		$htmlOutput = $htmlOutput . '</li>';

		//start the form for adding a new comment for the current message
		$htmlOutput = $htmlOutput . '<form action="addNewComment.php" method="post">';

		//add hidden field with message id
		$htmlOutput = $htmlOutput . "<input type='hidden' name='messageId' value='$messageId'>";

		//add hidden field with user id
		$userId = $_SESSION['userid'];
		$htmlOutput = $htmlOutput . "<input type='hidden' name='userId' value='$userId'>";

		//add the text area and submit button
 		$htmlOutput = $htmlOutput . '<input type="textarea" name="new_comment">';
 		$htmlOutput = $htmlOutput . '<input type="submit" value="Post a Comment">';
 			
 		//end the form
		$htmlOutput = $htmlOutput . '</form>';
	}

	//end the list of messages
	$htmlOutput = $htmlOutput . "</ul>";

	// this is all the html from messages and thier comments with thier respective 'add' forms
	echo $htmlOutput;

 ?>

 