<?php

	include_once('../back-end/book_redirect.php');

?>

<link rel="stylesheet" type="text/css" href="../css/jquery.ultraselect.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<div class= "window" id="small" style="margin-top: 80px;">
	<img src="../images/large_icon.png" class="logo" id="bottom">
	<a class="minimizer" href="index.php">_</a>

	<p id="center2">Adicionar outro Idioma</p> 

    <?php echo "<form action='../back-end/book_file_upload.php?languageId='". $_SESSION['language_id']." method='POST' enctype='multipart/form-data'>"; ?>
	    <p title="Você poderá adicionar outros idiomas depois" id="center">Idioma</p>
	    <select name="language"  id="center" title="Você poderá adicionar outros idiomas depois" required>
		  <?php
		  	include_once('../back-end/language_select.php');
		  ?>
		</select> 
	<div class="book-upload">
		<label id="book" for="file">Procurar Arquivo PDF</label>
		<input id="file" type='file' name='file' style="display:none;"/><br>
		<input type='submit' name="upload" value="Upload"></input>
	</div>
	<div class="submit" id="top">
		<input type="submit" name="next" value="Próximo">
		<!--<input type='submit' name="next" value="Upload"></input>-->
		<input type="submit" name="cancel" value="Cancelar" id="cancel">
	</div>
	</form>

</div>