<?php
session_start();


// Establecer tiempo de vida de la sesión en segundos
define('INACTIVIDAD',10); // 10 segundos
// Comprobar si $_SESSION["timeout"] está establecida
if(isset($_SESSION["timeout"])){
    // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
    $tiempopasado = time() - $_SESSION["timeout"];
    if($tiempopasado > INACTIVIDAD){
        session_destroy();
        echo " <h1> SESION CANCELADA </h1> ";
        echo " <a href=\"acceso.php\">Volver</a>";
        echo " <a href=\" ".__FILE__."\">Volver</a>";
        exit();
    }
}

$_SESSION["timeout"] = time();

if (!isset($_SESSION["veces"])){
    $_SESSION["veces"]=0;
}
$_SESSION["veces"]++;


echo "Has entrado ". $_SESSION["veces"]." veces <br>";
echo date('h:i:s')."<br>";
