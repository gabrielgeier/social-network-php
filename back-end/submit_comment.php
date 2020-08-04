<?php

// echo '<script type="text/javascript" src="../js/comment_fadeout.js?'.mt_rand().'"></script>';

session_start();

include_once('connection.php');

$bookId = $_SESSION['book_id'];
$userId = $_SESSION['id'];
$body = $_POST['body'];

$query = "INSERT INTO comment (user_id, book_id, body) VALUES ('$userId', '$bookId', '$body')";

// echo "<p id='fade' style='text-align:center; font-size:10pt;'>Comentário Postado!</p>";

pg_query($dbConnection, $query);