<?php

	if (isset($_POST['back'])) {
		header('Location: ../logged/index.php?book_info_view&bookId='.$_GET['bookId']);
		exit();
	}

	session_start();

	include_once('connection.php');

	$bookId = $_GET['bookId'];
	$languageId = $_POST['language'];
	$userId = $_SESSION['id'];

	$query = "SELECT active FROM book WHERE id=$bookId";
	$result = pg_query($dbConnection, $query);
	$data = pg_fetch_assoc($result);

	if ($data['active']==f) {
		header("Location: ../logged/index.php?handlers&book-deleted");
		exit();
	}else{

		$fileName = "../books_pdfs/book_".$bookId."_".$languageId.".pdf";

		$query = "WITH insertDownload AS (INSERT INTO download (user_id, book_id, language_id) SELECT $userId, $bookId, $languageId WHERE NOT EXISTS (SELECT DISTINCT d.book_id FROM download d WHERE d.date > current_timestamp - interval '60 minutes' AND d.book_id='$bookId' AND d.user_id='$userId')) SELECT l.abbreviation, m.title FROM book b JOIN language l ON l.id='$languageId' JOIN metadata m ON b.metadata_id=m.id WHERE b.id='$bookId'";
		$result = pg_query($dbConnection, $query);
		$data = pg_fetch_assoc($result);
		$data['title'] = str_replace(" ", "_", $data['title']);

		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename='".$data['title']."'");
		readfile($fileName);
		
	}

