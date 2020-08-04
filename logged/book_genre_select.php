<?php

include_once('../back-end/connection.php');

$query = "SELECT id, name FROM genre ORDER BY name";
$result = pg_query($dbConnection, $query);

$query2 = "SELECT id FROM genre JOIN book_genre ON book_genre.genre_id=genre.id WHERE book_genre.book_id='$bookId'";
$result2 = pg_query($dbConnection, $query2);
$data2 = pg_fetch_all($result2);
$genreIdCompare = array_column($data2, 'id');

while ($row = pg_fetch_assoc($result)) {
	if (in_array($row['id'], $genreIdCompare)) {
		echo '<option selected value="'. $row['id']. '">'. $row['name']. '</option>';
	}else{
		echo '<option value="'. $row['id']. '">'. $row['name']. '</option>';
	}
}