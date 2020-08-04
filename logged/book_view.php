<link rel="stylesheet" type="text/css" href="../css/window.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<link rel="stylesheet" type="text/css" href="../css/book.css">

<?php
	if (isset($_POST['back'])) {
	 	header('Location: index.php?book_info_view&bookId='.$_GET['bookId']);
	 	exit();
	 }else{
	 	include_once('header.php');
	 }

	echo '<script type="text/javascript" src="../js/jquery.js"></script>';

    echo '<script type="text/javascript" src="../js/book_comments.js?'.mt_rand().'"></script>';

	echo '<link rel="stylesheet" type="text/css" href="../css/book_view.css?'.mt_rand().'">';

	$languageId = $_POST['language'];

	if (isset($_GET['redirected'])) {

		include_once('../back-end/connection.php');

		$bookId = $_GET['bookId'];
		$languageId = $_GET['languageId'];
		$userId = $_SESSION['id'];
		$_SESSION['book_id'] = $bookId;

		$query = "SELECT active FROM book WHERE id=$bookId";
		$result = pg_query($dbConnection, $query);
		$data = pg_fetch_assoc($result);

		if ($data['active']==f) {
			header("Location: ../logged/index.php?handlers&book-deleted");
			exit();
		}else{

			$fileName = "../books_pdfs/book_".$bookId."_".$languageId.".pdf";

			if (!$arrayToSearch = glob($fileName)){
				echo "Livro indisponível!";
			}else{

				$query = "SELECT DISTINCT v.book_id AS book_id FROM view v WHERE v.date > current_timestamp - interval '60 minutes' AND v.book_id='$bookId' AND v.user_id='$userId'";
				$result = pg_query($dbConnection, $query);

				if (pg_num_rows($result) < 1) {
					$query = "INSERT INTO view (user_id, book_id, language_id) SELECT $userId, $bookId, $languageId WHERE NOT EXISTS (SELECT DISTINCT v.book_id FROM view v WHERE v.date > current_timestamp - interval '60 minutes' AND v.book_id='$bookId' AND v.user_id='$userId')";
					pg_query($dbConnection, $query);
				}			

				echo '<div id="main"><object id="book" data="'.$fileName.'?'.mt_rand().'" type="application/pdf" width="63%" height="100%"></object>';
			
				echo "<div id='comment-window'>
						<form action='comment.php' method='POST'>
							<textarea id='comment' name='comment' placeholder='Poste seu comentário' maxlength='256'></textarea>
							<input type='submit' id='submit' value='Enviar'>
							<p class='form-message'></p>
						</form>
						<div id='comments-control'>
							<div id='show-unshow-div'>
								<input type='checkbox' name='comments-button' id='comments-button'>
							    <label for='comments-button'>
							        <div id='show'><span class='show'>Mostrar</span></div>
							        <div id='unshow'><span class='unshow'>Esconder</span></div>
							    </label>
						    </div>
						    <div id='reload-div'>
						    	<input type='checkbox' name='reload-input' id='reload-input'>
							    <label for='reload-input'>
							        <div id='reload' title='Os comentários são recarregados automaticamente'><span class='reload'>Recarregar</span></div>
							    </label>
						    </div>
					    </div>
						<div id='comments'></div>
					  </div>
					  </div>";
			}
		}

	}else{
		header('Location: book_view.php?bookId='.$_GET['bookId'].'&languageId='.$languageId.'&redirected');
	}
