<?php 

	if (isset($_POST['upload'])){

		$languageId = $_POST['language'];
		$bookId = $_GET['bookId'] ;

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

						$fileNewName = "book_".$bookId."_".$languageId.".pdf"; 
						$fileDestination = '../books_pdfs/' .$fileNewName; 
						move_uploaded_file($file['tmp_name'], $fileDestination);

						$query = "INSERT INTO book_language(book_id, language_id) VALUES ('$bookId', '$languageId')";

						pg_query($dbConnection, $query);

						header("Location: ../logged/index.php?book_language_edit&bookId=".$bookId);

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

	if (isset($_POST['back'])){
		header('Location: ../logged/index.php?book_info_edit&bookId='.$_GET['bookId']);
	}

	if (isset($_POST['upload-image'])){

		include_once('connection.php');

		$bookId = $_GET['bookId'];

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

							header("Location: ../logged/index.php?book_info_edit&bookId=".$bookId);

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
		}else{
			header("Location: ../logged/index.php?book_image_edit&bookId=".$bookId);
		}	
	}