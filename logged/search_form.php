<?php
	
	echo '<link rel="stylesheet" type="text/css" href="../css/search.css?'.mt_rand().'">';

	(string)$Url = "$_SERVER[REQUEST_URI]";
  
	if (strpos($Url, "person") == true) {
		echo '  
			  <div class="search-window" style="border: 2px solid white">
				<form class="search" action="index.php?search_result&user" method="POST">
				  <p>Método de Pesquisa:
				  <select name="method" id="method">Método de Pesquisa:
				    <option value="generic">Genérico</option> 
				    <option value="username">Username</option> 
				    <option value="email">E-mail</option> 
				    <option value="first">Nome</option>
				    <option value="last">Sobrenome</option>
				    <option value="first and last">Nome e Sobrenome</option>
				    <option value="birth">Data de Nascimento</option>
				    <option value="country">País</option>
				    <option value="city">Cidade</option>
				  </select></p><br>
				<input type="text" name="search" placeholder="Pesquisa por Usuário">
					<br>
					<input type="submit" name="submit-search" value="Procurar"></input>
				</form>
			  </div>';
	}else{
		echo '  
			  <div class="search-window" style="border: 2px solid white">
				<form class="search" action="index.php?search_result&book" method="POST">
				  <p>Método de Pesquisa:
				  <select name="method" id="method">Método de Pesquisa:
				    <option value="generic">Genérico</option> 
				    <option value="title">Título</option>
				    <option value="synopsis">Sinopse</option>
				    <option value="username">Username</option>   
				    <option value="author-name">Nome do Autor</option> 				    
				  </select></p><br>
				<input type="text" name="search" placeholder="Pesquisa por Obra">
					<br>
					<input type="submit" name="submit-search" value="Procurar"></input>
				</form>
			  </div>';
	}


?>
