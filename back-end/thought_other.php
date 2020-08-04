<?php

	session_start();

	$thought = $_SESSION['other_thought'];

	if (!$thought){
		echo "\"All we have to decide is what to do with the time that is given us.\" - Tolkien";
	}else{
		echo $thought;
	}
