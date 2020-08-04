<link rel="stylesheet" type="text/css" href="../css/window.css">
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
    <form action="../back-end/delete_account.php" method="POST">
    	<p>Senha</p>
	    <input type="password" name="password1" placeholder="Sua Senha" autocomplete="off">
	    <p>Novamente</p>
	    <input type="password" name="password2" placeholder="Sua Senha" autocomplete="off">
	    <br>
	    <input type="submit" name="submit" value="Deletar seu Perfil">
   	</form>
</div>