<?php

	session_start();
	
	if (isset($_POST['submit-user-informations'])) { 
	
	include_once('connection.php');

	$first = ucfirst(pg_escape_string($dbConnection, $_POST['first']));
	$last = ucfirst(pg_escape_string($dbConnection, $_POST['last']));
	$email = pg_escape_string($dbConnection, $_POST['email']);
	$date = pg_escape_string($dbConnection, $_POST['date']);
	$gender = pg_escape_string($dbConnection, $_POST['sex']);
	$city = ucwords(pg_escape_string($dbConnection, $_POST['city']));
	$country = pg_escape_string($dbConnection, $_POST['country']);


	if(empty($first) || empty($last) || empty($email) || empty($date)){
			header("Location: ../logged/index.php?handlers&signup-empty");
			exit();
		}else{
			if(!preg_match("/^[\p{L}]*$/u", $first) || !preg_match("/^[\p{L}]*$/u", $last)){
				header("Location: ../logged/index.php?handlers&signup-invalid-first-last");
				exit();
			}elseif(!preg_match("/^[\p{L} ]*$/u", $city)){
					header("Location: ../logged/index.php?handlers&signup-invalid-city");
					exit();
			}else{
					$id = $_SESSION['id'];
					$person_id = $_SESSION['person_id'];

					if (!$country) {
						$query = "WITH updateUser AS (Update usr set email='$email' WHERE id='$id' returning *), updatePerson AS( UPDATE person SET (first_name, last_name, birth_date, city, gender) = ('$first', '$last', '$date', '$city', '$gender') WHERE user_id='$id' returning *) SELECT *, to_char(birth_date, 'dd/mm/YYYY') AS formatted_birth_date FROM updateUser, updatePerson;";
					}else{
						$query = "WITH updateUser AS (Update usr set email='$email' WHERE id='$id' returning *), updatePerson AS( UPDATE person SET (first_name, last_name, birth_date, city, gender, country_id) = ('$first', '$last', '$date', '$city', '$gender', '$country') WHERE user_id='$id' returning *) SELECT *, c.name, to_char(birth_date, 'dd/mm/YYYY') AS formatted_birth_date FROM updateUser, updatePerson JOIN country c ON c.id=(SELECT country_id FROM updatePerson);";
					}
						
					$result = pg_query($dbConnection, $query);
					$dataUser = pg_fetch_assoc($result);
					$_SESSION['email'] = $dataUser['email'];
					$_SESSION['first'] = $dataUser['first_name'];
					$_SESSION['last'] = $dataUser['last_name'];
					$_SESSION['unformatted_birth_date'] = $dataUser['birth_date'];
					$_SESSION['birth'] = $dataUser['formatted_birth_date'];
					$_SESSION['gender'] = $dataUser['gender'];
					$_SESSION['city'] = $dataUser['city'];

					if ($dataUser['name']) {
						$_SESSION['country'] = $dataUser['name'];
					}

					$idUser = $dataUser['user_id'];

					header("Location: ../logged/index.php?profile_view");

			}			
		}	
}else{
	header("Location: ../logged/index.php?handlers&signup-error");
	exit();
}