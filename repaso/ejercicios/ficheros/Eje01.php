<?php
// CREA UN NUEVO FICHERO ORDENADO.
// A PARTIR DE DOS FICHEROS QUE EXISTEN EN EL SERVIDOR
define ('FILERESU','resu.txt');


if ( isset($_GET['accion'])){
   $file1 = $_GET['namefile1'];
   $file2 = $_GET['namefile2'];
   $array1 = @file ($file1) or die(" Error al abrir $file1");
   $array2 = @file ($file2) or die(" Error al abrir $file2");
   $nuevo = array_merge($array1,$array2);
   sort($nuevo);
   @file_put_contents(FILERESU,$nuevo) or die (" No se puede generar el fichero de resultados");

   /* RESPUESTA 
   header("Content-Type: txt/plain");
   header('Content-Disposition: attachment; filename="resu.txt"');
   foreach ($nuevo as $linea){
       echo $linea;
   }
   exit();
   */
   

}

function mostrarResultado(){
  $resu = @file(FILERESU) or die ("No se puede leer los resultados");
  echo "<table>";
  foreach ($resu as $linea){
    echo "<tr><td>$linea</tr></td>";
  }
  echo "</table>";
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
<form>
    1º Fichero: <input type="text" name="namefile1" ><br>
    2º Fichero: <input type="text" name="namefile2" ><br>
    <p><input type="submit" name="accion" value=" Ordenar "></p>
</form>
<?php if (isset($nuevo )) :?>
  Contenido de fichero generado:
  <?= mostrarResultado() ?>
<?php endif ?>
</body>
</html>