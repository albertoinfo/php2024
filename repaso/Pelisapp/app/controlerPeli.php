<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------

include_once 'config.php';
include_once 'modeloPeliDB.php'; 

/**********
/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlPeliInicio(){
    include 'plantillas/todo.php';
   }

/*
 *  Muestra y procesa el formulario de alta 
 */

function ctlPeliAlta (){
    include 'plantillas/todo.php';
}   

/*
 *  Muestra y procesa el formulario de Modificación 
 */
function ctlPeliModificar (){
    if  ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if ( isset($_GET['id'])){
            $db = ModeloPeliDB::getModelo();
            $peli = $db->getbyId($_GET['id']);
            include_once 'plantillas/fmodificar.php';
        }
    // Modificar -----<
    } else {
        $peli = new Pelicula();
        $peli->codigo_pelicula = $_POST['codigo_pelicula'];
        $peli->nombre   = $_POST['nombre'];
        $peli->director = $_POST['director'];
        $peli->genero   = $_POST['genero'];
        if ( !empty($_FILES['imagen']['name']) ){
            if ( $msg = ErrordescargarPeli()){
                include_once 'plantillas/fmodificar.php';
                return;
               } else {
                $peli->imagen = $_FILES['imagen']['name'];     
               }
            } else {
                // Si no se ha subido imagen, se mantiene la que ya tenía
                $peli->imagen = $_POST['imagenold'];
            }
        $db = ModeloPeliDB::getModelo();
        $peli = $db->Update($peli);
        $_SESSION['msg'] = " Película actualizada ";
        ctlPeliVerPelis();
        }
        
    }  


function ErrordescargarPeli(){
    $nombreFichero   =   $_FILES['imagen']['name'];
    $tipoFichero     =   $_FILES['imagen']['type'];
    $tamanioFichero  =   $_FILES['imagen']['size'];
    $temporalFichero =   $_FILES['imagen']['tmp_name'];
    $errorFichero    =   $_FILES['imagen']['error'];
    $msg=false;
    if ($errorFichero != 0 ){
        $msg="Error al subir el fichero $nombreFichero <br>";
    } else 
    if ($tipoFichero != "image/jpeg" && $tipoFichero != "image/png") {
        $msg =" Error el fichero no es una imagen jpeg o png";
    } else
    if (! move_uploaded_file($temporalFichero,'app/img/'. $nombreFichero )) {
       $msg= "ERROR: el fichero no se puede copiar en imagenes";
    }
    return $msg;
}


/*
 *  Muestra detalles de la pelicula
 */

function ctlPeliDetalles(){
    $db = ModeloPeliDB::getModelo();
    $peli = $db->getbyId($_GET['id']);
    include_once 'plantillas/detalle.php';

}
/*
 * Borrar Peliculas
 */

function ctlPeliBorrar(){
    include 'plantillas/todo.php';
}

/*
 * Cierra la sesión y vuelca los datos
 */
function ctlPeliCerrar(){
    session_destroy();
    modeloPeliDB::closeDB();
    header('Location:index.php');
}

/*
 * Muestro la tabla con los usuario 
 */ 
function ctlPeliVerPelis (){
    // Obtengo los datos del modelo
    $db = ModeloPeliDB::getModelo();
    $peliculas = $db->getAll();
    // Invoco la vista 
    include_once 'plantillas/verpeliculas.php';
   
}