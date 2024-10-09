<?php
// PRIMERA VERSIÓN CALCULO EL MÁXIMO MANUALMENTE
// Incluyo las tablas con datos 
include_once 'infopaises.php';

// Obtengo el pais con mas población
$max = 0;
$pais_max = "";
foreach ($paises as $pais => $info) {
    if ($info['Poblacion'] > $max) {
        $pais_max = $pais;
        $max = $info['Poblacion'];
    }
}
// Nº de habitantes con datos formateados
$habitantes = number_format($max, 0, ',', '.');

// Obtengo sus ciudades
$listaciudades = $ciudades[$pais_max];

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Paises y ciudades</title>
</head>

<body>
    <p>
        País con más población: <?= $pais_max ?> con <?= $habitantes ?> habitantes<br />
    <table border=1>
        <tr>
            <td> <b>Ciudades:</b> </td>
            <?php foreach ($listaciudades as $ciudad) : ?>
                <td> <?= $ciudad ?></td>
            <?php endforeach ?>
        </tr>
    </table>
    </p>
    <hr>
    <?php show_source(__FILE__); ?>
    <hr>
</body>

</html>