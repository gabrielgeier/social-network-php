
<link rel="stylesheet" type="text/css" href="../css/handlers.css">
<div class="window">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>

	<?php
		(string)$url = "$_SERVER[REQUEST_URI]";

		$bookId = $_GET['bookId'];

		if (strpos($url, "login-success")) {
			echo '<h1>Login efetuado com sucesso!</h1>
					<p>Agora você pode ler e disponibilizar obras, além de poder interagir com outros usuários!</p>';
		}elseif(strpos($url, "book-uploaded")){
			echo "<h1>Livro enviado com sucesso!</h1>
					<p>Agora leitores poderão lê-lo. <a id='clear' href='index.php?book_info_view&bookId=".$_GET['bookId']."'>Clique aqui</a> para visualizá-lo.</p>";
		}elseif(strpos($url, "book-successfully-deleted")){
			echo "<h1>Livro deletado com sucesso!</h1>
					<p>Apartir de agora o seu livro estará indisponível!</p>";
		}elseif(strpos($url, "book-canceled")){
			echo "<h1>Operação cancelada!</h1>
					<p>As alterações foram desfeitas com sucesso!</p>";
		}else{

			echo "<h1>Ocorreu um erro!</h1>";
		
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
			elseif (strpos($url, "empty-feed")) {
				echo "<p>Você esqueceu de preencher o título ou o corpo!</p>";
			}
			elseif (strpos($url, "file-big")) {
				echo "<p>O arquivo selecionado é muito pesado!</p>";
			}
			elseif (strpos($url, "upload-error")) {
				echo "<p>Ocorreu um erro no upload!</p>";
			}
			elseif (strpos($url, "type-error")) {
				echo "<p>Você não pode adicionar arquivos desse formato!</p>";
			}
			elseif (strpos($url, "password-mismatch-user")) {
				echo "<p>As senhas informadas são incompatíveis!</p>";
			}
			elseif (strpos($url, "password-mismatch-book")) {
				echo "<p>As senhas informadas são incompatíveis!<a href='index.php?book_delete&bookId=".$bookId."' id='in-text'> Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "wrong-password-book")) {
				echo "<p>As senhas informadas estão incorretas!<a href='index.php?book_delete&bookId=".$bookId."' id='in-text'> Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "wrong-password-user")) {
				echo "<p>As senhas informadas estão incorretas!</p>";
			}
			elseif (strpos($url, "not-an-author")) {
				echo "<p>Você não é um autor deste livro!</p>";
			}
			elseif (strpos($url, "book-invalid-usernames")) {
				echo "<p>Você digitou caracteres inválidos no campo Autores!</p>";
			}
			elseif (strpos($url, "book-user-existace")) {
				echo "<p>Um ou mais dos usuários informados não existem!</p>";
			}
			elseif (strpos($url, "empty-genre")) {
				echo "<p>Você precisa escolher pelo menos um gênero para seu livro!</p>";
			}
			elseif (strpos($url, "book-option-no")) {
				echo "<p>Parece que você escolheu a opção de não adicionar um idioma! <a href='index.php?book_metadata_form' id='in-text'>Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "edit-genre")) {
				echo "<p>Você precisa escolher pelo menos um gênero para seu livro! <a href='index.php?book_info_edit&bookId=".$bookId."' id='in-text'>Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "edit-authors")) {
				echo "<p>Você digitou caracteres inválidos no campo Autores! <a href='index.php?book_info_edit&bookId=".$bookId."' id='in-text'>Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "edit-user-existace")) {
				echo "<p>Um ou mais dos usuários informados não existem! <a href='index.php?book_info_edit&bookId=".$bookId."' id='in-text'>Clique aqui</a> para voltar!</p>";
			}
			elseif (strpos($url, "active-false")) {
				echo "<p>Esta conta foi deletada!</p>";
			}
			elseif (strpos($url, "book-deleted")) {
				echo "<p>Este livro está indisponível!</p>";
			}
		}
	?>

</div>
