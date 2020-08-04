<?php

include_once('../back-end/connection.php');

$query = "SELECT id, name FROM language ORDER BY name";
$result = pg_query($dbConnection, $query);

while ($data = pg_fetch_assoc($result)) {

	if ($data['name']=="Português") {
		echo '<option value="'. $data['id']. '" selected>'. $data['name']. '</option>';
	}else{
		echo '<option value="'. $data['id']. '">'. $data['name']. '</option>';
	}
	
}