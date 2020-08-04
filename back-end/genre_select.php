<?php

include_once('connection.php');

$query = "SELECT id, name FROM genre ORDER BY name";
$result = pg_query($dbConnection, $query);

while ($data = pg_fetch_assoc($result)) {
	echo '<option value="'. $data['id']. '">'. $data['name']. '</option>';
}