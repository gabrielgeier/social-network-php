<link rel="stylesheet" type="text/css" href="../css/profile.css">

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
			include_once('../back-end/thought.php');
			echo "</p><br><br><br>";	
		?>
	</div>


	<div class="person-window"><div class="person-border"></div>
		<?php
			echo "<p><b>Nome</b>: ". $_SESSION['first']. " ". $_SESSION['last']. "</p>";
			echo "<p><b>Gênero</b>: ". $_SESSION['gender']. "</p>";
			echo "<p><b>Data de Nascimento</b>: ". $_SESSION['birth']. "</p>";
			echo "<p><b>E-mail</b>: ". $_SESSION['email']. "</p>";
			echo "<p><b>Endereço</b>: ". $_SESSION['city']. ", ". $_SESSION['country']. "</p>";
		?>
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
		<p><?php include_once('../back-end/biography.php');?></p>
	</div>

</div>