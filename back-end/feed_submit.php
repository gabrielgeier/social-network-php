<?php

session_start();

if (isset($_POST['submit'])){

	include_once('connection.php');
	$title = pg_escape_string($dbConnection, $_POST['title']);
	$body = pg_escape_string($dbConnection, $_POST['body']);
	$id = $_SESSION['id'];

	if (empty($body) || empty($title)) {
		header('Location: ../logged/index.php?handlers&empty-feed');
		exit();
	}else{
		$query = "INSERT INTO feed (title, body, user_id) VALUES ('$title', '$body', '$id')";

		pg_query($dbConnection, $query);

		header('Location: ../logged/index.php?user_feed');
	}

}else{
	header('Location: ../logged/index.php?user_feed');
}


