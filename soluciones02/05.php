<?php

function generarHTMLTable($filas, $columnas, $borde, $contenido)
{
    echo "<table style=\" border:$borde px solid black; border-collapse:collapse; \">";
    for ($i = 0; $i < $filas; $i ++) {
        echo "<tr  style='border:$borde' px solid black; border-collapse:collapse; \">";
        for ($j = 0; $j < $columnas; $j ++) {
            echo "<td style=\" border:$borde". "px solid black; border-collapse:collapse; \"> $contenido </td>";
        }
        echo "</tr>";   
    }
    echo "</table>";
}

?>


<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 5º Generar tablas </title>
</head>
<body>

<?= generarHTMLTable(4,3,5,"Hola Mundo"); ?>
<hr>
<?= generarHTMLTable(2,6,2,"Hola de nuevo"); ?>
<hr>

<hr>
</body>
</html>
