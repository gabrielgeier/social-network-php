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
			$order = 2;
			$order2 = 'row_number';
			
		}else{
			$order= 1;
			$order2= 1;
		}
		
    	echo '<table id="genres">
			        <tr>
			          <th>#</th>
			          <th>Gênero</th>
			          <th>Total</th>
			        </tr>';

		if ($_POST['period']=='day') {
			
			$query = "WITH selectView AS (SELECT g.name, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 day' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, view_count, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectView AS (SELECT g.name, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '7 days' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, view_count, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectView AS (SELECT g.name, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 month' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, view_count, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectView AS (SELECT g.name, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 year' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, view_count, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectView AS (SELECT g.name, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, view_count, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td>".$data['name']."</td>
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
			$order = 2;
			$order2 = 'row_number';
			
		}else{
			$order= 1;
			$order2= 1;
		}

		echo '<table id="genres">
			        <tr>
			          <th>#</th>
			          <th>Gênero</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectDownload AS (SELECT g.name, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 day' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, download_count, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectDownload AS (SELECT g.name, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '7 days' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, download_count, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectDownload AS (SELECT g.name, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 month' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, download_count, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectDownload AS (SELECT g.name, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 year' GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, download_count, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectDownload AS (SELECT g.name, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id GROUP BY 1 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT name, download_count, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td>".$data['name']."</td>
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
			$order = 2;
			$order2 = 'row_number';
			
		}else{
			$order= 1;
			$order2= 1;
		}

		echo '<table id="genres">
			        <tr>
			          <th>#</th>
			          <th>Gênero</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectDownload AS (SELECT g.name, g.id, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 day' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectView AS (SELECT g.name, g.id, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 day' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN sd.name IS NULL THEN sv.name ELSE sd.name END AS name, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END FROM selectDownload sd FULL JOIN selectView sv ON sd.id=sv.id ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT sb.name, sb.case, ROW_NUMBER() OVER(ORDER BY sb.case DESC) AS row_number FROM selectBoth sb ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectDownload AS (SELECT g.name, g.id, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '7 days' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectView AS (SELECT g.name, g.id, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '7 days' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN sd.name IS NULL THEN sv.name ELSE sd.name END AS name, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END FROM selectDownload sd FULL JOIN selectView sv ON sd.id=sv.id ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT sb.name, sb.case, ROW_NUMBER() OVER(ORDER BY sb.case DESC) AS row_number FROM selectBoth sb ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectDownload AS (SELECT g.name, g.id, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 month' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectView AS (SELECT g.name, g.id, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 month' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN sd.name IS NULL THEN sv.name ELSE sd.name END AS name, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END FROM selectDownload sd FULL JOIN selectView sv ON sd.id=sv.id ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT sb.name, sb.case, ROW_NUMBER() OVER(ORDER BY sb.case DESC) AS row_number FROM selectBoth sb ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectDownload AS (SELECT g.name, g.id, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id WHERE d.date > current_timestamp - interval '1 year' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectView AS (SELECT g.name, g.id, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id WHERE v.date > current_timestamp - interval '1 year' GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN sd.name IS NULL THEN sv.name ELSE sd.name END AS name, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END FROM selectDownload sd FULL JOIN selectView sv ON sd.id=sv.id ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT sb.name, sb.case, ROW_NUMBER() OVER(ORDER BY sb.case DESC) AS row_number FROM selectBoth sb ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectDownload AS (SELECT g.name, g.id, COUNT(d.id) AS download_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN download d ON d.book_id=b.id GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectView AS (SELECT g.name, g.id, COUNT(v.id) AS view_count FROM book b JOIN book_genre bg ON b.id=bg.book_id JOIN genre g ON g.id=bg.genre_id JOIN view v ON v.book_id=b.id GROUP BY 1,2 ORDER BY 3 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN sd.name IS NULL THEN sv.name ELSE sd.name END AS name, CASE WHEN sd.download_count IS NULL THEN sv.view_count WHEN sv.view_count IS NULL THEN sd.download_count ELSE sd.download_count + sv.view_count END FROM selectDownload sd FULL JOIN selectView sv ON sd.id=sv.id ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT sb.name, sb.case, ROW_NUMBER() OVER(ORDER BY sb.case DESC) AS row_number FROM selectBoth sb ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td>".$data['name']."</td>
				    <td>".$data['case']."</td>
				  </tr>";

		}

	}

	echo "</table></div>";