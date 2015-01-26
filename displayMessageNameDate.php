<?php

	$userId = $message_row['user_id'];

 	//query string for getting user information for the person who posted this message
	$query_for_full_name = "

		SELECT * FROM users WHERE id = $userId;
	";

	//runs the query and returns the result
	$result_fullname = fetch_record($query_for_full_name);

	$mysqldate = strtotime($message_row['created_at']);
	$formatteddate = date('F jS Y,  h:i a', $mysqldate);

	$stringFullName = $result_fullname['first_name'] . ' ' . $result_fullname['last_name'];

	$fullNameDateString = $stringFullName . ' &middot; ' . $formatteddate;

	$htmlOutput = $htmlOutput . "<p class='message_namedate'>" . $fullNameDateString . "</p>";


 ?>