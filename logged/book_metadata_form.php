<?php

	include_once('../back-end/book_redirect.php');

?>


<link rel="stylesheet" type="text/css" href="../css/jquery.ultraselect.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery.ultraselect.js" type="text/javascript"></script>
<script src="../js/js.ultraselect.js" type="text/javascript"></script>


<div class= "window" style="margin-top: 80px;">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>
    <h1>Faça Upload de sua Obra!</h1>
    <form class="sign-form" action="../back-end/book_metadata_upload.php" method="POST"">

    	<p>Título<a id="required">*</a></p>
	    <input type="text" name="title" placeholder="Título da Obra" minlenght="1" maxlength="55" required>


        <p title="Separe cada USERNAME por vírgulas">Autor(es)<a id="required">*</a></p>
        <?php
        echo '<input type="text" name="authors" value="'. $_SESSION['username']. ", ".'" minlenght="1" maxlength="232" title="Separe cada USERNAME por vírgulas" required>';
        ?>

        <p>Livro na Íntegra<a id="required">*</a></p> 
        <input type="radio" name="full" id="complete" value="1" checked> <label for="complete">Sim</label><br> 
        <input type="radio" name="full" id="incomplete" value="0"> <label for="incomplete">Não</label><br>


	    <p>Gêneros Literários<a id="required">*</a></p>
	    <select id="control_1" name="control_1[]" multiple="multiple" required>
		  <?php
		  	include_once('../back-end/genre_select.php');
		  ?>
		</select> 

		
		<p title="Você poderá adicionar outros idiomas depois">Idioma<a id="required">*</a></p>
	    <select name="language" title="Você poderá adicionar outros idiomas depois" required>
		  <?php
		  	include_once('../back-end/language_select.php');
		  ?>
		</select> 


        <p title="Caso a obra foi lançada anteriormente em outra plataforma">Data de Lançamento Original</p>
        <input type="date" name="date" title="Caso a obra foi lançada anteriormente em outra plataforma">
        

        <p id="center" title="Sinopse da obra">Sinopse</p>
        <textarea name="synopsis" cols="45" rows="5" title="Sinopse da obra"></textarea>
        

        <p id="center" title="Comentários adicionais, como links e considerações">Comentários</p>
        <textarea name="comments" cols="45" rows="5" title="Comentários adicionais, como links e considerações"></textarea>
        <div class="submit">
		    <input type="submit" name="next" value="Continuar">
		    <input type="submit" name="cancel" value="Cancelar" id="cancel">
		</div>

   	</form>
</div>