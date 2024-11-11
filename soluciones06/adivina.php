<?php
session_start();
$contenido ="";

if ( isset($_GET["nuevapartida"])){
    session_destroy();
    header("Refresh:0");
    exit();
}

if (!isset ($_SESSION['numeroOculto'])){
    $_SESSION['numeroOculto'] = random_int(1, 20);
    $contenido .= "<H1> !! BIENVENIDO !! </H1> ";
  }
  else {
      if ( isset ($_REQUEST['numeroUsuario'])){
          $numu = $_REQUEST['numeroUsuario'];
          $numx = $_SESSION['numeroOculto'];
          if ($numx == $numu){
              $contenido .= " Enhorabuena has acertado <br> ";
              $contenido .=" Generando un nuevo número a adivinar .... ";
              header("Refresh:2");
              session_destroy();
          } else 
               if ( $numx > $numu){
                  $contenido .=" No llegas <br> ";
                 } else {
                $contenido .= " Te pasas <br> ";
                 }
          }          
      }
     

?>
<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio Adivinar número </title>
</head>
<body>
<h2>
<?= $contenido ?> <br>
 Adivina un número entre 1 y 20 :
<h2>
<form method="get">
Introduce un número: <input name="numeroUsuario" type="number" size="5">
</form>
<form method="get">
<input type="submit" name="nuevapartidad" value=" Nueva partida ">
</form>




    
