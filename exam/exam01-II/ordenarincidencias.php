<?php
// Ordena el archivo de incidencias por prioridad 
// Usando una tabla auxiliar y la función file()
// Sin alterar el orden de los campos en el archivo
function ordenarPorPrioridad($a, $b) {
    return $a[3] <=> $b[3];
}

$incidencias = file('incidencias.txt');
$aux = [];
foreach ($incidencias as $linea) {
    $aux[]= explode(',', $linea);
}   
usort($aux,'ordenarPorPrioridad');

// Tabla con los valores agrupados por líneas
$auxgrabar = [];
foreach ($aux as $linea) {
    $auxgrabar[] = implode(',', $linea);
}

$archivo = @file_put_contents('incidenciaso.txt', $auxgrabar);
if ($archivo) {
    $msg = "Incidencias ordenadas por prioridad";
} else {
    $msg = "Error no se ha podido ordenar las incidencias";
}   

echo $msg;