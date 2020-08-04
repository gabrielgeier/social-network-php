<?php echo '<link rel="stylesheet" type="text/css" href="../css/feed.css?'.mt_rand().'">'; ?>

<?php

	$id = $_SESSION['id'];
	include_once('../back-end/connection.php');
	$search = "SELECT DISTINCT fe.date, u.username, u.id, p.id as p_id, fe.title, fe.body, to_char(fe.date, 'dd/mm/YYYY  HH:MI:SS') as formatted_date FROM usr u JOIN feed fe ON fe.user_id=u.id JOIN person p ON p.user_id=u.id JOIN friend fr ON (fr.sended_user_id=u.id OR fr.received_user_id=u.id) WHERE (fr.sended_user_id='$id' or fr.received_user_id='$id') AND status=true ORDER BY fe.date DESC";
	$result = pg_query($dbConnection, $search);
	$resultCheck = pg_num_rows($result);

	if ($resultCheck > 0) {
		echo "<div class='feed-container'>";
			echo "<h1 id='bigger'>Seu Feed:</h1>";
		while ($data = pg_fetch_assoc($result)) { 
			$newBody = str_replace("\n","<p>",nl2br($data['body']));
			echo "<div class='feed-result'>";
			echo "<div id='date'><p id='date'>".$data['formatted_date']. "</p></div>";
			echo "<p id='username'><b>Por</b>: <a href='index.php?profile_other&id=".$data['id']. "&p_id=". $data['p_id']."'>".$data['username']."</a></p>";
			echo "<h1>".$data['title']. "</h1>";
			echo "<p id='body'>".$newBody."</p>";
			echo "</div>";
		}
		echo "</div>";
	}else{
		echo "<div class='feed-container' id='no-results'><h1>Você não tem novas notícias!</h1></div";
	}