<?php

	//query string for finding all comments attached to the given message id
	$query_for_comments = "

		SELECT * FROM comments WHERE message_id = $messageId;
	";

	//runs the query and returns the result
	$result_comments = fetch_all($query_for_comments);

	//start the list of comments for this message
	$htmlOutput = $htmlOutput . '<ul>';

	foreach ($result_comments as $comment_row) {

		//add another comment for this message
		$htmlOutput = $htmlOutput . "<li>";

		//modify to get info from displayCommentNameDate
		include('displayCommentNameDate.php');

		$htmlOutput = $htmlOutput . "<p class='message_text'>" . $comment_row['comment_text'] . "</p>";

		$htmlOutput = $htmlOutput . "</li>";

	}
	//end the list of comments for this message
	$htmlOutput = $htmlOutput . '</ul>';


 ?>