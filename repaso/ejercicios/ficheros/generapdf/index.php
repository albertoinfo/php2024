<?php
// Instalar MPDF: $composer require mpdf/mpdf
// Ajustar permisios en el directorio tmp de mpdf
require_once __DIR__ . '/vendor/autoload.php';
$tablahtml="";
if ( isset($_POST['accion'])){
     $filearray = obtenerArraydelFicheroCSV('nombrecsv'); 
     $tablahtml = arraytoHTML($filearray);
     $mpdf = new \Mpdf\Mpdf();
     $mpdf->WriteHTML($tablahtml);
     $mpdf->Output();
     exit();
}

function arraytoHTML($tabla){
    $msg ="<table border=1>";
    foreach ( $tabla as $linea){
        $msg .= "<tr>";
        foreach ($linea as $celda){
            $msg .= "<td>$celda </td>";
        }
        $msg .= "</tr>";
    }
    $msg .= "</table>";
    return $msg;
}


function obtenerArraydelFicheroCSV($fichero):array{
    $tresu = [];
    if (isset($_FILES[$fichero]['name']) && $_FILES[$fichero]['error'] == 0){
        echo $_FILES[$fichero]['type'];

        $fp = fopen ($_FILES[$fichero]['tmp_name'],"r");
        while ($fila = fgetcsv($fp) ){
            $tresu[] = $fila;
        }
        fclose($fp);
    }
    return $tresu;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
   Generar PDF
  </title>
  <style> button { border: none; }</style>
</head>
<body>
<h1>Indique el archivo csv </h1>
<form  enctype="multipart/form-data" method="post" action="<?= $_SERVER['PHP_SELF']?>">
    Fichero CSV: <input type="file" name="nombrecsv" ><br>
    <p><input type="submit" name="accion" value=" Ordenar "></p>
</form>
<?= $tablahtml ?>
</body>
</html>