<?php

$id = $_SESSION['id'];
$otherId = $_GET['id'];

include_once('connection.php');

$querySended = "SELECT received_user_id as friend_id from friend where sended_user_id='$id' and received_user_id='$otherId' and status=false";
$result = pg_query($dbConnection, $querySended);

while ($row = pg_fetch_assoc($result)){
	if ($row['friend_id'] === $_SESSION['other_id']) {
		echo '<input type="submit" id="submit-friend" name="submit-friend-action" value="Cancelar Pedido"></input>';
		$status = true;
		break;
	}
}

if (!$status) {
	$queryAlreadyFriend = "SELECT received_user_id, sended_user_id from friend where (sended_user_id='$id' and received_user_id='$otherId' and status=true) or (sended_user_id='$otherId' and received_user_id='$id' and status=true);";
	$result = pg_query($dbConnection, $queryAlreadyFriend);

	while ($row = pg_fetch_assoc($result)){
		if ($row['received_user_id'] === $_SESSION['other_id'] || $row['sended_user_id'] === $_SESSION['other_id']) {
			echo '<input type="submit" id="submit-friend" name="submit-friend-action" value="Desfazer Amizade"></input>';
			$status = true;
		}
	}
}

if (!$status) {
	$querySended = "SELECT sended_user_id AS friend_id FROM friend WHERE sended_user_id='$otherId' and received_user_id='$id' and status=false;";
	$result = pg_query($dbConnection, $querySended);

	while ($row = pg_fetch_assoc($result)){
		if ($row['friend_id'] === $_SESSION['other_id']) {
			echo '<input type="submit" id="submit-friend" name="submit-friend-action" value="Aceitar Pedido"></input>';
			$status = true;
			break;
		}
	}
}

if (!$status){
	echo '<input type="submit" id="submit-friend" name="submit-friend-action" value="Adicionar"></input>';
}



