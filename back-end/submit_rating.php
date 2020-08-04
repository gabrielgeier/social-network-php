<?php 

session_start();
include_once('connection.php');

$bookId = $_SESSION['book_id'];
$userId = $_SESSION['id'];
$value = $_POST['value'];

$query = "WITH updateRate AS (UPDATE rate SET value='$value' WHERE user_id='$userId' AND book_id='$bookId') INSERT INTO rate (value, user_id, book_id) SELECT '$value', '$userId', '$bookId' WHERE NOT EXISTS(SELECT '$userId', '$bookId' FROM rate WHERE user_id='$userId' AND book_id='$bookId');";

pg_query($dbConnection, $query);
