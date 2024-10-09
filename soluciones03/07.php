<?php
include_once 'infopaises.php';


/**
 *  Función axilizar que devuelve una cadena con la información de un pais
 *  de las tablas de infopaises.php (global)
 */
function obtenerInfoPais($pais): String
{
    global $paises;
    global $ciudades;
    $infopais = "";
    $infopais .= "País : " . $pais . " , con " . number_format($paises[$pais]['Poblacion'], 0, ',', '.') . " habitantes <br/>";
    $infopais .= "Lista de Ciudades: ";
    foreach ($ciudades[$pais] as $ciudad) {
        $infopais .= $ciudad . ", " ;
    }
    rtrim($infopais, ", "); // Elimino el último caracter ,
    return $infopais;
}
// Me devuelve un array con dos claves aleatorias de la tabla de paises
$paiselegidos = array_rand($paises, 2);
$primerpais = $paiselegidos[0];
$segundopais = $paiselegidos[1];


?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Info Paises al azar</title>
</head>

<body>

    <h2> Primer pais: <?= $primerpais ?> </h2>
    <?= obtenerInfoPais($primerpais) ?>
    <br />Enlace a google maps:
    <a href="https://www.google.es/maps/place/<?= $primerpais ?>">Maps</a><br>


    <h2> Segundo pais: <?= $segundopais ?> </h2>
    <?= obtenerInfoPais($segundopais) ?>
    <br />Enlace a google maps:
    <a href="https://www.google.es/maps/place/<?= $segundopais ?>">Maps</a><br>

    <hr>
    <?php show_source(__FILE__); ?>
    <hr>
</body>

</html>