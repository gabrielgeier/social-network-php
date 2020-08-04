<?php
	include_once('header.php');

	$userId = $_GET['id'];
	$personId = $_GET['p_id'];

	$_SESSION['other_id'] = $userId;
	$_SESSION['other_p_id'] = $personId;

	$dbConnection = pg_connect("dbname=project user=postgres password=9957");
	
	if ($userId === $_SESSION['id']) {
		header('Location: index.php?profile_view');
	}else{

		$query = "SELECT u.username, u.email, p.first_name, p.last_name, p.city, p.birth_date, p.gender, p.id, c.name AS country_name, pt.thought, pt.biography FROM usr u JOIN person p ON '$userId'=p.user_id JOIN country c ON c.person_id='$personId' JOIN profile_texts pt ON pt.user_id='$userId' WHERE u.id='$userId'LIMIT 1;";
		
		$result = pg_query($dbConnection, $query);
		$data = pg_fetch_assoc($result);

		$_SESSION['other_username'] = $data['username'];
		$_SESSION['other_email'] = $data['email'];
		$_SESSION['other_first_name'] = $data['first_name'];
		$_SESSION['other_last_name'] = $data['last_name'];
		$_SESSION['other_city'] = $data['city'];
		$_SESSION['other_birth_date'] = $data['birth_date'];
		$_SESSION['other_gender'] = $data['gender'];
		$_SESSION['other_country_name'] = $data['country_name'];
		$_SESSION['other_biography'] = $data['biography'];
		$_SESSION['other_thought'] = $data['thought'];

	}
?>