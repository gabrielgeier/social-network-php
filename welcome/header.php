<?php
	session_start();
	if (isset($_SESSION['username'])) {
		header("Location: ../logged/index.php");
	}else{
		include_once('menu.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>FreeWriters - Bem-Vindo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="FreeWriters social network">
	<meta name="keywords" content="FreeWriters, FW, social network, books">
	<meta name="author" content="Gabriel Geier">
	<?php echo '<link rel="stylesheet" type="text/css" href="../css/style.css?'.mt_rand().'"'; ?>
	<link rel="icon" href="../images/small_icon.png">
</head>
<body>


