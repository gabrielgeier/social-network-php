<?php

	include_once('header.php');

	(string)$Url = "$_SERVER[REQUEST_URI]";
	
	// echo "<p>". $Url. "</p>";

	if (strpos($Url, "handlers")) {
		include_once('handlers.php');
	}

	elseif (strpos($Url, "login")) {
		include_once('login.php');
	}

	elseif (strpos($Url, "sign")) {
		include_once('sign.php');
	}

	elseif (strpos($Url, "about")) {
		include_once('about.php');
	}

	elseif (strpos($Url, "contact")) {
		include_once('contact.php');
	}

	else{
		echo '<img id="logo-midle" src="../images/large_icon.png">';
		echo '<div id="welcome-window">
				<h1>FreeWriters</h1>
				<p>Sua rede social de compartilhamento e leitura de livros</p>
			 </div>';
	}

?>

</body>
</html>










