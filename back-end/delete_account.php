<?php

session_start();
include_once('connection.php');
 
$userId = $_SESSION['id'];

$query = "SELECT password FROM usr WHERE id=$userId";

$result = pg_query($dbConnection, $query);
$resultCheck = pg_num_rows($result);

$data = pg_fetch_assoc($result);

if ($_POST['password1']==$_POST['password2']) {
	
	if (password_verify($_POST['password1'], $data['password'])) {
		
		$query = "UPDATE usr SET active=FALSE WHERE id=$userId";
		pg_query($dbConnection, $query);

		session_unset();
		session_destroy();

		header('Location: ../welcome/index.php?handlers&account-deleted');

	}else{
		header('Location: ../logged/index.php?handlers&wrong-password-user');
		exit();
	}

}else{
	header('Location: ../logged/index.php?handlers&password-mismatch-user');
	exit();
}	




