<link rel="stylesheet" type="text/css" href="../css/login.css">

<style>
	body{
		background: black;
	}
</style>

<div class= "window" style="margin-top: 80px">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>
    <h1>Informe sua senha!</h1>
    <?php echo '<form action="../back-end/book_delete.php?bookId='.$_GET['bookId'].'" method="POST">'; ?>
    	<p>Senha</p>
	    <input type="password" name="password1" placeholder="Sua Senha" autocomplete="off" required>
	    <p>Novamente</p>
	    <input type="password" name="password2" placeholder="Sua Senha" autocomplete="off" required>
	    <br>
	    <input type="submit" name="submit" value="Deletar o Livro">
   	</form>
</div>