<?php
$contenido = false;
if (isset($_GET['directorio'])) {
    if (is_dir($_GET['directorio'])) {
        $tablafichero = infoDir($_GET['directorio']);
        $contenido = "<table border=1><th>Nombre</th><th>Tipo</th><th style='text-align:right'>Tamaño</th>";
        foreach ($tablafichero as $datosf) {
            $contenido .= "<tr><td> $datosf[0] </td><td>" . $datosf[1] . "</td><td style='text-align:right'>" . $datosf[2] . "</td> </tr>";
        }
        $contenido .= "</table>";
    } else {
        $contenido = " Error " . $_GET['directorio'] . " nombre de directorio erróneo.";
    }
}



/*
 * Función de ordenación definida
 */
function ordenporTamaño($a, $b)
{
    return $a[2] - $b[2];
}

/*
 * Devuelve un array  con los valores [nombre , tipo, tamaño ]
 */
function infoDir($dir):array
{
    $resu = [];
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $nombreyruta = $dir . "/" . $file;
            $resu[] = [
                $file,
                mime_content_type($nombreyruta),
                filesize($nombreyruta)
            ];
        }
        closedir($dh);
        // Ordenar de paso la función de comparación.
        usort($resu, 'ordenporTamaño');
    }
    return $resu;
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
	<H1>MOSTRAR DIRECTORIO</H1>


 <!-- Si esta el contenido lo muestro sino muestro el formulario -->
<?php if ($contenido ) : ?>
<?= $contenido ?>
<?php else : ?>
<form>
 Directorio <input type="text" name="directorio">
</form>
<?php endif ?>

</body>
</html>

