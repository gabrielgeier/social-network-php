<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<div class= "window" id="small" style="margin-top: 80px;">
	<img src="../images/large_icon.png" class="logo" id="bottom">
	<a class="minimizer" href="index.php">_</a>

    <?php echo "<form action='../back-end/book_download.php?bookId=".$_GET['bookId']."' method='POST' enctype='multipart/form-data'>"; ?>
	    <p id="center" style="font-size: 16pt;margin-top: -20px;">Idioma</p>
	    <select name="language"  id="center" required>
		  <?php
		  	include_once('../back-end/language_select_specific.php');
		  ?>
		</select> 
	<div class="submit" id="top">
		<input type="submit" name="next" value="Download">
		<input type="submit" name="back" value="Voltar" style="margin-left: -40px;">
	</div>
	</form>

</div>