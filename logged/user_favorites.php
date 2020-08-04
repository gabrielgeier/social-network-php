<link rel="stylesheet" type="text/css" href="../css/search.css">

<div class="person-result-window">

<?php

	include_once('../back-end/connection.php');
	$userId = $_SESSION['id'];
	$query = "SELECT DISTINCT bo.id AS book_id, m.title, to_char(m.upload_date, 'dd/mm/YYYY  HH:MI:SS') as upload_date, m.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN (SELECT f.book_id AS id FROM book b JOIN favorite f ON f.book_id=b.id WHERE b.active=TRUE AND f.user_id=$userId) bo ON bo.id=b.id AND b.id=a.book_id AND u.id=a.user_id GROUP BY bo.id, m.id, ge.genre, la.language ORDER BY m.title";

	$result = pg_query($dbConnection, $query); 
	$checkQueryResult = pg_num_rows($result);

	if($checkQueryResult > 0){

		echo "<h1>Favoritos: ".$checkQueryResult. "</h1>";

		while($data = pg_fetch_assoc($result)){

			if ($data['complete']===t) {
				$complete = 'Sim';
			}else{
				$complete = 'Não';
			}

			$date = explode(' ', $data['current_date']); 

			$_SESSION['book_id'] = $data['book_id'];
			echo "<div class='book'>";
			echo "<div class='article-box'>";
			echo "<a id='book' target='_blank' href='../logged/index.php?book_info_viewr&bookId=".$data['book_id']. "'><img class='image-box'";
			include('../back-end/book_file_upload.php');
			echo "</a><div class='text-area-book'>
					<p><b>Título</b>: ".$data['title']."</p>
				    <p><b>Autores</b>: ".$data['authors']."</p>
				    <p><b>Línguas</b>: ".$data['language']."</p>
				    <p><b>Gêneros</b>: ".$data['genre']."</p>
				    <p><b>Upload</b>: ".$data['upload_date']."</p>
				    <p><b>Íntegra</b>: ".$complete."</p>
			      </div></div>";
			echo "</div>";
			$_SESSION['book_id'] = -1;
			
		}

	}else{
		echo "<h1 class='no-results'>Você não tem livros adicionados aos favoritos!</h1>";
	}