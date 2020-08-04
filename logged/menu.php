<header class="menu-fixed">
	<div></div><nav class="clearfix">
		<ul>
			<li id="right"><a id="right" href="../back-end/logout.php">Sair</a></li>
			<div class="collapse">
				<li id="right" class="hover-none"><a id="right">Perfil</a>
					<ul>
						<li id="l1"><a href="../logged/index.php?profile_view">Ver</a></li><br>
						<li id="l2" class='border-bottom'><a href="../logged/index.php?profile_edit">Editar</a></li><br>
						<li id="l3"><a href="../logged/index.php?user_feed">Posts</a></li><br>
						<li id="l2"><a href="../logged/index.php?delete_form" style="font-size: 13.5pt;">Excluir</a></li>
					</ul>
				</li>
			</div>
			<div class="collapse">
				<li id="right" class="hover-none"><a id="right">Pesquisar</a>
					<ul>
						<li id="l1"><a href="../logged/index.php?search_form-person">Pessoas</a></li><br>
						<li id="l2"><a href="../logged/index.php?search_form-library">Biblioteca</a></li>
					</ul>
				</li>
			</div>
			<div class="collapse">
				<li id="right" class="hover-none"><a id="right">Amigos</a>
					<ul>
						<li id="l1"><a href="../logged/index.php?friends_feed">Feed</a></li><br>
						<li id="l1"><a href="../logged/index.php?friend_list_user">Lista</a></li><br>
						<li id="l2"><a href="../logged/index.php?friend_requests">Pedidos</a></li>
					</ul>
				</li>
			</div>
			<div class="collapse">
				<li id="right" class="hover-none"><a id="right">Biblioteca</a>
					<ul>
						<li id="l1"><a href="../logged/index.php?my_books">Meus</a></li><br>
						<li id="l2"><a href="../logged/index.php?book_metadata_form">Submeter</a></li><br>
						<li id="l2"><a href="../logged/index.php?search_form-library">Pesquisar</a></li><br>
						<li id="l2"><a href="../logged/index.php?user_favorites">Favoritos</a></li>
					</ul>
				</li>
			</div>
			<div class="collapse">
				<li id="right" class="hover-none"><a id="right">Ranking</a>
					<ul>
						<li id="l1"><a href="../logged/index.php?ranking_authors">Autores</a></li><br>
						<li id="l2"><a href="../logged/index.php?ranking_genres">Gêneros</a></li><br>
						<li id="l2"><a href="../logged/index.php?ranking_languages">Idiomas</a></li><br>
						<li id="l1"><a href="../logged/index.php?ranking_books">Livros</a></li>
					</ul>
				</li>
			</div>
			<li id="left"><a id="left" href="../logged/index.php?profile_view">&nbsp Olá,  
				<?php 
					echo $_SESSION['username']. "!";
				?>	
			</a></li>
		</ul>
		<?php 
			echo '<a id="reset" href="../logged/index.php?profile_view">';
			echo "<img class='profile-image'";
				include_once ("../back-end/profile_image.php"); 
			echo '</a>';				
		?>
	</nav>
</header>