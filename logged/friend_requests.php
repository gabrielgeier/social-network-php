
<link rel="stylesheet" type="text/css" href="../css/search.css">

<div class="person-result-window">

<?php

	$id = $_SESSION['id'];

	include_once('../back-end/connection.php');

	$query1 = "SELECT sended_user_id from friend where received_user_id='$id' and status=false;";

	$result1 = pg_query($dbConnection, $query1);
	$checkQueryResult = pg_num_rows($result1);

	if($checkQueryResult > 0){
		echo "<h1>Você tem: ".$checkQueryResult. " pedido(s) de amizade!";
		while ($data = pg_fetch_assoc($result1)) {

			$_SESSION['other_id'] = $data['sended_user_id'];

			$id = $_SESSION['other_id'];
			$query2 = "SELECT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id JOIN country c ON c.id = p.country_id WHERE u.id='$id';";
			$result2 = pg_query($dbConnection, $query2);

			while ($row = pg_fetch_assoc($result2)) {
				//$_SESSION['other_id'] = $row['id'];
				if (!$row['name']) {
					$row['name'] = 'Sem País';
				}
				echo "<div class='person'>";
				echo "<a href='../logged/profile_other.php?id=".$row['id']. "&p_id=". $row['p_id']. "'><div class='article-box'>";
				echo "<img class='image-box'";
				include('../back-end/profile_image_other.php');
				echo "</a>
						<form class='friend' action='../back-end/friend_requests.php?id=".$row['id']."' method='POST'>
							<input type='submit' name='accept-friendship' value='Aceitar'></input>
							<input type='submit' name='refuse-friendship' value='Recusar'></input>
						</form>
						<div class='text-area'>
						<p><b>Username</b>: ".$row['username']."</p>
					    <p><b>E-mail</b>: ".$row['email']."</p>
					    <p><b>Nome</b>: ".$row['first_name']. " ". $row['last_name'] .  "</p>
					    <p><b>Endereço</b>: ".$row['city']. ", ". $row['name'] .  "</p>

				      </div></div>";
				echo "</div>";
			}
		}
	}else{
		echo "<h1 class='no-results'>Você não tem pedidos de amizade pendentes!</h1>";
	}
	
?>

</div>