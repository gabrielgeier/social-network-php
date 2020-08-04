<?php

	session_start();

	if (isset($_POST['cancel'])) {

		include_once('connection.php');

		$bookId = $_SESSION['book_id'];

		$query = "WITH deleteBook_Language AS (DELETE FROM book_language WHERE book_id='$bookId'), deleteBook_genre AS (DELETE FROM book_genre WHERE book_id='$bookId'), deleteAuthor AS (DELETE FROM author WHERE book_id='$bookId'), deleteBook AS (DELETE FROM book WHERE id='$bookId' RETURNING metadata_id) DELETE FROM metadata WHERE id=(SELECT metadata_id FROM deleteBook)";

		pg_query($dbConnection, $query) or die('aff');
		
		$fileToDelete = "../books_pdfs/book_".$bookId."*";
		$arrayToDelete= glob($fileToDelete);

		foreach ($arrayToDelete as $key) {
			unlink($key);
		}

		header('Location: ../logged/index.php?handlers&book-canceled');
		exit();
	}

	if (isset($_POST['upload'])){

		if (isset($_POST['language'])) {
			$languageId = $_POST['language'];
		}else{
			$languageId = $_GET['languageId'];
		}

		include_once('connection.php');

		$file = $_FILES['file'];
		$fileExt = explode('.', $file['name']); 
		$fileRealExt = strtolower(end($fileExt));

		if ($file['size']===0){
			header("Location: ../logged/index.php?handlers&upload-error");
		}else{
			
			if ($fileRealExt == 'pdf') {
				if ($file['error'] == 0) { 
					if ($file['size'] < 10000000) {

						$fileNewName = "book_".$_SESSION['book_id']."_".$languageId.".pdf"; 
						$fileDestination = '../books_pdfs/' .$fileNewName; 
						move_uploaded_file($file['tmp_name'], $fileDestination);

						$bookId = $_SESSION['book_id'];
						$query = "WITH updatebook AS (UPDATE book SET going=3 WHERE id=$bookId) INSERT INTO book_language (book_id, language_id) SELECT $bookId, $languageId WHERE NOT EXISTS (SELECT $bookId, $languageId FROM book_language WHERE book_id=$bookId AND language_id=$languageId)";

						pg_query($dbConnection, $query);

						header("Location: ../logged/index.php?book_language_form");
						exit();

					}else{
						header("Location: ../logged/index.php?handlers&file-big");
					}

				}else{
					header("Location: ../logged/index.php?handlers&upload-error");
				}
			}else{
				header("Location: ../logged/index.php?handlers&type-error");
			}
		}
	}

	if (isset($_POST['next'])){

		include_once('connection.php');

		$bookId = $_SESSION['book_id'];
		$query = "UPDATE book SET going=4 WHERE id=$bookId";

		pg_query($dbConnection, $query) or die("opaaa");

		header('Location: ../logged/index.php?book_image_form');
		exit();

	}

	if (isset($_POST['finish'])){

		include_once('connection.php');

		$bookId = $_SESSION['book_id'];

		//if i have an image, then upload it. Else: just make the changes into the DB
		if ($_FILES['file']) {

			$file = $_FILES['file'];

			if ($file['size']===0){
				header("Location: ../logged/index.php?handlers&upload-error");
			}else{

				$fileExt = explode('.', $file['name']); 
				$fileRealExt = strtolower(end($fileExt));
				$allowedExt = array('jpg', 'jpeg', 'png');
				
				if (in_array($fileRealExt, $allowedExt)) {
					if ($file['error'] == 0) { 
						
						if ($file['size'] < 300000) {

							$fileToDelete = "../books_images/book".$bookId.".*";
							$arrayToDelete= glob($fileToDelete);

							foreach ($arrayToDelete as $key) {
								unlink($key);
							}

							$fileNewName = "book".$bookId.".".$fileRealExt; 
							$fileDestination = '../books_images/' .$fileNewName; 
							move_uploaded_file($file['tmp_name'], $fileDestination);

						}else{
							header("Location: ../logged/index.php?handlers&file-big");
						}

					}else{
						header("Location: ../logged/inex.php?handlers&upload-error");
					}
				}else{
					header("Location: ../logged/index.php?handlers&type-error");
				}
			}
		}		

		$query = "UPDATE book SET going=0 WHERE id=$bookId";

		pg_query($dbConnection, $query) or die("opa");

		header('Location: ../logged/index.php?handlers&book-uploaded&bookId='.$bookId);
		exit();

	}

	else{
		
		$bookId = $_SESSION['book_id'];
		$fileSupposedName = "../books_images/book".$bookId.".*";

		if (!$arrayToSearch = glob($fileSupposedName)){
			echo " src='../books_images/default.png'>";
		}else{
			$fileInfo = glob($fileSupposedName);
			$fileExt = explode(".", $fileInfo[0]);
			$fileRealExt = end($fileExt);
			echo " src='../books_images/book".$bookId.".".$fileRealExt."?".mt_rand()."'>";	
		}

	}