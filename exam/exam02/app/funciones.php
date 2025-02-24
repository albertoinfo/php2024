<?php
include_once 'app/config.php';
include_once 'app/AccesoDatos.php';



// MUESTRA TODOS LOS USUARIOS
function mostrarDatos (){
    
    $titulos = [ " ", "Nombre","login","Password","bloqueo","Saldo","Comentario"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tuser = $db->getUsuarios();
    foreach ($tuser as $user) {
        $msg .= "<tr>";
        $msg .= "<td><input type='checkbox' name='tuser[]' value='$user->login'";
        $msg .=  " ></td>";
        $msg .= "<td>$user->nombre</td>";
        $msg .= "<td>$user->login</td>";
        $msg .= "<td>$user->password</td>";
        $msg .= "<td>$user->bloqueo</td>";
        $msg .= "<td>$user->saldo</td>";
        $msg .= "<td>$user->comentario</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$user->nombre','$user->login');\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$user->login\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$user->login\" >Detalles</a></td>\n";
        
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

