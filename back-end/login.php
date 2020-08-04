<?php

session_start();

include_once('connection.php');

if (isset($_POST['submit'])) {

	$usernameEmail = pg_escape_string($dbConnection, $_POST['username-email']);
	$password = pg_escape_string($dbConnection, $_POST['password']);

	if(empty($usernameEmail) || empty($password)){
		header("Location: ../welcome/index.php?handlers&missing-fields");
		exit(); 
	}else{
		$queryUser = "SELECT u.username, u.active, u.email, u.password, u.id, p.first_name, p.last_name, p.city, to_char(p.birth_date, 'dd/mm/YYYY') AS birth_date, p.birth_date AS unformatted_birth_date, p.gender, p.id AS person_id, c.name as country_name, c.id AS country_id, pt.thought, pt.biography FROM usr u JOIN person p on u.id=p.user_id LEFT JOIN country c ON c.id=p.country_id JOIN profile_texts pt ON pt.user_id=u.id WHERE u.email='$usernameEmail' OR u.username='$usernameEmail';";
		$resultUser = pg_query($dbConnection, $queryUser);
		$resultCheckUser = pg_num_rows($resultUser);

		if ($resultCheckUser < 1) {
			header("Location: ../welcome/index.php?handlers&login-no-username-email");
			exit();
		}else{

			$dataUser = pg_fetch_assoc($resultUser);

			if ($dataUser['active']==f) {
				header("Location: ../welcome/index.php?handlers&active-false");
				exit();
			}else{

				$checkHash = password_verify($password, $dataUser['password']);
				
				if(!password_verify($password, $dataUser['password'])){
					header("Location: ../welcome/index.php?handlers&login-password");
					exit();
				}else{			

					$_SESSION['id'] = $dataUser['id'];
					$_SESSION['first'] = $dataUser['first_name'];
					$_SESSION['last'] = $dataUser['last_name'];
					$_SESSION['email'] = $dataUser['email'];
					$_SESSION['username'] = $dataUser['username'];
					$_SESSION['city'] = $dataUser['city'];
					$_SESSION['country'] = $dataUser['country_name'];				
					$_SESSION['birth'] = $dataUser['birth_date'];
					$_SESSION['thought'] = $dataUser['thought'];
					$_SESSION['biography'] = $dataUser['biography'];
					$_SESSION['person_id'] = $dataUser['person_id'];
					$_SESSION['country_id'] = $dataUser['country_id'];
					$_SESSION['gender'] = $dataUser['gender'];
					$_SESSION['unformatted_birth_date'] = $dataUser['unformatted_birth_date'];

					header("Location: ../logged/index.php?handlers&login-success");
					exit();
				}
			}
		}
	}
}else{
	header("Location: ../welcome/index.php?handlers&login-error");
	exit();
}
	
