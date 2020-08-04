<?php

	include_once('connection.php');
	$id = $_POST['id'];
	$query = "DELETE FROM comment WHERE id=$id";
	pg_query($dbConnection, $query);