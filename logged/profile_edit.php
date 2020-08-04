<link rel="stylesheet" type="text/css" href="../css/profile.css">
<link rel="stylesheet" type="text/css" href="../css/profile_edit.css">

<div class="profile-window">

	<?php
		echo "<img class='image-box'";
		include ("../back-end/profile_image.php");
		echo "<div class='username-box'><p>". $_SESSION['username']. "</p></div>";

		//echo $_SESSION['username'];
	?>
	<div class="profile-thought">
		<?php
			echo "<p>";
			$string = include_once('../back-end/thought.php');
			echo "</p><br><br><br>";	
		?>
		<form action='../back-end/thought.php' method='POST'>
			<input id="thought" type="text" name="thought" placeholder=" " minlenght="1" maxlength="164">
			<input id="submit-thought" type="submit" name="submit-thought" value="Salvar Pensamento">
		</form>
	</div>


	<br><br><br><br><br>
	
	<form action='../back-end/profile_image.php' method='POST' enctype='multipart/form-data'> 
		<label id="imagem" for="file">Procurar Imagem</label>
		<input id="file" type='file' name='file' style="visibility:hidden;">
		<input type='submit' id="submit-image" id="image" name="submit-image" value="Upload"></input>
	</form>

	<div class="person-window"><div class="person-border"></div>
		<form action="../back-end/edit_user_informations.php" method='POST'>
			<p>Nome: <input class="transparent" type="text" name="first" id="first" minlength="1" maxlength="18" value="<?php echo $_SESSION['first']?>"></input></p>
			<p>Sobrenome: <input class="transparent" type="text" name="last" id="last" minlength="1" maxlength="18" value="<?php echo $_SESSION['last']?>"></input></p>
			<p>Gênero:<br><br> 
				<?php 
					include_once('../back-end/gender.php');
				?>
            </p>
            <p>Data de Nascimento: <input class="transparent" type="date" name="date" id="date" value="<?php echo $_SESSION['unformatted_birth_date'] ?>"></p>
            <p>País: <?php include_once('../welcome/country-select.php');?></p>
            <p>Cidade: <input class="transparent" id="city" type="text" name="city" maxlength="100" value="<?php echo $_SESSION['city'] ?>"></p> 
            <p>E-mail:<input class="transparent" type="email" name="email" id="email" minlenght="1" maxlength="63" value="<?php echo $_SESSION['email'] ?>"></p>
            <input type='submit' id="submit-user-informations" name="submit-user-informations" value="Salvar Alterações"></input>
		</form>
	</div>

	<div class="person-links">
		<li><a href="index.php?friend_list_user">Amigos</a></li>
		<li><a href="index.php?my_stats">Estatísticas</a></li>
		<li><a href="index.php?user_favorites">Favoritos</a></li>
		<li><a href="index.php?friends_feed">Feed</a></li>
		<li><a href="index.php?my_books">Obras</a></li>
	</div>

	<div class="person-biography">
		<h1>Biografia</h1>
		<form action="../back-end/biography.php" method='POST'>
			<?php $biography = $_SESSION['biography'];?>
			<textarea name="biography" cols="45" rows="5"><?php echo $biography;?></textarea>
			<input type='submit' id="submit-biography" name="submit-biography" value="Salvar Biografia"></input>
		</form>
	</div>

</div>