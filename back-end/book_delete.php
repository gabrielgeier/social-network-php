<?php

session_start();
include_once('connection.php');

$bookId = $_GET['bookId']; 
$userId = $_SESSION['id'];

$query = "SELECT u.password FROM book b JOIN author a ON a.book_id=b.id JOIN usr u ON a.user_id=u.id WHERE u.id=$userId AND b.id=$bookId";

$result = pg_query($dbConnection, $query);
$resultCheck = pg_num_rows($result);


if ($resultCheck < 1) {
	header('Location: ../logged/index.php?handlers&not-an-author');
	exit();
}else{

	$data = pg_fetch_assoc($result);

	if ($_POST['password1']==$_POST['password2']) {
		
		if (password_verify($_POST['password1'], $data['password'])) {
			
			$query = "UPDATE book SET active=FALSE WHERE id=$bookId";
			pg_query($dbConnection, $query);

			header('Location: ../logged/index.php?handlers&book-successfully-deleted');

		}else{
			header('Location: ../logged/index.php?handlers&wrong-password-book&bookId='.$bookId);
			exit();
		}

	}else{
		header('Location: ../logged/index.php?handlers&password-mismatch-book&bookId='.$bookId);
		exit();
	}	

}



