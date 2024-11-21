<?php
$numincidencias = 0;
if (isset($_COOKIE['numincidencias'])) {
    $numincidencias = $_COOKIE['numincidencias'];
}

$error = false;
if ($numincidencias >= 3) {
    $msg ="Superado el número máximo de incidencias.\n";
    $msg .="Espere 2 minutos para introducir otra o reinicie su navegador.";
    $error = true;
} else {
    $numincidencias++;
    setcookie('numincidencias', $numincidencias, time() + 180);
}

if (!$error) {
    $hora = date("d:m:Y H:i");
    $nombre = $_POST['nombre'];
    $resumen = $_POST['resumen'];
    $prioridad = $_POST['prioridad'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $linea = "$hora,$nombre,$resumen,$prioridad,$ip\n";

    $archivo = @file_put_contents('incidencias.txt', $linea, FILE_APPEND);

    if ($archivo) {
        $msg = "Muchas gracias $nombre, se ha anotado su incidencia";
    } else {
        $msg = "Error no se ha podido anotar su incidencia";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de Incidencias</title>
</head>

<body>
    <h2> Gestión de Incidencias:</h2>
    <P>
        <?= $msg ?>
    </P>
</body>

</html>