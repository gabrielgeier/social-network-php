<?php

session_start();
include_once('connection.php');

$userId = $_SESSION['id'];
$bookId = $_GET['bookId'];

$query = "SELECT user_id FROM favorite WHERE user_id=$userId AND book_id=$bookId";
$result = pg_query($dbConnection, $query);
$data = pg_fetch_assoc($result);

if (pg_num_rows($result) < 1) {
	$query = "INSERT INTO favorite (user_id, book_id) VALUES ($userId, $bookId)";
	pg_query($dbConnection, $query);
	echo "<a id='favorite-button'>Desfavoritar</a>";
}else{
	$query = "DELETE FROM favorite WHERE user_id=$userId AND book_id=$bookId";
	pg_query($dbConnection, $query);
	echo "<a id='favorite-button'>Favoritar</a>";
}
