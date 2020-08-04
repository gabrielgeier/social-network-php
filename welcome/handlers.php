<link rel="stylesheet" type="text/css" href="../css/window.css">
<link rel="stylesheet" type="text/css" href="../css/handlers.css">
<div class="window">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>

	<?php
		(string)$url = "$_SERVER[REQUEST_URI]";

		if (strpos($url, "success")) {
			echo '<h1>Registro completado com sucesso!</h1>
					<p>Agora você pode logar no site clicando no item "Login" no menu superior, ou por meio deste <a id="in-text" href="index.php?login">link</a>!</p>';
			exit();
		}
		elseif(strpos($url, "account-deleted")){
			echo "<h1>Conta deletada com sucesso!</h1>
					<p>A partir de agora seu perfil estará indisponível!</p>";
		}
		else{
			echo "<h1>Ocorreu um erro!</h1>";
		}

		if (strpos($url, "signup-error")) {
			echo "<p>Falha ao registrar sua conta!</p>";
		}
		elseif (strpos($url, "signup-empty")) {
			echo "<p>Você esqueceu de preencher um ou mais campos!</p>";
		}
		elseif (strpos($url, "signup-invalid-first-last")) {
			echo "<p>Você digitou caracteres inválidos no campo Nome ou Sobrenome!</p>";
		}
		elseif (strpos($url, "signup-email-user")) {
			echo "<p>Já existe um usuário com o mesmo Username ou E-mail!</p>";
		}
		elseif (strpos($url, "signup-invalid-username")) {
			echo "<p>Você digitou caracteres inválidos no campo Username!</p>";
		}
		elseif (strpos($url, "signup-invalid-city")) {
			echo "<p>Você digitou caracteres inválidos no campo cidade!</p>";
		}
		elseif (strpos($url, "missing-fields")) {
			echo "<p>Você não preencheu todos os campos!</p>";
		}
		elseif (strpos($url, "login-error")) {
			echo "<p>Ocorreu um erro ao tentar logar!</p>";
		}
		elseif (strpos($url, "login-password")) {
			echo "<p>A sua senha, ou identificação de usuário, estão incorretas!</p>";
		}
		elseif (strpos($url, "login-no-username-email")) {
			echo "<p>Não existe um usuário com esse Username ou E-mail!</p>";
		}
		elseif (strpos($url, "active-false")) {
			echo "<p>Esta conta foi deletada!</p>";
		}
	?>

</div>
