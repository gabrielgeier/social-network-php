<?php

	include_once('connection.php');

	$limit = $_POST['limit'];
	$orderby = $_POST['orderby'];
	$orderby2 = $_POST['orderby'];

	if ($_POST['filter']=='views') {
		
		echo "<p id='filter'>Mais visualizados ";

		if ($_POST['period']=='day') {
			echo "do dia</p>";
		}elseif ($_POST['period']=='week') {
			echo "da semana</p>";
		}elseif ($_POST['period']=='month') {
			echo "do mês</p>";
		}elseif ($_POST['period']=='year') {
			echo "do ano</p>";
		}elseif ($_POST['period']=='always') {
			echo "desde sempre</p>";
		}

		if ($_POST['order']=='position') {
			$order = 1;
			$order2 = 'row_number';
			
		}else{
			$order= 2;
			$order2= 2;
		}
		
		echo '<table id="books">
			        <tr>
			          <th>#</th>
			          <th>Livro</th>
			          <th>Gêneros</th>
			          <th>Autores</th>
			          <th>Total</th>
			        </tr>';

		if ($_POST['period']=='day') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 day' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.view_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.view_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '7 days' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.view_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.view_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 month' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.view_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.view_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 year' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.view_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.view_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE b.active=TRUE  GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.view_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.view_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?book_info_view&bookId=".$data['book_id']."'>".$data['title']."</a></td>
				    <td>".$data['genre']."</td>
				    <td>".$data['authors']."</td>
				    <td>".$data['view_count']."</td>
				  </tr>";

		}



	}

	elseif ($_POST['filter']=='downloads'){

		echo "<p id='filter'>Mais baixados ";

		if ($_POST['period']=='day') {
			echo "do dia</p>";
		}elseif ($_POST['period']=='week') {
			echo "da semana</p>";
		}elseif ($_POST['period']=='month') {
			echo "do mês</p>";
		}elseif ($_POST['period']=='year') {
			echo "do ano</p>";
		}elseif ($_POST['period']=='always') {
			echo "desde sempre</p>";
		}

		if ($_POST['order']=='position') {
			$order = 1;
			$order2 = 'row_number';
			
		}else{
			$order= 2;
			$order2= 2;
		}

		echo '<table id="books">
			        <tr>
			          <th>#</th>
			          <th>Livro</th>
			          <th>Gêneros</th>
			          <th>Autores</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata M ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 day' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.download_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.download_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata M ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '7 days' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.download_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.download_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata M ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 month' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.download_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.download_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata M ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 year' AND b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.download_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.download_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectCount AS (SELECT b.id AS c_book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata M ON m.id=b.metadata_id WHERE b.active=TRUE GROUP BY 1,3 ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectBook AS (SELECT DISTINCT b.id AS book_id, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id GROUP BY b.id, ge.genre, la.language), selectFront AS (SELECT sc.download_count, sc.title, sb.authors, sb.genre, sb.language, sb.book_id, ROW_NUMBER() OVER(ORDER BY sc.download_count DESC, sc.title ASC) AS row_number FROM selectCount sc JOIN selectBook sb ON sc.c_book_id=sb.book_id ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?book_info_view&bookId=".$data['book_id']."'>".$data['title']."</a></td>
				    <td>".$data['genre']."</td>
				    <td>".$data['authors']."</td>
				    <td>".$data['download_count']."</td>
				  </tr>";

		}

	}

	elseif ($_POST['filter']=='both'){

		echo "<p id='filter'>Mais baixados/visualizados ";

		if ($_POST['period']=='day') {
			echo "do dia</p>";
		}elseif ($_POST['period']=='week') {
			echo "da semana</p>";
		}elseif ($_POST['period']=='month') {
			echo "do mês</p>";
		}elseif ($_POST['period']=='year') {
			echo "do ano</p>";
		}elseif ($_POST['period']=='always') {
			echo "desde sempre</p>";
		}

		if ($_POST['order']=='position') {
			$order = 6;
			$order2 = 'row_number';
			
		}else{
			$order= 2;
			$order2= 2;
		}

		echo '<table id="books">
			        <tr>
			          <th>#</th>
			          <th>Livro</th>
			          <th>Gêneros</th>
			          <th>Autores</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectDownload AS (SELECT b.id AS book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 day' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectView AS (SELECT b.id AS book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 day' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectBoth AS (SELECT CASE WHEN sd.book_id IS NULL THEN sv.book_id ELSE sd.book_id END AS book_id, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END, CASE WHEN sv.title IS NULL THEN sd.title ELSE sv.title END AS title FROM selectDownload sd FULL JOIN selectView sv ON sd.book_id=sv.book_id ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectFront AS (SELECT DISTINCT b.id AS book_id, sboth.title, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, sboth.case, ROW_NUMBER() OVER(ORDER BY sboth.case DESC, sboth.title ASC) AS row_number  FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN selectBoth sboth ON sboth.book_id=b.id GROUP BY b.id, ge.genre, la.language, sboth.case, sboth.title ORDER BY $order $orderby, 2 ASC) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectDownload AS (SELECT b.id AS book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '7 days' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectView AS (SELECT b.id AS book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '7 days' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectBoth AS (SELECT CASE WHEN sd.book_id IS NULL THEN sv.book_id ELSE sd.book_id END AS book_id, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END, CASE WHEN sv.title IS NULL THEN sd.title ELSE sv.title END AS title FROM selectDownload sd FULL JOIN selectView sv ON sd.book_id=sv.book_id ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectFront AS (SELECT DISTINCT b.id AS book_id, sboth.title, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, sboth.case, ROW_NUMBER() OVER(ORDER BY sboth.case DESC, sboth.title ASC) AS row_number  FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN selectBoth sboth ON sboth.book_id=b.id GROUP BY b.id, ge.genre, la.language, sboth.case, sboth.title ORDER BY $order $orderby, 2 ASC) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectDownload AS (SELECT b.id AS book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 month' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectView AS (SELECT b.id AS book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 month' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectBoth AS (SELECT CASE WHEN sd.book_id IS NULL THEN sv.book_id ELSE sd.book_id END AS book_id, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END, CASE WHEN sv.title IS NULL THEN sd.title ELSE sv.title END AS title FROM selectDownload sd FULL JOIN selectView sv ON sd.book_id=sv.book_id ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectFront AS (SELECT DISTINCT b.id AS book_id, sboth.title, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, sboth.case, ROW_NUMBER() OVER(ORDER BY sboth.case DESC, sboth.title ASC) AS row_number  FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN selectBoth sboth ON sboth.book_id=b.id GROUP BY b.id, ge.genre, la.language, sboth.case, sboth.title ORDER BY $order $orderby, 2 ASC) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectDownload AS (SELECT b.id AS book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE d.date > current_timestamp - interval '1 year' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectView AS (SELECT b.id AS book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE v.date > current_timestamp - interval '1 year' AND b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectBoth AS (SELECT CASE WHEN sd.book_id IS NULL THEN sv.book_id ELSE sd.book_id END AS book_id, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END, CASE WHEN sv.title IS NULL THEN sd.title ELSE sv.title END AS title FROM selectDownload sd FULL JOIN selectView sv ON sd.book_id=sv.book_id ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectFront AS (SELECT DISTINCT b.id AS book_id, sboth.title, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, sboth.case, ROW_NUMBER() OVER(ORDER BY sboth.case DESC, sboth.title ASC) AS row_number  FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN selectBoth sboth ON sboth.book_id=b.id GROUP BY b.id, ge.genre, la.language, sboth.case, sboth.title ORDER BY $order $orderby, 2 ASC) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectDownload AS (SELECT b.id AS book_id, COUNT(d.id) AS download_count, m.title FROM book b JOIN download d ON d.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectView AS (SELECT b.id AS book_id, COUNT(v.id) AS view_count, m.title FROM book b JOIN view v ON v.book_id=b.id JOIN metadata m ON m.id=b.metadata_id WHERE b.active=true GROUP BY 1,3 ORDER BY 2 DESC), selectBoth AS (SELECT CASE WHEN sd.book_id IS NULL THEN sv.book_id ELSE sd.book_id END AS book_id, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END, CASE WHEN sv.title IS NULL THEN sd.title ELSE sv.title END AS title FROM selectDownload sd FULL JOIN selectView sv ON sd.book_id=sv.book_id ORDER BY 2 DESC, 3 ASC LIMIT $limit), selectFront AS (SELECT DISTINCT b.id AS book_id, sboth.title, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, sboth.case, ROW_NUMBER() OVER(ORDER BY sboth.case DESC, sboth.title ASC) AS row_number  FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.abbreviation,', ' ORDER BY l.abbreviation) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id JOIN selectBoth sboth ON sboth.book_id=b.id GROUP BY b.id, ge.genre, la.language, sboth.case, sboth.title ORDER BY $order $orderby, 2 ASC) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?book_info_view&bookId=".$data['book_id']."'>".$data['title']."</a></td>
				    <td>".$data['genre']."</td>
				    <td>".$data['authors']."</td>
				    <td>".$data['case']."</td>
				  </tr>";

		}

	}

	echo "</table></div>";