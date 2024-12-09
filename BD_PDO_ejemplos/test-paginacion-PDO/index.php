<?php
require_once "app/Cliente.php";
require_once  "app/AccesoDAO.php";
session_start();

if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}

define('FPAG', 10); // Número de clientes por página

$db = AccesoDAO::getModelo();
$total = $db->totalClientes();
 
// Calcula cual es la última posición
if ( $total % FPAG == 0){
    $posfin = $total - FPAG;
} else {
    $posfin = $total - $total % FPAG;
}




// Primer elemento a mostrar
$primero = $_SESSION['posini'];
if (isset($_GET['orden'])) {

    switch ($_GET['orden']) {
        case "Primero":
            $primero = 0;
            break;
        case "Siguiente":
            $primero += FPAG;
            if ($primero > $posfin) $primero = $posfin;
            break;
        case "Anterior":
            $primero -= FPAG;
            if ($primero < 0) $primero = 0;
            break;
        case "Ultimo":
            $primero = $posfin;
            break;
    }
    $_SESSION['posini'] = $primero;
}


$tclientes = $db->getClientes($primero, FPAG);
include "app/plantillas/principal.php";
