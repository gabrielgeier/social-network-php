<link rel="stylesheet" type="text/css" href="../css/search.css">

<div class="person-result-window">

<?php

	$id = $_SESSION['id'];

	include_once('../back-end/connection.php');
	$query = "SELECT DISTINCT u.username, u.email, u.id, p.first_name, p.last_name, p.city, c.name as country_name, p.id as p_id FROM usr u JOIN person p ON p.user_id=u.id LEFT JOIN country c ON c.id = p.country_id JOIN friend fr ON (fr.sended_user_id=u.id OR fr.received_user_id=u.id) WHERE (fr.sended_user_id='$id' or fr.received_user_id='$id') AND status=true AND u.id!='$id' AND u.active=TRUE ORDER BY u.username ASC";
	$result = pg_query($dbConnection, $query);

	$checkQueryResult = pg_num_rows($result);
	echo pg_last_error($dbConnection);

	if($checkQueryResult > 0){
		echo "<h1>Você tem: ".$checkQueryResult. " amigo(s)!";

			while ($dataUser = pg_fetch_assoc($result)) {
				$_SESSION['other_id'] = $dataUser['id'];
				if (!$dataUser['country_name']) {
					$dataUser['country_name'] = 'Sem País';
				}
				echo "<div class='person'>";
				echo "<a href='../logged/index.php?profile_other&id=".$dataUser['id']. "&p_id=". $dataUser['p_id']. "'><div class='article-box'>";
				echo "<img class='image-box'";
				include('../back-end/profile_image_other.php');
				echo "</a><div class='text-area'>
						<p><b>Username</b>: ".$dataUser['username']."</p>
					    <p><b>E-mail</b>: ".$dataUser['email']."</p>
					    <p><b>Nome</b>: ".$dataUser['first_name']. " ". $dataUser['last_name'] .  "</p>
					    <p><b>Endereço</b>: ".$dataUser['city']. ", ". $dataUser['country_name'] .  "</p>
				      </div></div>";
				echo "</div>";
			}
	}else{
		echo "<h1 class='no-results'>Parece que você é antissocial!</h1>";
	}
	
?>

</div>