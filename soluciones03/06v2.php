<?php
// SEGUNDA VERSIÓN CON USANDO UASORT
/* funcion uasort (Ordenación mediante una función de usuario, manteniendo las claves) */
// Incluyo la table de paises
include_once 'infopaises.php';

function ordenaPaisPorPoblacion($pais1, $pais2)
{

    return ($pais1['Poblacion'] - $pais2['Poblacion']);
}

// Ordeno utilizando la funcion definida
uasort($paises, 'ordenaPaisPorPoblacion');

// Obtengo la clave del último elemento del array 
$pais_max = array_key_last($paises);
$max = $paises[$pais_max]["Poblacion"];

// Nº de habitantes con datos formateados
$habitantes = number_format($max, 0, ',', '.');

// Obtengo sus ciudades
$listaciudades = $ciudades[$pais_max];

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Paises y ciudades</title>
    <style type="text/css">
		table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
            padding: 5px;
        }
		
	</style>
</head>

<body>
    <p>
        País con más población: <?= $pais_max ?> con <?= $habitantes ?> habitantes<br />
    <table>
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