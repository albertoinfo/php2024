<?php
session_start();




// Nuevo cliente: valores iniciales en la sesión
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = [];
}

// No hay cliente todavía
if (!isset($_SESSION['cliente'])) {
    require_once('bienvenida.php');
    exit(); // Termina el programa
}


// Proceso las acciones 
if (isset($_POST["accion"])) {


    if ($_POST["accion"] == " Anotar ") {
        $cantidad = $_POST['cantidad'];
        $fruta    = $_POST['fruta'];
        // Evito cantidades negativas
        if ($cantidad > 0) {
            // Existe un pedido de fruta previo
            if (isset($_SESSION ['pedidos'][$fruta]) ) {
                $_SESSION['pedidos'][$fruta] += $cantidad;
            } else {
                $_SESSION['pedidos'][$fruta] = $cantidad;
            }
        }
    }

    // Anulo la fruta 
    if ($_POST["accion"] == " Anular ") {
        unset($_SESSION['pedidos'][$_POST['fruta']]);
    }

    // Muestro el pedido y cierro la sesión
    if ($_POST["accion"] == " Terminar ") {
        $compraRealizada = htmlTablaPedidos();
        require_once("despedida.php");
        session_destroy();
        exit;  // Termina el programa
    }
}

$compraRealizada = htmlTablaPedidos();
require_once('compra.php');


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    $msg = "";
    if (count($_SESSION['pedidos']) > 0) {
        $msg .= "Este es su pedido :";
        $msg .= "<table style='border: 1px solid black;'>";
        foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
            $msg .= "<tr><td><b>" . $fruta . "</b><td></td><td>" . $cantidad . "</td></tr>";
        }
        $msg .= "</table>";
    }
    return $msg;
}
