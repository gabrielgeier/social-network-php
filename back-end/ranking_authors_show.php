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
		
    	echo '<table id="authors">
			        <tr>
			          <th>#</th>
			          <th>Autor</th>
			          <th>Total</th>
			        </tr>';

		if ($_POST['period']=='day') {
			
			$query = "WITH selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 day' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, view_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '7 days' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, view_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 month' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, view_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 year' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, view_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, view_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY view_count DESC) AS row_number FROM selectView ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {

			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?profile_other&id=".$data['user_id']."&p_id=".$data['person_id']."'>".$data['username']."</a></td>
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

		echo '<table id="authors">
			        <tr>
			          <th>#</th>
			          <th>Autor</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 day' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, download_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '7 days' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, download_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 month' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, download_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 year' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, download_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, download_count, user_id, person_id, ROW_NUMBER() OVER(ORDER BY download_count DESC) AS row_number FROM selectDownload ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {
			
			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?profile_other&id=".$data['user_id']."&p_id=".$data['person_id']."'>".$data['username']."</a></td>
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
			$order = 4;
			$order2 = 'row_number';
			
		}else{
			$order= 1;
			$order2= 1;
		}

		echo '<table id="authors">
			        <tr>
			          <th>#</th>
			          <th>Autor</th>
			          <th>Total</th>
			        </tr>';

    	if ($_POST['period']=='day') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count, u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 day' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 day' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN s1.username IS NULL THEN s2.username ELSE s1.username END AS username, CASE WHEN s1.user_id IS NULL THEN s2.user_id ELSE s1.user_id END AS user_id, CASE WHEN s1.person_id IS NULL THEN s2.person_id ELSE s1.person_id END AS person_id, CASE WHEN s1.download_count IS NULL THEN s2.view_count WHEN s2.view_count IS NULL THEN s1.download_count ELSE s1.download_count + s2.view_count END FROM selectDownload s1 FULL JOIN selectView s2 ON s1.user_id=s2.user_id ORDER BY 4 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, user_id, person_id, \"case\", ROW_NUMBER() OVER(ORDER BY \"case\" DESC) AS row_number FROM selectBoth ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='week') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count, u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '7 dayS' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '7 days' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN s1.username IS NULL THEN s2.username ELSE s1.username END AS username, CASE WHEN s1.user_id IS NULL THEN s2.user_id ELSE s1.user_id END AS user_id, CASE WHEN s1.person_id IS NULL THEN s2.person_id ELSE s1.person_id END AS person_id, CASE WHEN s1.download_count IS NULL THEN s2.view_count WHEN s2.view_count IS NULL THEN s1.download_count ELSE s1.download_count + s2.view_count END FROM selectDownload s1 FULL JOIN selectView s2 ON s1.user_id=s2.user_id ORDER BY 4 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, user_id, person_id, \"case\", ROW_NUMBER() OVER(ORDER BY \"case\" DESC) AS row_number FROM selectBoth ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='month') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count, u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 month' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 month' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN s1.username IS NULL THEN s2.username ELSE s1.username END AS username, CASE WHEN s1.user_id IS NULL THEN s2.user_id ELSE s1.user_id END AS user_id, CASE WHEN s1.person_id IS NULL THEN s2.person_id ELSE s1.person_id END AS person_id, CASE WHEN s1.download_count IS NULL THEN s2.view_count WHEN s2.view_count IS NULL THEN s1.download_count ELSE s1.download_count + s2.view_count END FROM selectDownload s1 FULL JOIN selectView s2 ON s1.user_id=s2.user_id ORDER BY 4 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, user_id, person_id, \"case\", ROW_NUMBER() OVER(ORDER BY \"case\" DESC) AS row_number FROM selectBoth ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='year') {
			
			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count, u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id WHERE d.date > current_timestamp - interval '1 year' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id WHERE v.date > current_timestamp - interval '1 year' GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN s1.username IS NULL THEN s2.username ELSE s1.username END AS username, CASE WHEN s1.user_id IS NULL THEN s2.user_id ELSE s1.user_id END AS user_id, CASE WHEN s1.person_id IS NULL THEN s2.person_id ELSE s1.person_id END AS person_id, CASE WHEN s1.download_count IS NULL THEN s2.view_count WHEN s2.view_count IS NULL THEN s1.download_count ELSE s1.download_count + s2.view_count END FROM selectDownload s1 FULL JOIN selectView s2 ON s1.user_id=s2.user_id ORDER BY 4 DESC, 1 ASC LIMIT $limit), selectFront AS (SELECT username, user_id, person_id, \"case\", ROW_NUMBER() OVER(ORDER BY \"case\" DESC) AS row_number FROM selectBoth ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		elseif ($_POST['period']=='always') {

			$query = "WITH selectDownload AS (SELECT u.username, COUNT(d.id) AS download_count, u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN download d ON d.book_id=b.id JOIN person p ON p.user_id=u.id GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectView AS (SELECT u.username, COUNT(v.id) AS view_count , u.id AS user_id, p.id AS person_id FROM usr u JOIN author a ON a.user_id=u.id JOIN book b ON b.id=a.book_id JOIN view v ON v.book_id=b.id JOIN person p ON p.user_id=u.id GROUP BY 1, 3, 4 ORDER BY 2 DESC, 1 ASC), selectBoth AS (SELECT CASE WHEN s1.username IS NULL THEN s2.username ELSE s1.username END AS username, CASE WHEN s1.user_id IS NULL THEN s2.user_id ELSE s1.user_id END AS user_id, CASE WHEN s1.person_id IS NULL THEN s2.person_id ELSE s1.person_id END AS person_id, CASE WHEN s1.download_count IS NULL THEN s2.view_count WHEN s2.view_count IS NULL THEN s1.download_count ELSE s1.download_count + s2.view_count END FROM selectDownload s1 FULL JOIN selectView s2 ON s1.user_id=s2.user_id ORDER BY 4 DESC, 1 ASC LIMIT $limit), selectFront AS  (SELECT username, user_id, person_id, \"case\", ROW_NUMBER() OVER(ORDER BY \"case\" DESC) AS row_number FROM selectBoth ORDER BY $order $orderby) SELECT * FROM selectFront ORDER BY $order2 $orderby2";

		}

		$result = pg_query($dbConnection, $query);

		while ($data = pg_fetch_assoc($result)) {
			
			echo "<tr>
				    <td>".$data['row_number']."</td>
				    <td><a id='table' target='_blank' href='index.php?profile_other&id=".$data['user_id']."&p_id=".$data['person_id']."'>".$data['username']."</a></td>
				    <td>".$data['case']."</td>
				  </tr>";

		}

	}

	echo "</table></div>";