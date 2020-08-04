<?php

$biography = $_SESSION['other_biography'];

if (!$biography){
	echo "<p style='text-align:center;text-indent:0px;'>A biografia ainda não foi adicionada.</p>";
}else{
	$newBiography = str_replace("\n","<p>",nl2br($biography));
	echo $newBiography;
}