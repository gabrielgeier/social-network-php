<?php

session_start();

if (isset($_POST['submit-thought'])){

	if ($_SESSION['other_id']===-1) {
			$id = $_SESSION['id'];
	}else{
		$id = $_SESSION['other_id'];
		$_SESSION['other_id'] = -1;
	}
		
	include_once('connection.php');
	$thought = pg_escape_string($dbConnection, $_POST['thought']);

	$_SESSION['thought'] = $thought;

	$query= "UPDATE profile_texts SET thought='$thought' WHERE user_id='$id';"; 
	pg_query($dbConnection, $query);
	header("Location: ../logged/index.php?profile_view");

}else{
	
	$thought = $_SESSION['thought'];
	
	if (!$thought){
		echo "\"All we have to decide is what to do with the time that is given us.\" - Tolkien";
	}else{
		echo $thought;
}
}