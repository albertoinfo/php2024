<?php
session_start();

define('CUENTAFICHERO', 'misaldo.txt');

// NO está definido el token
if (!isset($_SESSION['token'])) {
    header('Location: acceso.php?msg=Error+de+acceso 1');
    exit();
}

// EL token no coincide
if ( $_SESSION['token'] != $_POST['token'] ) {
    header("Location: acceso.php?msg=Error+de+acceso 2");
    exit();
}

// Obtengo el saldo actual
$saldo = file_get_contents(CUENTAFICHERO);

if ($_POST['Orden'] == "Ver saldo"){
    $saldofmt = number_format($saldo,2,',','.');
    $msg = " Su saldo actual es:$saldofmt ";
    header("Location: acceso.php?msg=" . urlencode($msg));
    exit();
}

$importe = $_POST['importe'];
// Compruebo que el saldo es correcto
if (!is_numeric($importe) || $importe <= 0) {
    $msg = "Error: Importe erróneo o Inferior a cero";
    header("Location: acceso.php?msg=" . urlencode($msg));
    exit();
}

$error = false;
switch ($_POST['Orden']) {
    case "Ingreso":
        $saldo += $importe;
        $msg = "Operación realizada";
        break;
    case "Reintegro":
        if ($importe <= $saldo) {
            $saldo -= $importe;
            $msg = "Operación realizada";
        } else {
            $error = true;
            $msg = "Error: Importe superior al saldo";
        }
        break;
}
// Si no hay error
if (!$error) {
    // Actualizo el saldo.
    file_put_contents(CUENTAFICHERO, $saldo);
}
header("Location: acceso.php?msg=" . urlencode($msg));
