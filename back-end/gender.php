<?php

if ($_SESSION['gender']==='Masculino'){
	echo '<input type="radio" name="sex" id="male" value="Masculino" checked> <label for="male">Masculino</label><br> 
	  <input type="radio" name="sex" id="female" value="Feminino"> <label for="female">Feminino</label><br>
	  <input type="radio" name="sex" id="other" value="Outro"> <label for="other">Outro</label><br>
	  <input type="radio" name="sex" id="none" value="Não Informado"> <label for="male">Não Informar</label>';
}elseif ($_SESSION['gender']==='Feminino'){
	echo '<input type="radio" name="sex" id="male" value="Masculino"> <label for="male">Masculino</label><br> 
	  <input type="radio" name="sex" id="female" value="Feminino" checked> <label for="female">Feminino</label><br>
	  <input type="radio" name="sex" id="other" value="Outro"> <label for="other">Outro</label><br>
	  <input type="radio" name="sex" id="none" value="Não Informado"> <label for="male">Não Informar</label>';
}elseif ($_SESSION['gender']==='Outro'){
	echo '<input type="radio" name="sex" id="male" value="Masculino"> <label for="male">Masculino</label><br> 
	  <input type="radio" name="sex" id="female" value="Feminino"> <label for="female">Feminino</label><br>
	  <input type="radio" name="sex" id="other" value="Outro" checked> <label for="other">Outro</label><br>
	  <input type="radio" name="sex" id="none" value="Não Informado"> <label for="male">Não Informar</label>';
}elseif ($_SESSION['gender']==='Não Informado'){
	echo '<input type="radio" name="sex" id="male" value="Masculino"> <label for="male">Masculino</label><br> 
	  <input type="radio" name="sex" id="female" value="Feminino"> <label for="female">Feminino</label><br>
	  <input type="radio" name="sex" id="other" value="Outro"> <label for="other">Outro</label><br>
	  <input type="radio" name="sex" id="none" value="Não Informado" checked> <label for="male">Não Informar</label>';
}