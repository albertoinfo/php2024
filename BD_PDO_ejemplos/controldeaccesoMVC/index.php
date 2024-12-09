<?php

require_once "app/modelo/User.php";
require_once "app/modelo/AccesoDatos.php";

/* CONTROL DE ACCESO A UNA APLICACIÓN
*  - Valida contra la base de datos
*  - Cierra la sesión pasado 60 segundo sin volver a acceder
*  - Bloquea el acceso tras más de tres fallos consecutivos del mismo usuario
*/

session_start();
$mensaje = "";

// Control de tiempo de la sesión 
if (isset($_SESSION['timeout'])) {
    $horaActual = time();
    // Si han pasado 60 sg cierra la sesión
    if (($horaActual - $_SESSION['timeout']) > 60) {
        session_destroy();
        header("refresh:0");
        exit();
    }
}

// HA ENTRADO EN LA APLICACIÓN Y NO PULSA SALIR

if (isset($_SESSION['Nombre']) &&  $_SERVER['REQUEST_METHOD'] == "GET") {
    $mensaje = " $_SESSION[Nombre] Bienvenido al sistema <br>";
    $mensaje .= " Has entrado $_SESSION[accesos] veces <br>";
    $_SESSION['timeout'] = time(); // Actualizo la temporización
    // SE CARGA LA VISTA GENERAL DE LA APLICACIÓN
    // Por ejemplo se carga una vista con los datos de la tabla Productos
    $db = AccesoDatos::getModelo();
    $tproductos = $db->getProductos();
    include_once 'app/vistas/vistaapp_pro.php';
    exit();
}

// PROCESO FORMULARIO  ORDDEN  ENTRADA O SALIR

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['orden'] == "Salir") {
        session_destroy();
        header("refresh:0");
        exit();
    }

    // CONTROL DE ACCESO A LA APLICACIÓN 

    if ($_POST['orden'] == "Entrar") {
        $login  = $_POST['login'];
        $passwd = $_POST['passwd'];
        $db = AccesoDatos::getModelo();
        $user = $db->getUsuario($login);
        // No existe el usuario
        if ($user == null) {
            $mensaje = "El identificador y/o la contraseña no son correctos.<br>";
        } else {
            if ($user->passwd == $passwd) {
                unset($_SESSION['NombreError']); // No hay usuario con error
                if ($user->bloqueo == 0) {
                    // ACCESO CORRECTO 
                    $_SESSION['Nombre'] = $user->Nombre;
                    $_SESSION['accesos'] = $user->accesos;
                    $db->incrementarAccesos($user->login);
                    // SE CARGA LA PÁGINA CON USUARIO IDENTIFICADO
                    header("refresh:0");
                } else {
                    $mensaje = " Lo sentimos la cuenta $login está bloqueada ";
                }
                // Password incorrecto
            } else {
                $mensaje = "El identificador y/o la contraseña no son correctos**.<br>";
                // Si ha fallado en el mismo usuario incremento los accesos erroneos
                if (isset($_SESSION['NombreError']) && $_SESSION['NombreError'] == $login) {
                    $_SESSION['errorPassword']++;
                    if ($_SESSION['errorPassword'] > 3) {
                        $db->bloquearUsuario($login);
                        $mensaje =  " la cuenta $login ha sido bloqueada pongase en contacto con el administrador.";
                    }
                } else {
                    // Usuario nuevo con error.
                    $_SESSION['NombreError'] = $login;
                    $_SESSION['errorPassword'] = 1;
                }
            }
        }
    }
}
// VISTA DE ACCESO A LA APLICACIÓN 
include_once 'app/vistas/vistaloginapp.php';