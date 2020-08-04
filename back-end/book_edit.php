<?php

if (!isset($_POST['submit-edits'])){
	header('Location: ../logged/index.php?book_info_edit&bookId='.$_GET['bookId']);
	exit();
}

include_once('connection.php');

$bookId = $_GET['bookId'];
$metadataId = $_GET['metadataId'];
$title = pg_escape_string($dbConnection, $_POST['title']);
$authors = pg_escape_string($dbConnection, $_POST['authors']);
$genres = $_POST['control_1'];
$date = $_POST['date'];
$full = $_POST['full'];
$synopsis = pg_escape_string($dbConnection, $_POST['synopsis']);
$comments = pg_escape_string($dbConnection, $_POST['comments']);

if (!$genres[0]) {
	header('Location: ../logged/index.php?handlers&edit-genre&bookId='.$bookId);
	exit();
}

if(!preg_match("/^[a-zA-Z0-9_, ]*$/", $authors)){
	header('Location: ../logged/index.php?handlers&edit-authors&bookId='.$bookId);
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
				header('Location: ../logged/index.php?handlers&edit-user-existace&bookId='.$bookId);
				exit();
			}
		}

	}
	
}

if (!$date){
	$query = "UPDATE metadata SET title='$title', synopsis='$synopsis', comments='$comments', complete='$full' WHERE id=$metadataId";
}else{
	$query = "UPDATE metadata SET title='$title', synopsis='$synopsis', comments='$comments', complete='$full', publication_date='$date' WHERE id=$metadataId";
}

$result = pg_query($dbConnection, $query);
$data = pg_fetch_assoc($result);

$query = "WITH deleteAuthors AS (DELETE FROM author WHERE book_id = '$bookId') DELETE FROM book_genre WHERE book_id = '$bookId';";

pg_query($dbConnection, $query);

foreach ($authorsId as $key => $value) {
			
	$query = "INSERT INTO author (book_id, user_id) VALUES ($bookId, $authorsId[$key]);";
	pg_query($dbConnection, $query);

}

foreach ($genres as $key => $value) {
		
	$query = "INSERT INTO book_genre (book_id, genre_id) VALUES ($bookId, $genres[$key]);";
	pg_query($dbConnection, $query);

}

header('Location: ../logged/index.php?book_info_view&bookId='.$bookId);


