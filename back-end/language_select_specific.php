<?php

include_once('../back-end/connection.php');

$bookId = $_GET['bookId'];

$query = "SELECT l.id, l.name FROM language l JOIN book_language bl ON bl.language_id=l.id WHERE bl.book_id='$bookId' ORDER BY l.name";
$result = pg_query($dbConnection, $query);

while ($data = pg_fetch_assoc($result)) {	
	if ($data['name']=="Português") {
		echo '<option value="'. $data['id']. '" selected>'. $data['name']. '</option>';
	}else{
		echo '<option value="'. $data['id']. '">'. $data['name']. '</option>';
	}
}