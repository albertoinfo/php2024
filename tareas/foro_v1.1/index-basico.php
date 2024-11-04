
<?php 
// CONTROLADOR BÁSICO SIN SESIONES
//////////////////////////////////////
// PRIMERA APROXIMACIÓN AL MODELO VISTA CONTROLADOR. 
// Funciones auxiliars Ej- usuarioOK
include_once 'app/funciones.php';
$msg =""; // Valor por defecto a pasar en los formularios

if ( !isset($_REQUEST['orden']) ){
    include_once 'app/entrada.php';
} 
else {
    switch ($_REQUEST['orden']){
        
        case "Entrar":
            // Chequear usuario
            if ( isset($_REQUEST['nombre']) && isset($_REQUEST['contraseña']) && 
                 usuarioOK($_REQUEST['nombre'], $_REQUEST['contraseña'] )) {
               $msg = " Bienvenido <b>".$_REQUEST['nombre']."</b><br>";
               include_once  'app/comentario.php';
            }
            else {
                $msg = " <br> Usuario no válido </br>";
                include_once 'app/entrada.php';
            
            }
            break;
            
        case "Nueva opinión":
            $msg = " Nueva opinión <br>";
            include_once  'app/comentario.php';
            break;
        case "Detalles": // Mensaje y detalles
            $msg = "Detalles de su opinión";
            limpiarEntrada($_REQUEST['comentario']);
            limpiarEntrada($_REQUEST['tema']);
            include_once 'app/comentariorelleno.php';
            break;
        case "Terminar": // Formulario inicial
            include_once 'app/entrada.php';
    }
    
}

