
<link rel="stylesheet" type="text/css" href="../css/search.css">

<div class="person-result-window">

<?php

	if (isset($_POST['submit-search'])) {

		(string)$Url = "$_SERVER[REQUEST_URI]";
		include_once('connection.php');
		$search = mb_strtolower(pg_escape_string($dbConnection, $_POST['search']));
		$method = $_POST['method'];
  
		if (strpos($Url, "user")) {	

			if ($method === "generic") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE  (lower(u.username) LIKE '%$search%' OR lower(u.email) LIKE '%$search%' OR lower(p.first_name) LIKE '%$search%' OR lower(p.last_name) LIKE '%$search%' OR lower(p.first_name) || ' ' || lower(p.last_name) LIKE '%$search%' OR lower(p.city) || ' ' || lower(c.name) LIKE '%$search%' OR lower(p.city) || ', ' || lower(c.name) LIKE '%$search%') AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "username") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(u.username) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "first") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(p.first_name) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "last") {
				
				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(p.last_name) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "first and last") {
				
				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE ((lower(p.first_name) || ' ' || lower(p.last_name)) LIKE '%$search%') AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "country") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(c.name) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}elseif ($method === "city") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(p.city) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}

			elseif ($method === "email") {

				$query = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id WHERE lower(u.email) LIKE '%$search%' AND u.active=TRUE GROUP BY u.id, p.id, c.id ORDER BY 1;";

			}

			$result = pg_query($dbConnection, $query);
			$checkQueryResult = pg_num_rows($result);

			if($checkQueryResult > 0){
				echo "<h1>Você obteve: ".$checkQueryResult. " resultado(s)!</h1>";
				while ($row = pg_fetch_assoc($result)) {
					$_SESSION['other_id'] = $row['id'];
					echo "<div class='person'>";
					echo "<a target='_blank' href='../logged/index.php?profile_other&id=".$row['id']. "&p_id=". $row['p_id']. "'><div class='article-box'>";
					echo "<img class='image-box'";
					include('profile_image_other.php');
					echo "</a><div class='text-area'>
							<p><b>Username</b>: ".$row['username']."</p>
						    <p><b>E-mail</b>: ".$row['email']."</p>
						    <p><b>Nome</b>: ".$row['first_name']. " ". $row['last_name'] .  "</p>
						    <p><b>Endereço</b>: ".$row['city']. ", ". $row['name'] .  "</p>
					      </div></div>";
					echo "</div>";
					$_SESSION['other_id'] = -1;
				}
			}else{
				echo "<h1 class='no-results'>Não houveram resultados!</h1>";
			}

		}else{

			if ($method === "generic") {

				$query = "SELECT DISTINCT bo.id AS book_id, bo.title, bo.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, to_char(bo.upload_date, 'dd/mm/YYYY  HH24:MI:SS') as upload_date FROM (SELECT DISTINCT b.id, b.metadata_id, m.title, m.complete, m.upload_date FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN person p ON p.user_id=u.id JOIN metadata m ON m.id=b.metadata_id WHERE (lower(m.title) LIKE '%$search%' OR lower(m.synopsis) LIKE '%$search%' OR lower(u.username) LIKE '%$search%' OR (lower(p.first_name) || ' ' || lower(p.last_name)) LIKE '%$search%' OR lower(p.first_name) LIKE '%$search%' OR lower(p.last_name) LIKE '%$search%') AND b.active=TRUE) bo JOIN author a ON a.book_id=bo.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=bo.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=bo.id GROUP BY bo.id, bo.title, ge.genre, bo.complete, bo.upload_date, la.language ORDER BY bo.title, ge.genre";

			}

			elseif ($method === "title") {

				$query = "SELECT DISTINCT b.id AS book_id, m.title, m.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, to_char(m.upload_date, 'dd/mm/YYYY  HH24:MI:SS') as upload_date FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id WHERE lower(m.title) LIKE '%$search%' AND b.active=TRUE GROUP BY b.id, m.id, ge.genre, la.language ORDER BY m.title";

			}

			elseif ($method === "synopsis") {

				$query = "SELECT DISTINCT b.id AS book_id, m.title, m.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, to_char(m.upload_date, 'dd/mm/YYYY  HH24:MI:SS') as upload_date FROM metadata m JOIN book b ON b.metadata_id=m.id JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=b.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=b.id JOIN person p ON u.id=p.user_id WHERE lower(m.synopsis) LIKE '%$search%' AND b.active=TRUE GROUP BY b.id, m.id, ge.genre, la.language ORDER BY m.title";

			}

			elseif ($method === "username") {

				$query = "SELECT DISTINCT bo.id AS book_id, bo.title, bo.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, to_char(bo.upload_date, 'dd/mm/YYYY  HH24:MI:SS') as upload_date FROM (SELECT DISTINCT b.id, b.metadata_id, m.title, m.complete, m.upload_date FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN metadata m ON m.id=b.metadata_id WHERE lower(u.username) LIKE '%$search%' AND b.active=TRUE) bo JOIN author a ON a.book_id=bo.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=bo.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=bo.id GROUP BY bo.id, bo.title, ge.genre, bo.complete, bo.upload_date, la.language ORDER BY bo.title, ge.genre";

			}

			elseif ($method === "author-name") {

				$query = "SELECT DISTINCT bo.id AS book_id, bo.title, bo.complete, string_agg(u.username,', ' ORDER BY u.username) AS authors, ge.genre, la.language, to_char(bo.upload_date, 'dd/mm/YYYY  HH24:MI:SS') as upload_date FROM (SELECT DISTINCT b.id, b.metadata_id, m.title, m.complete, m.upload_date FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN person p ON p.user_id=u.id JOIN metadata m ON m.id=b.metadata_id WHERE ((lower(p.first_name) || ' ' || lower(p.last_name)) LIKE '%$search%' OR lower(p.first_name) LIKE '%$search%' OR lower(p.last_name) LIKE '%$search%') AND b.active=TRUE) bo JOIN author a ON a.book_id=bo.id JOIN usr u ON u.id=a.user_id JOIN (SELECT string_agg(g.name,', ' ORDER BY g.name) AS genre, bg.book_id FROM book_genre bg JOIN genre g ON g.id=bg.genre_id GROUP BY bg.book_id) ge ON ge.book_id=bo.id JOIN (SELECT string_agg(l.name,', ' ORDER BY l.name) AS language, bl.book_id FROM book_language bl JOIN language l ON l.id=bl.language_id GROUP BY bl.book_id) la ON la.book_id=bo.id GROUP BY bo.id, bo.title, ge.genre, bo.complete, bo.upload_date, la.language ORDER BY bo.title, ge.genre";

			}

			$result = pg_query($dbConnection, $query); 
			$checkQueryResult = pg_num_rows($result);

			if($checkQueryResult > 0){

				echo "<h1>Você obteve: ".$checkQueryResult. " resultado(s)!</h1>";

				while($data = pg_fetch_assoc($result)){

					if ($data['complete']===t) {
						$complete = 'Sim';
					}else{
						$complete = 'Não';
					} 

					$_SESSION['book_id'] = $data['book_id'];
					echo "<div class='book'>";
					echo "<div class='article-box'>";
					echo "<a target='_blank' id='book' href='../logged/index.php?book_info_viewr&bookId=".$data['book_id']. "'><img class='image-box'";
					include('book_file_upload.php');
					echo "</a><div class='text-area-book'>
							<p><b>Título</b>: ".$data['title']."</p>
						    <p><b>Autores</b>: ".$data['authors']."</p>
						    <p><b>Línguas</b>: ".$data['language']."</p>
						    <p><b>Gêneros</b>: ".$data['genre']."</p>
						    <p><b>Data</b>: ".$data['upload_date']."</p>
						    <p><b>Íntegra</b>: ".$complete."</p>
					      </div></div>";
					echo "</div>";
					$_SESSION['book_id'] = -1;
					
				}

			}else{
				echo "<h1 class='no-results'>Não houveram resultados!</h1>";
			}

		}

	}

?>
</div>