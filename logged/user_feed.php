<?php 
echo '<link rel="stylesheet" type="text/css" href="../css/feed.css?'.mt_rand().'">'; 
echo '<script type="text/javascript" src="../js/jquery.js"></script>';
echo '<script type="text/javascript" src="../js/post_delete.js?'.mt_rand().'"></script>';
?>

<div class='feed-window'>
	<form action="../back-end/feed_submit.php" method="POST">
		<div class="create-post">
			<h1>Poste alguma coisa!</h1>
			<p>Título:</p>
				<input type="text" name="title"><br>
			<p>Corpo:</p>
			<textarea name="body" cols="45" rows="5"></textarea><br>
			<input type="submit" name="submit" value="Postar">
		</div>
	</form>
</div>

<?php

	$id = $_SESSION['id'];
	include_once('../back-end/connection.php');
	$search = "SELECT *, to_char(date, 'dd/mm/YYYY  HH:MI:SS') as formatted_date FROM feed WHERE user_id = '$id' order by date desc";
	$result = pg_query($dbConnection, $search);
	$resultCheck = pg_num_rows($result);

	if ($resultCheck > 0) {
		echo "<div class='feed-container'>";
			echo "<h1 id='bigger'>Seus posts:</h1>";
		while ($data = pg_fetch_assoc($result)) { 
			$newBody = str_replace("\n","<p>",nl2br($data['body']));
			echo "<div class='feed-result'>";
			echo "<div id='delete'><p id='delete' onclick='deletePost(".$data['id'].")'>Excluir</p></div>";
			echo "<div id='date'><p id='date'>".$data['formatted_date']. "</p></div>";
			echo "<h1>".$data['title']. "</h1>";
			echo "<p id='body'>".$newBody."</p>";
			echo "</div>";
		}
		echo "</div>";
	}


?>