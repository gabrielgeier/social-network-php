<?php

if (isset($_POST['submit'])) { 
	
	include_once('connection.php');

	$first = ucfirst(pg_escape_string($dbConnection, $_POST['first'])); 
	$last = ucfirst(pg_escape_string($dbConnection, $_POST['last']));
	$email = pg_escape_string($dbConnection, $_POST['email']);
	$username = pg_escape_string($dbConnection, $_POST['username']);
	$password = pg_escape_string($dbConnection, $_POST['password']);
	$date = pg_escape_string($dbConnection, $_POST['date']);
	$gender = pg_escape_string($dbConnection, $_POST['sex']);
	$city = pg_escape_string($dbConnection, $_POST['city']);
	$country = pg_escape_string($dbConnection, $_POST['country']);


	if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password) || empty($date)){
			header("Location: ../welcome/index.php?handlers&signup-empty");
			exit();
	}else{
		if(!preg_match("/^[\p{L}]*$/u", $first) || !preg_match("/^[\p{L}]*$/u", $last)){
			// http://php.net/manual/en/regexp.reference.unicode.php
			header("Location: ../welcome/index.php?handlers&signup-invalid-first-last");
			exit();
		}elseif(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
				header("Location: ../welcome/index.php?handlers&signup-invalid-username");
				exit();
		}elseif(!preg_match("/^[\p{L} ]*$/u", $city)){
				header("Location: ../welcome/index.php?handlers&signup-invalid-city");
				exit();
		}else{

				$query = "SELECT * FROM usr WHERE username = '$username' or email= '$email'";
				$result = pg_query($dbConnection, $query);
				$resultCheck = pg_num_rows($result);

				if ($resultCheck > 0) { 
					header("Location: ../welcome/index.php?handlers&signup-email-user");
				}else{ 
					
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

					$query = "WITH insertUser AS (INSERT INTO usr(username, email, password) VALUES ('$username', '$email', '$hashedPwd') RETURNING id AS user_id), insertPerson AS( INSERT INTO person (first_name, last_name, birth_date, city, gender, country_id, user_id) SELECT '$first', '$last', '$date', '$city', '$gender', '$country', user_id FROM insertUser RETURNING id AS person_id), insertProfileTexts AS (INSERT INTO profile_texts (user_id) SELECT user_id FROM insertUser) SELECT user_id FROM insertUser;"; 

					pg_query($dbConnection, $query);

					header("Location: ../welcome/index.php?handlers&signup-success");

			}
		}			
	}	
}else{
	header("Location: ../welcome/handlers.php?signup-error");
	exit();
}