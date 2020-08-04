<link rel="stylesheet" type="text/css" href="../css/window.css">
<?php echo '<link rel="stylesheet" type="text/css" href="../css/login.css?'.mt_rand().'">'; ?>

<div class= "window">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>
    <h1>Faça seu Login!</h1>
    <form action="../back-end/login.php" method="POST">
    	<p>Username ou E-mail</p>
	    <input type="text" name="username-email" placeholder="Seu Username ou E-mail" autocomplete="off" required>
	    <p>Senha</p>
	    <input type="password" name="password" placeholder="Sua Senha" autocomplete="off" required>
	    <br>
	    <input type="submit" name="submit" value="Login">
   	</form>
</div>