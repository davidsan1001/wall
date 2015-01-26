<?php

	session_start();

	if (!isset($SESSION['logged_in'])) {
	 	//we have an active session, stay here
	} else {
		//no active session, go to login page
		header("Location: login.php");
	}

	$userId = $_SESSION['userid'];

	$fullname = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
	$loginHTML = "<div class='fullname'>Welcome $fullname!</div><form action='logout.php' method='post'><input type='submit' value='Logout'></form>";

 ?>

 <html>
 <head>
 	<title>Home - Wall</title>

 	<style type="text/css">

 	#container{
 		margin: 0 auto;
 		width: 780px;
 		height: 700px;
 		background-color: white;
 		font-family: sans-serif;
 	}

 	#header{
 		height: 50px;
 		background-color: white;
 		border: 2px solid black;
 	}

 	div.title{
 		display: inline-block;
 		vertical-align: top;
 		font-size: 24px;
 		font-weight: bold;
 		margin-top: 15px;
 		margin-left: 25px;
 	}	

 	div.fullname{
 		display: inline-block;
 		vertical-align: top;
 		margin: 0;
 		padding: 0;
 		margin-left: 220px;
 		margin-top: 30px;
 	}

 	form[action="logout.php"]{
 		display: inline-block;
 		vertical-align: top;
 		margin-left: 90px;
 		margin-top: 30px;
 	}

 	#addMessage{
 		display: block;
 		background-color: white;
 		width: 780px;
 	}

 	#addMessage p{
 		display: inline-block;
 		margin: 0;
 		padding: 0;
 		width: 700px;
 		margin-top: 20px;
 		margin-left: 60px;
 	}

 	#addMessage form{
 		display: inline-block;
 		width: 700px;
 		height: 70px;
 	}

 	#addMessage form input[type="textArea"]{
 		display: inline-block;
 		width: 640px;
 		height: 45px;
 		border: 1px solid black;
 		margin-left: 60px;
 	}

 	#addMessage form input[type="submit"]{
 		background-color: blue;
 		color: white;
 		margin-top: 5px;
 		margin-left: 603px;
 	}

 	ul#messages{
 		margin-left: 35px;
 	}

 	ul#messages li{
 		/*margin-left: 35px;*/
 		/*background-color: purple;*/
 		margin: 5px;
 	}

 	ul#messages form {
 		width: 640px;
 		height: 52px;
 		/*background-color: purple;*/
 	}

 	ul#messages form input[type="textarea"]{
 		width: 595px;
 		height: 45px;
 		border: 1px solid black;
 		margin-left: 25px;
 	}

 	ul#messages form input[type="submit"]{
 		margin-top: 5px;
 		margin-left: 517px;
 		background-color: green;
 		color: white;
 	}

 	ul#messages li p{
 		margin: 0;
 		padding: 0;
 		font-size: 14px;
 	}

 	ul#messages li p.message_namedate{
 		
 	}

 	ul#messages li p.message_text{
 		margin-top: 10px;
 		margin-left: 20px;
 	}

 	</style>
 </head>
 <body>

 	<div id="container">
 		<div id="header">
 			<div class="title">CodingDojo Wall</div>
 			<?= $loginHTML ?>
 		</div>
 		<div id="addMessage">
 			<p>Post a Message</p>
 			<form action="addNewMessage.php" method="post">
 				<input type="textarea" name="new_message">
 				<input type="submit" value="Post a Message">
 			</form>
 		</div>

 		<?php 
 			 include('displayMessages.php');
 		 ?>

 		

 		<!-- <ul id="messages">
		    <li>Message 1</li>
		    <form action="addComment.php" method="post">
		        <input type="textarea" name="new_comment"><br>
 				<input type="submit" value="Post a Comment">
 				<input type="hidden" name="message_id" value"231">
		    </form>
		    <li>Message 2 with comments:
		        <ul class="comments">
		            <li class="comment">Comment 1 on Message 2</li>
		            <li class="comment">Comment 2 on Message 2</li>
		        </ul>
		    </li>
		    <form action="addComment.php" method="post">
		        <input type="textarea" name="new_comment"><br>
 				<input type="submit" value="Post a Comment">
 				<input type="hidden" name="message_id" value"231">
		    </form>
		    <li>Message 3
		    </li>
		    <form action="addComment.php" method="post">
		        <input type="textarea" name="new_comment"><br>
 				<input type="submit" value="Post a Comment">
 				<input type="hidden" name="message_id" value"231">
		    </form>
		</ul> -->



 	</div>
 
 </body>
 </html>