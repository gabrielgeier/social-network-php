<?php

session_start();
$id = $_SESSION['id'];
$otherId = $_GET['other_id'];

	if (isset($_POST['submit-friend-action'])) {

		include_once('connection.php');
		
		$action = $_POST['submit-friend-action'];

		if ($action === 'Cancelar Pedido') {
			
			$query = "DELETE FROM friend WHERE sended_user_id='$id' AND received_user_id='$otherId';";
			pg_query($dbConnection, $query);
			header('Location: ../logged/index.php?profile_other&id='.$otherId.'&p_id='.$_SESSION['other_p_id']);

		}elseif($action === 'Desfazer Amizade'){

			$query = "DELETE FROM friend WHERE (sended_user_id='$id' AND received_user_id='$otherId' AND status=true) OR (sended_user_id='$otherId' AND received_user_id='$id' AND status=true);";
			pg_query($dbConnection, $query);
			header('Location: ../logged/index.php?profile_other&id='.$otherId.'&p_id='.$_SESSION['other_p_id']);

		}elseif($action === 'Adicionar'){

			$query = "INSERT INTO friend VALUES ('$id', '$otherId', FALSE);";
			pg_query($dbConnection, $query);
			header('Location: ../logged/index.php?profile_other&id='.$otherId.'&p_id='.$_SESSION['other_p_id']);

		}elseif($action === 'Aceitar Pedido'){

			$query = "UPDATE friend SET status=true WHERE sended_user_id='$otherId' and received_user_id='$id';";
			pg_query($dbConnection, $query);
			header('Location: ../logged/index.php?profile_other&id='.$otherId.'&p_id='.$_SESSION['other_p_id']);

		}

		$_SESSION['other_id']=-1;

	}