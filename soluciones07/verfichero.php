
<?php
$contenido = false;
if (isset($_GET['fichero'])) {
    if (is_file($_GET['fichero']) && is_readable($_GET['fichero']) ) {
        $contcar = 0;
        $líneas = file($_GET['fichero']);
        $contenido = "<code><pre>";
        // Recorro el array, su clave por defecto es el indice del array
        // empezando por 0
        foreach ($líneas as $num_línea => $línea) {
            $contenido .=  sprintf("%4d :",($num_línea +1));
            // Escapar a las marcas html
            $contenido .=  htmlspecialchars($línea);
            $contcar += strlen($línea);
        }
        $contenido .= "</pre></code>";
        $contenido .=" Número de líneas     = ".count($líneas)." <br>";
        $contenido .=" Número de caracteres = $contcar <br>"; 
        $contenido .=" Número de caracteres =". filesize($_GET['fichero'])."<br>";
        
    } else {
        $contenido = " Error : El fichero ".$_GET['fichero']." no existe o no tiene permisos de lectura.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<H1>MOSTRAR FICHERO</H1>

<!-- Si esta el contenido lo muestro sino muestro el formulario -->
<?php if ($contenido ) : ?>
<?= $contenido ?>
<?php else : ?>
<form>
Fichero a mostrar: <input type="text" name="fichero">
</form>
<?php endif ?>

</body>
</html>

