<?php

	include_once('connection.php');
	$id = $_POST['id'];
	$query = "DELETE FROM feed WHERE id=$id;";
	pg_query($dbConnection, 'begin;');
	pg_query($dbConnection, $query);
	pg_query($dbConnection, 'commit;');