<?php echo '<link rel="stylesheet" type="text/css" href="../css/stats.css?'.mt_rand().'">'; ?>

<style type="text/css">
	
</style>

<div class="window">

<?php

	include_once('../back-end/connection.php');

	$bookId = $_GET['bookId'];
	$query = "WITH selectBook AS (SELECT DISTINCT b.id AS book_id, m.title, to_char(m.upload_date, 'dd/mm/YYYY  HH:MI:SS') as upload_date, CASE WHEN m.complete=false THEN 'Não' ELSE 'Sim' END AS complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, m.synopsis, m.comments, to_char(m.publication_date, 'dd/mm/YYYY') as publication_date FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id WHERE b.id=$bookId GROUP BY b.id, m.id, ge.genre, la.language), selectViews AS (SELECT CASE WHEN COUNT(v.id) IS NULL THEN 0 ELSE COUNT(v.id) END AS views FROM book b JOIN view v ON v.book_id=b.id WHERE b.id=$bookId), selectDownloads AS (SELECT CASE WHEN COUNT(d.id) IS NULL THEN 0 ELSE COUNT(d.id) END AS downloads FROM book b JOIN download d ON d.book_id=b.id WHERE b.id=$bookId), selectTotal AS (SELECT CASE WHEN sd.downloads IS NULL THEN sv.views WHEN sv.views IS NULL THEN sd.downloads WHEN sd.downloads IS NULL AND sv.views IS NULL THEN 0 ELSE sd.downloads + sv.views END AS both FROM selectDownloads sd, selectViews sv), selectRate AS (SELECT COUNT(book_id) AS rate_count, CASE WHEN ROUND(AVG(value)::numeric,2) IS NULL THEN 0 ELSE ROUND(AVG(value)::numeric,2) END AS rate_avg FROM rate WHERE book_id=$bookId), selectComments AS (SELECT COUNT(book_id) AS comments_count FROM comment WHERE book_id=$bookId), selectFavorites AS (SELECT CASE WHEN COUNT(book_id)=1 THEN COUNT(book_id)::text || ' vez' ELSE COUNT(book_id)::text || ' vezes' END AS favorites FROM favorite WHERE book_id=$bookId) SELECT * FROM selectBook, selectDownloads, selectViews, selectTotal, selectRate, selectComments, selectFavorites";
	$result = pg_query($dbConnection, $query);
	$data = pg_fetch_assoc($result);

	echo '<h1>Estatísticas</h1>

		<ul>
			<li><b>Título</b>: '.$data['title'].'</li><br>
			<li><b>Autores</b>: '.$data['authors'].'</li><br>
			<li><b>Gêneros</b>: '.$data['genre'].'</li><br>
			<li><b>Idiomas</b>: '.$data['language'].'</li><br>
			<li><b>Íntegra</b>: '.$data['complete'].'</li><br>
			<li><b>Data de Upload</b>: '.$data['upload_date'].'</li><br>
			<li><b>Data de Publicação Global</b>: '.$data['publication_date'].'</li><br>
			<li><b>Visualizações</b>: '.$data['views'].'</li><br>
			<li><b>Downloads</b>: '.$data['downloads'].'</li><br>			
			<li><b>Visualizações + downloads</b>: '.$data['both'].'</li><br>
			<li><b>Comentários</b>: '.$data['comments_count'].'</li><br>
			<li><b>Favoritado</b>: '.$data['favorites'].'</li><br>
			<li><b>Avaliações</b>: '.$data['rate_count'].'</li><br>
			<li><b>Média das Avaliações</b>: '.$data['rate_avg'].'</li><br>
		</ul>

	</div>';