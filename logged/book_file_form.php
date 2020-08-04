<?php

	include_once('../back-end/book_redirect.php');

?>

<link rel="stylesheet" type="text/css" href="../css/jquery.ultraselect.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<div class= "window" style="margin-top: 80px;">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>
    <h1>Faça Upload de sua Obra!</h1>

    <div class="book-upload">

    <?php echo "<form action='../back-end/book_file_upload.php?languageId=". $_SESSION['language_id']."' method='POST' enctype='multipart/form-data'>"; ?>
		<label id="book" for="file">Procurar Arquivo PDF</label>
		<input id="file" type='file' name='file' style="display:none;"/><br>
	</div>
	<div class="submit">
		<input type='submit' name="upload" value="Upload"></input>
		<input type="submit" name="cancel" value="Cancelar" id="cancel">
	</div>
	</form>

</div>
	