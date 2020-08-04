<?php echo '<link rel="stylesheet" type="text/css" href="../css/stats.css?'.mt_rand().'">'; ?>

<style type="text/css">
	
</style>

<div class="window">

<?php

	include_once('../back-end/connection.php');

	$userId = $_GET['id'];
	$query = "WITH userViews AS (SELECT CASE WHEN COUNT(v.id) IS NULL THEN 0 ELSE COUNT(v.id) END AS myViews FROM view v WHERE v.user_id=$userId), userDownloads AS (SELECT CASE WHEN COUNT(d.id) IS NULL THEN 0 ELSE COUNT(d.id) END AS myDownloads FROM download d WHERE d.user_id=$userId), userBoth AS (SELECT CASE WHEN d.myDownloads IS NULL THEN v.myViews WHEN v.myViews IS NULL THEN d.myDownloads WHEN v.myViews IS NULL AND d.myDownloads IS NULL THEN 0 ELSE d.myDownloads + v.myViews END AS myBoth FROM userDownloads d, userViews v), userComments AS (SELECT COUNT(c.user_id) AS myComments FROM comment c WHERE c.user_id=$userId), userRates AS (SELECT COUNT(r.user_id) AS myRates, CASE WHEN ROUND(AVG(r.value)::numeric,2) IS NULL THEN 0 ELSE ROUND(AVG(r.value)::numeric,2) END AS myRatesAvg FROM rate r WHERE r.user_id=$userId), userFriends AS (SELECT COUNT(*) AS myFriends FROM friend fr WHERE (fr.sended_user_id=$userId OR fr.received_user_id=$userId) AND fr.status=true), userPosts AS (SELECT COUNT(f.user_id) AS myPosts FROM feed f WHERE f.user_id=$userId), userFavorites AS (SELECT COUNT(user_id) AS myfavorites FROM favorite WHERE user_id=$userId), authorCountBooks AS (SELECT COUNT(a.book_id) AS myBooksCount FROM author a JOIN book b ON b.id=a.book_id WHERE a.user_id=$userId AND b.active=TRUE), authorViews AS (SELECT CASE WHEN COUNT(v.id) IS NULL THEN 0 ELSE COUNT(v.id) END AS myBooksViews FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id WHERE a.user_id=$userId), authorDownloads AS (SELECT CASE WHEN COUNT(d.id) IS NULL THEN 0 ELSE COUNT(d.id) END AS myBooksDownloads FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id WHERE a.user_id=$userId), authorBoth AS (SELECT CASE WHEN sd.myBooksDownloads IS NULL THEN sv.myBooksViews WHEN sv.myBooksViews IS NULL THEN sd.myBooksDownloads WHEN sd.myBooksDownloads IS NULL AND sv.myBooksViews IS NULL THEN 0 ELSE sd.myBooksDownloads + sv.myBooksViews END AS myBooksBoth FROM authorDownloads sd, authorViews sv), authorComments AS (SELECT COUNT(*) AS myBooksComments FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN comment c ON c.book_id=b.id WHERE a.user_id=$userId), authorRates AS (SELECT COUNT(*) AS myBooksRates, CASE WHEN ROUND(AVG(r.value)::numeric,2) IS NULL THEN 0 ELSE ROUND(AVG(r.value)::numeric,2) END AS myBooksRatesAvg FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN rate r ON r.book_id=b.id WHERE a.user_id=$userId), myBooksFavorites AS (SELECT COUNT(f.book_id) AS mybooksfavorites FROM favorite f JOIN book b ON b.id=f.book_id JOIN author a ON a.book_id=b.id WHERE a.user_id=$userId) SELECT * FROM userViews, userDownloads, userBoth, userComments, userRates, userFriends, userPosts, authorCountBooks, authorViews, authorDownloads, authorBoth, authorComments, authorRates, myBooksFavorites, userFavorites";
	$result = pg_query($dbConnection, $query);
	$data = pg_fetch_assoc($result);

	if ($data['active']==f) {
		header("Location: ../logged/index.php?handlers&active-false");
		exit();
	}

	echo '<h1>Estatísticas de '.$_GET['otherFirst'].'</h1>

		<h4>Status dele, como usuário</h4>
		<ul>
			<li>Visualizações:<b> '.$data['myviews'].'</b></li><br>
			<li>Downloads:<b> '.$data['mydownloads'].'</b></li><br>
			<li>Visualizações + downloads:<b> '.$data['myboth'].'</b></li><br>
			<li>Comentários:<b> '.$data['mycomments'].'</b></li><br>
			<li>Avaliações:<b> '.$data['myrates'].'</b></li><br>
			<li>Média das avaliações:<b> '.$data['myratesavg'].'</b></li><br>
			<li>Favoritos:<b> '.$data['myfavorites'].'</b></li><br>
			<li>Posts:<b> '.$data['myposts'].'</b></li><br>
			<li>Amigos:<b> '.$data['myfriends'].'</b></li><br>
		</ul>

		<h4 title="Estatísticas acumuladas de seus livros">Status dele, como autor<a id="question" title="Estatísticas acumuladas de seus livros">?</a></h4>
		<ul>
			<li>Livros cadastrados:<b> '.$data['mybookscount'].'</b></li><br>
			<li>Visualizações:<b> '.$data['mybooksviews'].'</b></li><br>
			<li>Downloads:<b> '.$data['mybooksdownloads'].'</b></li><br>
			<li>Visualizações + downloads:<b> '.$data['mybooksboth'].'</b></li><br>
			<li>Comentários:<b> '.$data['mybookscomments'].'</b></li><br>
			<li>Avaliações:<b> '.$data['mybooksrates'].'</b></li><br>
			<li>Média das avaliações:<b> '.$data['mybooksratesavg'].'</b></li><br>
			<li>Favoritos:<b> '.$data['mybooksfavorites'].'</b></li><br>
		</ul>

	</div>';