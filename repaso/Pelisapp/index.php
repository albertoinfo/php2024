<?php

session_start();
include_once 'app/config.php';
include_once 'app/controlerPeli.php';
include_once 'app/modeloPeliDB.php';


// Enrutamiento
// Relación entre orden  y función que la va a tratar
// Versión sin POO no manejo de Clases ni objetos
// Rutas en MODO PELICULAS
$rutasPelis = [
    "Inicio"      => "ctlPeliInicio",
    "Nuevo"        => "ctlPeliAlta",
    "Detalles"    => "ctlPeliDetalles",
    "Modificar"   => "ctlPeliModificar",
    "Borrar"      => "ctlPeliBorrar",
    "Cerrar"      => "ctlPeliCerrar",
    "VerPelis"    => "ctlPeliVerPelis",
];



if (isset($_GET['orden'])){
            // La orden tiene una funcion asociada 
            if ( isset ($rutasPelis[$_GET['orden']]) ){
                $procRuta =  $rutasPelis[$_GET['orden']];
            }
            else {
                // Error no existe función para la ruta
                header('Status: 404 Not Found');
                echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                    $_GET['orden'] .
                    '</p></body></html>';
                    exit;
            }
        }
        // No hay orden ruta por defecto
        else {
            $procRuta = "ctlPeliVerPelis";
        }
    
 
// Envio la salida al buffer
ob_start();
// Llamo a la función seleccionada a partir de su nombre
$procRuta();
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido la página principal
$contenido = ob_get_clean();
include_once "app/plantillas/principal.php";





