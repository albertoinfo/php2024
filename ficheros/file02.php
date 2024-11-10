
<?php 
/*
 *  Añade datos recogidos por un formulario en un fichero 
 *  con formato: nombre | contraseña
 */

// El fichero tiene que tener permisos de lectura y escritura 
define("FICH_DATOS", 'usuarios.txt');

// Muestro el contenido del fichero, si no existe lo crea vacio
 if (!is_readable(FICH_DATOS) ){
     // El directorio donde se crea tiene que tener permisos adecuados
      $fich = @fopen(FICH_DATOS,"w") or die ("Error al crear el fichero.");
      fclose($fich);
 }


// Añado datos al fichero 
if ( !empty($_REQUEST['user']) && ! empty($_REQUEST['clave'])) 
{
    // abrimos el fichero para añadir al final
    // ERROR no chequeo los datos
    $cadena = $_REQUEST['user'] . '|' . $_REQUEST['clave'] . "\n";
    $ok = file_put_contents(FICH_DATOS, $cadena, FILE_APPEND);
    if (! $ok)  echo "ERROR al añadir datos";
    
}


function generarTablaUsuarios (): String {
    $filearray = file (FICH_DATOS);
    $msg = "<table border='1'>";
    $msg .="<tr><th>Usuario</th><th>Contraseña</th</tr>";
    foreach ($filearray as $linea) {
            // "Limpiamos" la línea y la troceamos obtiendo sus componentes
            // Se supone que el caracter | no esta en la contraseña
           $partes = explode('|', htmlspecialchars(trim($linea)));
           // Escribimos la correspondiente fila de la tabla
           $msg .= "<tr><td>$partes[0]</td><td>$partes[1]</td>";  
     }
    $msg .= "</table><br>\n";
    return $msg;

}

?>
<html>
<head>
<title>PHP: Añadir datos a Ficheros</title>
</head>
<body>

<h2> Contenido actual del fichero: </h2>
<?= generarTablaUsuarios() ?>
<h2> Introduzca más datos en el fichero:</h2>
<form  action="<?= $_SERVER['PHP_SELF']?>" method="POST">
Usuario :    <input type='text'     name='user' s ize='10' > &nbsp;
Contraseña : <input type='password' name='clave' size='10' ><br>
<input type='submit' value='Enviar' >
</form>
</body>
</html>
