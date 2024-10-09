<?php
$medios =  [
	"El Pais" => "https://www.elpais.com",
	"El Mundo" => "https://www.elmundo.es",
	"Marca" => "https://www.marca.com",
	"Antena3" => "https://www.antena3.com",
	"La Razón" => "https://www.larazon.es"

];

?>

<!DOCTYPE html>
<html>

<head>
	<title>Lista de medios</title>
	<meta charset="utf-8">
</head>

<body>

	<h1>Lista de Medios: </h1>
	<ul>
		<?php foreach ($medios as $clave => $valor) : ?>
			<li> <a href="<?= $valor ?>"> <?= $clave ?></a></li>
		<?php endforeach ?>
	</ul>
	<hr>
	<?php show_source(__FILE__); ?>
	<hr>
</body>

</html>