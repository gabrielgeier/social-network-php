<?php

	include_once('../back-end/connection.php');
	$bookId = $_GET['bookId'];
	$query = "SELECT u.username, b.active FROM usr u JOIN author a ON u.id=a.user_id JOIN book b ON b.id=a.book_id WHERE b.id='$bookId';";
	$result = pg_query($dbConnection, $query);
	$array = pg_fetch_all($result);

	foreach ($array as $key => $value) {
		if ($array[$key]['active']==f) {
			header("Location: ../logged/index.php?handlers&book-deleted");
			exit();
		}
	}

	$usernames = array_column($array, 'username');
	
	if (!in_array($_SESSION['username'], $usernames)) {
		header('Location: index.php?book_info_viewr&bookId='.$bookId);
		exit();
	}
	
echo '

<link rel="stylesheet" type="text/css" href="../css/jquery.ultraselect.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<div class= "window" id="small" style="margin-top: 80px;">
	<img src="../images/large_icon.png" class="logo" id="bottom">
	<a class="minimizer" href="index.php">_</a>

	<p id="center2" style="font-size:16pt;">Mudar capa</p> ';

     echo "<form action='../back-end/book_files_edit.php?bookId=". $bookId."' method='POST' enctype='multipart/form-data'>"; 
	 
	 echo '
	<div class="book-upload">
		<label id="book" for="file" style="margin-bottom: 10px; margin-top:20px;">Procurar Imagem</label>
		<input id="file" type="file" name="file" style="display:none;"/><br>
	</div>
	
	<div class="submit" id="top">
		<input type="submit" name="upload-image" value="Upload">
		<input type="submit" name="back" value="Voltar" id="cancel">
	</div>
	</form>

</div>';