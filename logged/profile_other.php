<?php

	$userId = $_GET['id'];
	$personId = $_GET['p_id'];

	$_SESSION['other_id'] = $userId;
	$_SESSION['other_p_id'] = $personId;

	include_once('../back-end/connection.php');
	
	if ($userId === $_SESSION['id']) {
		header('Location: index.php?profile_view');
		exit();
	}

	$query = "SELECT u.username, u.email, u.active, p.first_name, p.last_name, p.city, to_char(p.birth_date, 'dd/mm/YYYY') AS birth_date, p.gender, p.id, c.name AS country_name, pt.thought, pt.biography FROM usr u JOIN person p ON '$userId'=p.user_id LEFT JOIN country c ON c.id=p.country_id JOIN profile_texts pt ON pt.user_id='$userId' WHERE u.id='$userId'LIMIT 1;";
	
	$result = pg_query($dbConnection, $query);
	$data = pg_fetch_assoc($result);

	if ($data['active']==f) {
		header("Location: ../logged/index.php?handlers&active-false");
		exit();
	}

	$_SESSION['other_biography'] = $data['biography'];
	$_SESSION['other_thought'] = $data['thought'];

	echo '<link rel="stylesheet" type="text/css" href="../css/profile.css?'.mt_rand().'">
	<div class="profile-window">';

	echo "<img class='image-box'";
	include ("../back-end/profile_image_other.php");
	echo "<div class='username-box'>
		  <form class='friend' action='../back-end/friend_action.php?other_id=".$_SESSION['other_id']."' method='POST'>";
	include_once('../back-end/friend_submit.php');
	echo "</form>
		  <p style='margin-top:-15px;'>". $data['username']. "</p></div>";
		
	echo '<div class="profile-thought">';
		
			echo "<p>";
			include_once('../back-end/thought_other.php');
			echo "</p><br><br><br>";	
		
	echo '</div>


	<div class="person-window"><div class="person-border"></div>';
		
	echo "<p><b>Nome</b>: ". $data['first_name']. " ". $data['last_name']. "</p>";
	echo "<p><b>Gênero</b>: ". $data['gender']. "</p>";
	echo "<p><b>Data de Nascimento</b>: ". $data['birth_date']. "</p>";
	echo "<p><b>E-mail</b>: ". $data['email']. "</p>";
	echo "<p><b>Endereço</b>: ". $data['city']. ", ". $data['country_name']. "</p>";
		
	echo '</div>

	<div class="person-links">';
		
	echo '	<li><a href="index.php?friend_list_other&otherId='. $_SESSION['other_id']. '&otherFirst='.$data['first_name']. '">Amigos</a></li>
			<li><a href="index.php?stats_other&id='.$_SESSION['other_id']. '&otherFirst='.$data['first_name']. '">Estatísticas</a></li>
			<li><a href="index.php?other_favorites&id='.$_SESSION['other_id']. '&otherFirst='.$data['first_name']. '">Favoritos</a></li>
			<li><a href="index.php?other_feed&id='. $_SESSION['other_id']. '&otherFirst='.$data['first_name'].'">Posts</a></li>
			<li><a href="index.php?other_books&otherId='. $_SESSION['other_id']. '&otherFirst='.$data['first_name']. '">Obras</a></li>';
	echo '</div>

	<div class="person-biography">
		<h1>Biografia</h1>
		<p>';include_once('../back-end/biography_other.php'); echo '</p>
	</div>

</div>';