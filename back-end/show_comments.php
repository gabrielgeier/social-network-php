
<?php

session_start();

include_once('connection.php');

$bookId = $_SESSION['book_id'];
$userId = $_SESSION['id'];
$body = $_POST['body'];

$query = "SELECT c.body, to_char(date, 'dd/mm/YYYY  HH:MI:SS') as date, u.username, u.id, p.id AS p_id, c.id AS comment_id FROM comment c JOIN usr u ON u.id=c.user_id JOIN person p ON p.user_id=u.id JOIN book b ON b.id=c.book_id WHERE b.id='$bookId' ORDER BY c.date DESC;";

$result = pg_query($dbConnection, $query);

$resultCheck = pg_num_rows($result);

if ($resultCheck < 1) {
	echo "<div id='the-comment'>";
	echo "<p id='the-comment'>Não há comentários para essa obra. Seja o primeiro a comentar!</span></p>";
	echo "</div>";
}else{

	while ($data = pg_fetch_assoc($result)) {
		echo "<div id='the-comment'>";
		if ($data['username'] == $_SESSION['username']) {
			echo "<p id='the-comment'><b><a target='_blank' style='color:red; font-weight:bold;' href='index.php?profile_other&id=".$data['id']."&p_id=".$data['p_id']."'>".$data['username']."</b></a>: \"".$data['body']."\" - <span style='color:black'>".$data['date']."</span></p>";
			echo "<button type='button' name='delete' id='delete' onclick='deleteComment(".$data['comment_id'].")' value='".$data['comment_id']."'>Deletar</button>";
		}else{
			echo "<p id='the-comment'><b><a target='_blank' style='color:rgb(33, 67, 100); font-weight:bold;' href='index.php?profile_other&id=".$data['id']."&p_id=".$data['p_id']."'>".$data['username']."</b></a>: \"".$data['body']."\" - <span style='color:black'>".$data['date']."</span></p>";
		}
		echo "</div>";
	}

}

