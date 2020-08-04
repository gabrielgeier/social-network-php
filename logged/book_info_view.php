<link rel="stylesheet" type="text/css" href="../css/stars.css">
<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="../js/book_rating.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	    $("#favorite").click(function(){
	    	<?php echo '$("#favorite").load("../back-end/favorite.php?bookId='.$_GET['bookId'].'");';?>
	    });
	});
	
</script>

<?php

include_once('../back-end/connection.php');

$userId = $_SESSION['id'];
$bookId = $_GET['bookId']; 
$_SESSION['book_id'] = $bookId;

$query = "WITH selectBook AS (SELECT DISTINCT b.id AS book_id, b.active, m.title, to_char(m.upload_date, 'dd/mm/YYYY  HH:MI:SS') as upload_date, CASE WHEN m.complete=false THEN 'Não' ELSE 'Sim' END AS complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, m.synopsis, m.comments, to_char(m.publication_date, 'dd/mm/YYYY') as publication_date FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id WHERE b.id=$bookId GROUP BY b.id, m.id, ge.genre, la.language), selectViews AS (SELECT COUNT(v.id) AS views FROM book b JOIN view v ON v.book_id=b.id WHERE b.id=$bookId), selectDownloads AS (SELECT COUNT(d.id) AS downloads FROM book b JOIN download d ON d.book_id=b.id WHERE b.id=$bookId), selectTotal AS (SELECT CASE WHEN sd.downloads IS NULL THEN sv.views WHEN sv.views IS NULL THEN sd.downloads ELSE sd.downloads + sv.views END FROM selectDownloads sd, selectViews sv), selectRate AS (SELECT CASE WHEN ROUND(AVG(value)::numeric,2) IS NULL THEN 'Nenhuma' ELSE ROUND(AVG(value)::numeric,2)::text END AS rate FROM rate WHERE book_id=$bookId), selectComments AS (SELECT COUNT(book_id) AS comments_count FROM comment WHERE book_id=$bookId), selectCheckFav AS (SELECT CASE WHEN (SELECT user_id FROM favorite WHERE user_id=$userId AND book_id=$bookId) IS NULL THEN 'Favoritar' ELSE 'Desfavoritar' END AS selectfav), selectFavCount AS (SELECT CASE WHEN COUNT(book_id)=1 THEN COUNT(book_id)::text || ' vez' ELSE COUNT(book_id)::text || ' vezes' END AS favcount FROM favorite WHERE book_id=$bookId) SELECT * FROM selectBook, selectDownloads, selectViews, selectTotal, selectRate, selectComments, selectCheckFav, selectFavCount";

$result = pg_query($dbConnection, $query);
$data = pg_fetch_assoc($result);

if ($data['active']==f) {
	header("Location: ../logged/index.php?handlers&book-deleted");
	exit();
}

$authorCheck = explode(", ", $data['authors']);

if (in_array($_SESSION['username'], $authorCheck)) {
	$authorCheck = True;
}else{
	$authorCheck = False;
}

echo '

<link rel="stylesheet" type="text/css" href="../css/profile.css">
<link rel="stylesheet" type="text/css" href="../css/book.css?'.mt_rand().'">

<div class="profile-window">

<img class="cover-box"';

include ("../back-end/book_file_upload.php");

echo '<h1 id="title">'. $data['title'].'</h1>';

if ($authorCheck === True) {
	echo "<div id='edit-permission' class='buttons'>";
}else{
	echo "<div class='buttons'>";
}

echo '<div id="option"><a id="options" href="index.php?book_action_view&bookId='.$data['book_id'].'">Visualizar</a></div>';

if ($authorCheck === True) {
	echo '<div id="option"><a id="options" href="index.php?book_info_edit&bookId='.$data['book_id'].'">Modificar</a></div>';
}

echo '<div id="option"><a id="options" href="index.php?book_stats&bookId='.$data['book_id'].'">Estatísticas</a></div>';

echo '<div id="option"><a id="options" href="index.php?book_action_download&bookId='.$data['book_id'].'">Download</a></div>';

echo "</div>";

echo "<div id='stars'>";

include_once('stars.php');

echo "</div>";

echo "<div id='favorite'><a id='favorite-button'>";

echo $data['selectfav'];

echo "</a></div>";

echo "<div id='wraper'>";

echo '<div class="book-window" id="book"><div class="person-border"></div>';
echo "<p><b>Autor(es)</b>: ". $data['authors']. "</p>";
echo "<p><b>Gênero(s)</b>: ". $data['genre']. "</p>";
echo "<p><b>Línguas</b>: ". $data['language']. "</p>";
echo "<p><b>Íntegra</b>: ". $data['complete']. "</p>";
echo "<p><b>Data do Upload</b>: ". $data['upload_date']. "</p>";
echo "<p><b>Data de Publicação Global</b>: ". $data['publication_date']. "</p>";
echo "</div>";

echo '<div class="book-window" id="stats">';
echo "<p><b>Média de Notas</b>: ". $data['rate']. "</p>";
echo "<p><b>Visualizações</b>: ". $data['views']. "</p>";
echo "<p><b>Downloads(s)</b>: ". $data['downloads']. "</p>";
echo "<p><b>Total</b>: ". $data['case']. "</p>";
echo "<p><b>Comentários</b>: ". $data['comments_count']. "</p>";
echo "<p><b>Favoritado</b>: ". $data['favcount']. "</p>";
echo "</div></div>";

echo '<div class="book-text-box">
	<h1>Sinopse</h1>
	<p>';
	if (!$data['synopsis']){
		echo "<p style='text-align:center;text-indent:0px;'>Não há sinopse para essa obra!</p>";
	}else{
		$data['synopsis'] = str_replace("\n","<p>",nl2br($data['synopsis']));
		echo $data['synopsis'];
	}
echo '</p>
</div>';

echo '<div class="book-text-box" id="comments">
	<h1>Comentários do(s) autor(es)</h1>
	<p>';
	if (!$data['comments']){
		echo "<p style='text-align:center;text-indent:0px;'>Não há comentários para essa obra!</p>";
	}else{
		$data['comments'] = str_replace("\n","<p>",nl2br($data['comments']));
		echo $data['comments'];
	}
echo '</p>
</div>';

?>

