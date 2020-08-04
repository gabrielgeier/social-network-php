<?php

	$id = $_SESSION['other_id'];

	$fileSupposedName = "../profile_images/profile".$id.".*";

	if (!$arrayToSearch = glob($fileSupposedName)){
		echo " src='../profile_images/default.png'>";
	}else{
		$fileInfo = glob($fileSupposedName);
		$fileExt = explode(".", $fileInfo[0]);
		$fileRealExt = end($fileExt);
		echo " src='../profile_images/profile".$id.".".$fileRealExt."?".mt_rand()."'>";	
	}