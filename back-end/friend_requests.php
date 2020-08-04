<?php

	session_start();

	$id = $_SESSION['id'];
	$otherId = $_GET['id'];

	include_once('connection.php');

	pg_query($dbConnection, $query);

	if (isset($_POST['accept-friendship'])) {

		$query = "UPDATE friend SET status=true WHERE sended_user_id='$otherId' and received_user_id='$id';";
		pg_query($dbConnection, $query);
	
	}elseif (isset($_POST['refuse-friendship'])) {

		$query = "DELETE FROM friend WHERE (sended_user_id='$otherId' AND received_user_id='$id' AND status=false;";
		pg_query($dbConnection, $query);

	}
	
	header('Location: ../logged/index.php?friend_requests');