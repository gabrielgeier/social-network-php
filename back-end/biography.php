<?php

session_start();

if (isset($_POST['submit-biography'])){

	$id = $_SESSION['id'];
	include_once('connection.php');
	$biography = pg_escape_string($dbConnection, $_POST['biography']);

	$_SESSION['biography'] = $biography;

	$query= "UPDATE profile_texts SET biography='$biography' WHERE user_id='$id';"; 
	pg_query($dbConnection, $query);
	header("Location: ../logged/index.php?profile_view");

}else{
	
	$biography = $_SESSION['biography'];

	if (!$biography){
		echo "<p style='text-align:center;text-indent:0px;'>A biografia ainda não foi adicionada.</p>";
	}else{
		$newBiography = str_replace("\n","<p>",nl2br($biography));
		echo $newBiography;
	}
}