<?php
$deportes = array(
	'Baloncesto'	 => "img/baloncesto.jpeg",
	'F1' 			 => "img/f1.jpeg",
	'Futbol'		 => "img/futbol.jpeg",
	'Tenis' 		 => "img/tenis.jpeg",
	'Volley'		 => "img/volley.jpeg",
);

?>
<html>

<head>
	<title>Logos de deportes</title>
	<meta charset="utf-8">
	<style type="text/css">
		table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 80;
		}
	</style>
</head>
<body>
<table>
	<tr>
		<th>Deporte</th>
		<th>logo</th>
	</tr>
	<?php foreach ($deportes as $c => $v) : ?>
		<tr>
			<td><?= $c ?></td>
			<td> <img src="<?= $v ?>" alt="<?= $c ?>"></td>
		</tr>
	<?php endforeach ?>
</table>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>