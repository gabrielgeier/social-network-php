<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("Location: ../welcome/index.php");
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>FreeWriters</title>
	<link rel="stylesheet" type="text/css" href="../css/style_logged.css">
	<link rel="stylesheet" type="text/css" href="../css/window.css">
	<link rel="stylesheet" type="text/css" href="../css/logged.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="FreeWriters social network">
	<meta name="keywords" content="FreeWriters, FW, social network, books">
	<meta name="author" content="Gabriel Geier">
	<link rel="icon" href="../images/small_icon.png">
</head>
<body>

<br><br>
