<link rel="stylesheet" type="text/css" href="../css/jquery.ultraselect.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery.ultraselect.js" type="text/javascript"></script>
<script src="../js/js.ultraselect.js" type="text/javascript"></script>

<?php

include_once('../back-end/connection.php');

$bookId = $_GET['bookId']; 
$_SESSION['book_id'] = $bookId;

$query = "SELECT DISTINCT b.id AS book_id, b.active, b.metadata_id AS metadata_id, m.title, to_char(m.upload_date, 'dd/mm/YYYY  HH:MI:SS') as upload_date, m.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, m.synopsis, m.comments, m.publication_date FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id WHERE b.id='$bookId' GROUP BY b.id, m.id, ge.genre, la.language";

$result = pg_query($dbConnection, $query);
$data = pg_fetch_assoc($result);

if ($data['active']==f) {
	header("Location: ../logged/index.php?handlers&book-deleted");
	exit();
}

$authorCheck = explode(", ", $data['authors']);

if (!in_array($_SESSION['username'], $authorCheck)) {
	header('Location: index.php?book_info_viewr&bookId='.$data['book_id']);
	exit();
}

echo '

<link rel="stylesheet" type="text/css" href="../css/profile.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<div class="profile-window">

<img class="cover-box"';

include ("../back-end/book_file_upload.php");

echo '<h1 id="title">'. $data['title'].'</h1>';

echo "<div id='edit' class='buttons'>";

echo '<div id="option"><a id="options" href="index.php?book_action_view&bookId='.$data['book_id'].'">Visualizar</a></div>';

echo '<div id="option"><a id="options" href="index.php?book_language_edit&bookId='.$data['book_id'].'">Idioma</a></div>';

echo '<div id="option"><a id="options" href="index.php?book_image_edit&bookId='.$data['book_id'].'">Imagem</a></div>';

echo '<div id="option"><a id="options" href="index.php?book_delete&bookId='.$data['book_id'].'">Excluir</a></div>';

echo '<div id="option"><a id="options" href="index.php?book_info_view&bookId='.$data['book_id'].'">Voltar</a></div>';

echo "</div>";
echo "<form action='../back-end/book_edit.php?bookId=".$bookId."&metadataId=".$data['metadata_id']."' method='POST'>";
echo '<div class="book-window" id="edit"><div class="person-border"></div>';
echo "<p><b>Título</b>: <input required class='transparent' type='text' name='title' id='edit-title' value='". $data['title']. "'></p>";
echo "<p><b>Autores</b>: <input required class='transparent' type='text' name='authors' id='edit-authors' value='". $data['authors']. "'></p>";
echo '<p><b>Gênero(s)</b>: 
		<span id="select"><select required id="control_1" name="control_1[]" multiple="multiple" style="margin-bottom:-10px;">';
		  	include_once('book_genre_select.php');
echo '  </span></select> 
</p>';
echo "<p><b>Data de Publicação Global</b>: <input class='transparent' type='date' name='date' id='edit-date' value='". $data['publication_date']. "'></p>";

if ($data['complete']==t) {
	echo '<p style="margin-top:6px;"><b>Livro na Íntegra</b>: 
        <span id="options"><input type="radio" name="full" id="edit-complete" value="1" checked> <label for="edit-complete" id="full2">Sim</label> 
        <input type="radio" name="full" id="edit-incomplete" value="0"> <label for="edit-incomplete" id="full2">Não</label></p></span>';
}else{
	echo '<p style="margin-top:6px;"><b>Livro na Íntegra</b>: 
        <span id="options"><input type="radio" name="full" id="edit-complete" value="1"> <label for="edit-complete" id="full2">Sim</label> 
        <input type="radio" name="full" id="edit-incomplete" value="0" checked> <label for="edit-incomplete" id="full2">Não</label></p></span>';
}

echo "</div>";

echo '<div class="book-text-box">
	<h1>Sinopse</h1>
	<p>';
	echo '<textarea id="book-edit" name="synopsis" cols="45" rows="5">'. $data['synopsis'].'</textarea>';
echo '</p>
</div>';

echo '<div class="book-text-box" id="comments">
	<h1>Comentários do(s) autor(es)</h1>
	<p>';
	echo '<textarea id="book-edit" name="comments" cols="45" rows="5">'. $data['comments'].'</textarea></p>';

echo "
</div><button type='submit' name='submit-edits'>Salvar Alterações</button></form></div>";