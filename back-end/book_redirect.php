<?php	

	session_start();

	include_once('connection.php');

	$userId = $_SESSION['id'];
	$query = "SELECT b.id AS book_id, l.id AS language_id, b.going FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON u.id=a.user_id JOIN book_language bl ON bl.book_id=b.id JOIN language l ON l.id=bl.language_id WHERE u.id='$userId' AND b.going!=0;";
	$result = pg_query($dbConnection, $query) or die('aff');
	
		
	$data = pg_fetch_assoc($result);

	$_SESSION['book_id'] = $data['book_id'];
	$_SESSION['language_id'] = $data['language_id'];

	(string)$Url = "$_SERVER[REQUEST_URI]";

	if(strpos($Url, "book_metadata_form")) {
		if ($data['going'] == 2) {
			header('Location: index.php?book_file_form&languageId='.$data['language_id']);
			exit();
		}elseif ($data['going'] == 3) {
			header('Location: index.php?book_language_form&languageId='.$data['language_id']);
			exit();
		}elseif ($data['going'] == 4) {
			header('Location: index.php?book_image_form&languageId='.$data['language_id']);
			exit();
		}
	}elseif(strpos($Url, "book_file_form")) {
		if ($data['going'] == 0) {
			header('Location: index.php?book_metadata_form');
			exit();
		}elseif ($data['going'] == 3) {
			header('Location: index.php?book_language_form&languageId='.$data['language_id']);
			exit();
		}elseif ($data['going'] == 4) {
			header('Location: index.php?book_image_form&languageId='.$data['language_id']);
			exit();
		}
	}elseif(strpos($Url, "book_language_form")) {
		if ($data['going'] == 2) {
			header('Location: index.php?book_file_form&languageId='.$data['language_id']);
			exit();
		}elseif ($data['going'] == 0) {
			header('Location: index.php?book_metadata_form');
			exit();
		}elseif ($data['going'] == 4) {
			header('Location: index.php?book_image_form&languageId='.$data['language_id']);
			exit();
		}
	}elseif(strpos($Url, "book_image_form")) {
		if ($data['going'] == 2) {
			header('Location: index.php?book_file_form&languageId='.$data['language_id']);
			exit();
		}elseif ($data['going'] == 0) {
			header('Location: index.php?book_metadata_form');
			exit();
		}elseif ($data['going'] == 3) {
			header('Location: index.php?book_language_form&languageId='.$data['language_id']);
			exit();
		}
	}


