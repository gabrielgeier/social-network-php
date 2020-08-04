<?php

	session_start();
	$id = $_SESSION['id'];

	if (isset($_POST['submit-image'])){

		$file = $_FILES['file'];

		if ($file['size']===0){
			header("Location: ../logged/index.php?profile_edit");
		}else{

			//echo '<pre>' . var_export($file, true) . '</pre>';

			$fileExt = explode('.', $file['name']); 
			$fileRealExt = strtolower(end($fileExt));
			$allowedExt = array('jpg', 'jpeg', 'png');
			
			if (in_array($fileRealExt, $allowedExt)) {
				if ($file['error'] == 0) { 
					
					if ($file['size'] < 300000) {

						$fileToDelete = "../profile_images/profile".$id.".*";
						$arrayToDelete= glob($fileToDelete);

						foreach ($arrayToDelete as $key) {
							unlink($key);
						}

						$fileNewName = "profile".$id.".".$fileRealExt; 
						$fileDestination = '../profile_images/' .$fileNewName; 
						move_uploaded_file($file['tmp_name'], $fileDestination);
						header("Location: ../logged/index.php?profile_view");

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

		$fileSupposedName = "../profile_images/profile".$id.".*";

		if (!$arrayToSearch = glob($fileSupposedName)){
			echo " src='../profile_images/default.png'>";
		}else{
			$fileInfo = glob($fileSupposedName);
			$fileExt = explode(".", $fileInfo[0]);
			$fileRealExt = end($fileExt);
			echo " src='../profile_images/profile".$id.".".$fileRealExt."?".mt_rand()."'>";	
		}
	}