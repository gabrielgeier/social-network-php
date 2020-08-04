<?php 

if (isset($_POST['next'])) {

	session_start();

	include_once('connection.php');

	$title = pg_escape_string($dbConnection, $_POST['title']); 
	$synopsis = pg_escape_string($dbConnection, $_POST['synopsis']);
	$comments = pg_escape_string($dbConnection, $_POST['comments']);
	$authors = pg_escape_string($dbConnection, $_POST['authors']);
	$date = $_POST['date'];
	$language = $_POST['language'];	
	$genres = $_POST['control_1'];
	$fullBook = $_POST['full']; 
	$_SESSION['language'] = $language;
	
	if (!$genres){
		header("Location: ../logged/index.php?handlers&empty-genre");
		exit();
	}

	if(!preg_match("/^[a-zA-Z0-9_, ]*$/", $authors)){
		header("Location: ../logged/index.php?handlers&book-invalid-usernames");
		exit();
	}

	$authors = str_replace(' ', '', $authors);
	$authors = explode(',', $authors);

	foreach ($authors as $key => $value) {

		if ($authors[$key]) {

			if ($authors[$key] == $_SESSION['username']){
				$authorsId[$key] = $_SESSION['id'];
			}else{

				$query = "SELECT id FROM usr WHERE username='$authors[$key]' AND active=TRUE";
				$result = pg_query($dbConnection, $query);
				$resultCheck = pg_num_rows($result);

				if ($resultCheck > 0) {
					$data = pg_fetch_assoc($result);
					$authorsId[$key] = $data['id'];  
				}else{
					header('Location: ../logged/index.php?handlers&book-user-existace');
					exit();
				}
			}

		}
		
	}	

	if (!$date){
		$query = "WITH insertMetadata AS (INSERT INTO metadata(title, synopsis, comments, complete) VALUES ('$title', '$synopsis', '$comments', '$fullBook') RETURNING id AS metadata_id), insertBook AS (INSERT INTO book (metadata_id, going) SELECT metadata_id, 2 FROM insertMetadata RETURNING id as book_id), insertBook_language AS (INSERT INTO book_language (book_id, language_id) SELECT book_id, '$language' FROM insertBook) SELECT book_id FROM insertBook";
	}else{
		$query = "WITH insertMetadata AS (INSERT INTO metadata(title, synopsis, comments, publication_date, complete) VALUES ('$title', '$synopsis', '$comments', '$date', '$fullBook') RETURNING id AS metadata_id), insertBook AS (INSERT INTO book (metadata_id, going) SELECT metadata_id, 2 FROM insertMetadata RETURNING id AS book_id), insertBook_language AS (INSERT INTO book_language (book_id, language_id) SELECT book_id, '$language' FROM insertBook) SELECT book_id FROM insertBook";
	}

	$result = pg_query($dbConnection, $query) or die('aff');
	$data = pg_fetch_assoc($result);
	$bookId = $data['book_id'];

	$_SESSION['book_id'] = $bookId;
	$_SESSION['language_id'] = $language;

	foreach ($authorsId as $key => $value) {
			
		$query = "INSERT INTO author (book_id, user_id) VALUES ($bookId, $authorsId[$key]);";
		pg_query($dbConnection, $query);

	}

	foreach ($genres as $key => $value) {
			
		$query = "INSERT INTO book_genre (book_id, genre_id) VALUES ($bookId, $genres[$key]);";
		pg_query($dbConnection, $query);

	}

	header('Location: ../logged/index.php?book_file_form');
		
}else{
	header('Location: ../logged/index.php');
	exit();
}

