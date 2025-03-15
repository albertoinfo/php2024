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
    include 'plantillas/todo.php';
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