<?php
// DEVUELVE AL CLIENTE UN NUEVO FICHERO ORDENADO.
// A PARTIR DE DOS FICHEROS ENVIADOS POR EL CLIENTE

if ( isset($_POST['accion'])){
   $file1 = 'namefile1';
   $file2 = 'namefile2';
   $array1 = obtenerArraydelFichero($file1);
   $array2 = obtenerArraydelFichero($file2);
   $nuevo = array_merge($array1,$array2);
   sort($nuevo);
  
   /* RESPUESTA */
   header("Content-Type: txt/plain");
   header('Content-Disposition: attachment; filename="resu.txt"');
   foreach ($nuevo as $linea){
       echo $linea;
   }
   exit();
}

function obtenerArraydelFichero($fichero):array{
    $tresu = [];
    if (isset($_FILES[$fichero]['name']) && $_FILES[$fichero]['error'] == 0){
        $tresu = file ($_FILES[$fichero]['tmp_name']);
    }
    return $tresu;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
   Unir y ordenar 
  </title>
  <style> button { border: none; }</style>
</head>
<body>
<h1>Unir y ordenar</h1>
<form  enctype="multipart/form-data" method="post" action="<?= $_SERVER['PHP_SELF']?>">
    1º Fichero: <input type="file" name="namefile1" ><br>
    2º Fichero: <input type="file" name="namefile2" ><br>
    <p><input type="submit" name="accion" value=" Ordenar "></p>
</form>
</body>
</html>