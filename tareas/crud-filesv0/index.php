<?php
// VERSIÓN BÁSICA DE UN CRUD SOBRE FICHEROS
// UTIZANDO UNA TABLA EN LA SESION COMO ALMACENAMIENTO TEMPORAL
//  Hasta que no se sale de la sesión no se vuelvan los cambios.

session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

// Tabla de usuarios
if (!isset ($_SESSION['tuser'])){
    $_SESSION['tuser'] = cargarDatos();  
}

// Div con contenido y mensaje
$contenido="";
 $_SESSION['msg']="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
        checkCSRF(); // Chequeo la firma 
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Volver":; // No hago nada
         }
    }
}
// Contenido por defecto es mostrar la tabla de usuarios
$contenido .= mostrarDatos();
// Muestro la página principal con un mensaje si existe.
$msg = $_SESSION['msg'];
include_once "app/layout/principal.php";

