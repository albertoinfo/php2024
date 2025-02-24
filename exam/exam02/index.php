<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';
// Div con contenido
$contenido = "";
$msg = "";


if (!isset($_SESSION["accesoconcedido"])) {
    if (!isset($_GET["pin"])) {
        include "app/layout/formulariopin.php";
        exit();
    } else if ($_GET["pin"] != "12345") {
        $msg = "Introduzca un pin correcto.";
        include "app/layout/formulariopin.php";
        exit();
    } else {
        $_SESSION["accesoconcedido"] = "si";
        $_SESSION["timeout"] = time();
        //header("Refresh:0");
    }
} 

if ( time() - $_SESSION["timeout"] > 300 ) {
    accionTerminar();
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if (isset($_GET['orden'])) {
            switch ($_GET['orden']) {
                case "Nuevo":
                    accionAlta();
                    break;
                case "Borrar":
                    accionBorrar($_GET['id']);
                    break;
                case "Modificar":
                    accionModificar($_GET['id']);
                    break;
                case "Detalles":
                    accionDetalles($_GET['id']);
                    break;
                case "MasSaldo":
                    if (isset ($_GET['tuser'])){
                        accionMasSaldo($_GET['tuser']);
                    }
                    break;
                case "Bloquear":
                    if ( isset($_GET['tuser'])){
                    accionBloquear($_GET['tuser']);
                    } else {
                    accionBloquear([]);    
                    }
                    break;
                case "Terminar":
                    accionTerminar();
                    break;
            }
        }
    }
    // POST Formulario de alta o de modificación
    else {
        if (isset($_POST['orden'])) {
            switch ($_POST['orden']) {
                case "Nuevo":
                    accionPostAlta();
                    break;
                case "Modificar":
                    accionPostModificar();
                    break;
                case "Detalles":; // No hago nada
            }
        }
}

$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";
