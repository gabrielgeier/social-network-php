<link rel="stylesheet" type="text/css" href="../css/window.css">
<link rel="stylesheet" type="text/css" href="../css/sign.css">
<div class= "window">
	<img src="../images/large_icon.png" class="logo">
	<a class="minimizer" href="index.php">_</a>
    <h1>Cadastre-se!</h1>
    <form class="sign-form" action="../back-end/sign.php" method="POST" onkeypress="return event.keyCode != 13;">
    	
        <p>Nome<a id="required">*</a></p>
	    <input type="text" name="first" placeholder="Seu nome" minlenght="1" maxlength="18" required>
        
        <p>Sobrenome<a id="required">*</a></p>
        <input type="text" name="last" placeholder="Seu sobrenome" minlenght="1" maxlength="18" required>
	    
        <p>E-mail<a id="required">*</a></p>
	    <input type="email" name="email" placeholder="Seu e-mail" minlenght="1" maxlength="63" required>
        
        <p>Username<a id="required">*</a></p>
        <input type="text" name="username" placeholder="Seu username" minlenght="1" maxlength="12" required>
	    
        <p>Senha<a id="required">*</a></p>
	    <input type="password" name="password" placeholder="Sua senha" minlenght="1" maxlength="18" required>
        
        <p>Data de Nascimento<a id="required">*</a></p>
        <input type="date" name="date" placeholder="Data de nascimento" required>
        
        <p>Sexo</p> 
            <input type="radio" name="sex" id="male" value="Masculino"> <label for="male">Masculino</label><br> 
            <input type="radio" name="sex" id="female" value="Feminino"> <label for="female">Feminino</label><br>
            <input type="radio" name="sex" id="other" value="Outro"> <label for="other">Outro</label><br>
            <input type="radio" name="sex" id="none" checked value="Não Informado"> <label for="male" value="Não Informado">Não Informar</label>
        
        <p>Cidade<a id="required">*</a></p>
        <input type="text" name="city" required placeholder="Sua cidade" maxlength="100">
        
        <p>País<a id="required">*</a></p> <?php include_once('country-select.php');?></p>
	    <input type="submit" name="submit" value="Submeter" required>

   	</form>
</div>