<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="../js/ranking_authors.js"></script>

<?php echo'<link rel="stylesheet" type="text/css" href="../css/ranking.css?'.mt_rand().'">'; ?>

</style>

<div class="window">

<section>
  <h1>Ranking de Autores</h1>
  <div class="table-window-authors">
  	<form id="form" action="../back-end/ranking_authors_show.php" method="POST">
  		<p>
  			<div id="methods">
  			<p>Filtro: 
	  			<select name="filter" id="filter" required>
	  				<option value="downloads">Downloads</option>
	  				<option value="views" selected>Visualizações</option>
	  				<option value="both">Ambos</option>
	  			</select>
  			</p><br>
  			<p>Período:
	  			<select name="period" id="period" required>
	  				<option value="day">Último Dia</option>
	  				<option value="week">Última Semana</option>
	  				<option value="month">Último Mês</option>
	  				<option value="year">Último Ano</option>
	  				<option value="always" selected>Sempre</option>
	  			</select>
	  		</p><br>
	  		<p>Ordenar:
	  			<select name="order" id="order" required>
	  				<option value="username">Autor</option>
	  				<option value="position" selected>Posição</option>
	  			</select>
	  			<select name="orderby" id="orderby" required>
	  				<option value="ASC" selected>Crescente</option>
	  				<option value="DESC">Decrescente</option>
	  			</select>
	  		</p><br>
	  		<p>Limite:
	  			<select name="limit" id="limit" required>
	  				<option value="5">5</option>
	  				<option value="10" selected>10</option>
	  				<option value="25">25</option>
	  				<option value="50">50</option>
	  				<option value="100">100</option>
	  			</select>
	  		</p>
	  		</div>
  		</p>
  		<input type="submit" name="go" value="Pesquisar">
  	</form>
 
  	</div>

		<div id="ranking-results">
			
		</div>

</div>