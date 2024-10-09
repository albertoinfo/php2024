<?php
// Relleno una tabla con valores de 1 a 49
$valores = [];
for ($i = 1; $i <= 49; $i++) {
    $valores[] = $i;
}
// OBTENGO 5+1 INDICES ALEATORIOS ordenados de la tabla (OJO NO VALORES )
$indices = array_rand($valores, 6);

// Me quedo con los valores
// En este caso valores e indices es casi lo mismo $valor == $indice+1
$vbonoloto = [];
foreach ($indices as $i) {
    $vbonoloto[] = $valores[$i];
}
// Obtengo el número complementario y lo elimino de la tabla
$icomplementario = array_rand($vbonoloto); //  Una posición aleatoria
$complementario = $vbonoloto[$icomplementario]; // Valor
unset($vbonoloto[$icomplementario]);            // Elimino

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>BONOLOTO</title>
    <style type="text/css">
		table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
    <b>Sorteo del Bonoloto</b>
    <table border=1>
        <tr>
            <?php foreach ($vbonoloto as $num) : ?>
                <td><?= $num ?></td>
            <?php endforeach ?>
            <td>Complementario <?= $complementario ?></td>
        </tr>
    </table>
    <hr>
    <?php show_source(__FILE__); ?>
    <hr>
    </body>

</html>