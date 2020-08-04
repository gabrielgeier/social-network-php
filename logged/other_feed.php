
<link rel="stylesheet" type="text/css" href="../css/feed.css">

<?php

	$id = $_GET['id'];
	$first = $_GET['otherFirst'];
	include_once('../back-end/connection.php');
	$search = "SELECT fe.title, fe.body, to_char(fe.date, 'dd/mm/YYYY  HH:MI:SS') as formatted_date FROM usr u JOIN feed fe ON fe.user_id=u.id WHERE fe.user_id='$id' AND u.active=TRUE ORDER BY fe.date DESC";
	$result = pg_query($dbConnection, $search);
	$resultCheck = pg_num_rows($result);

	if ($resultCheck > 0) {
		echo "<div class='feed-container'>";
			echo "<h1 id='bigger'>Posts de ".$first.":</h1>";
		while ($data = pg_fetch_assoc($result)) { 
			$newBody = str_replace("\n","<p>",nl2br($data['body']));
			echo "<div class='feed-result'>";
			echo "<div id='date'><p id='date'>".$data['formatted_date']. "</p></div>";
			echo "<h1>".$data['title']. "</h1>";
			echo "<p id='body'>".$newBody."</p>";
			echo "</div>";
		}
		echo "</div>";
	}else{
		echo "<div class='feed-container'>";
			echo "<br><h1 id='bigger' style='margin:auto;'>".$first." ainda não postou nada!</h1>";
		echo "</div>";
	}