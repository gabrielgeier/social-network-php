<?php
echo '<select name="country" id="country" required>';
    
if (isset($_SESSION['username'])) {
    echo '<option id="disabled" id="opt" selected value="'. $_SESSION['country_id']. '">'. $_SESSION['country']. '</option>';
}

include_once('../back-end/connection.php');

$query = "SELECT id, name FROM country ORDER BY name";
$result = pg_query($dbConnection, $query);

while ($data = pg_fetch_assoc($result)) {

    if ($data['name']=="Brasil") {
        echo '<option id="opt" value="'. $data['id']. '" selected>'. $data['name']. '</option>';
    }else{
        echo '<option id="opt" value="'. $data['id']. '">'. $data['name']. '</option>';
    }
    
}

echo "</select>";