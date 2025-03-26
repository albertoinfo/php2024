<?php
session_start();

function mostrarValores(){

    if (!isset($_SESSION["nombre"])) {
        return "ERROR:No hay datos almacenados";
    }
    
    $nombre=$_SESSION["nombre"];
    $edad=$_SESSION["edad"];
    if (isset($_SESSION["deportes"])) {
      $deportes=$_SESSION["deportes"];
      $listadeportes=implode(", ",$deportes);
    } else {
        $listadeportes="Ninguno";
    }
    return "Nombre: $nombre <br> Edad: $edad <br> Deportes: $listadeportes";
}

function mostrarEliminados(){
   session_destroy();
   return "Sus datos han sido eliminados";
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- No se envian datos -->
<?php if (!isset($_GET["accion"] )) :?>
<h2> Sus datos han sido almacenados </h2>
<form action='verdatos.php' method='get'>
        <input type='submit' name='accion' value='Consultar valores'>
        <input type='submit' name='accion' value='Anular valores'>
</form>
<?php elseif($_GET["accion"]=='Consultar valores') :?>
    <h2> Estos son sus datos </h2>
     <?= mostrarValores() ?>
<?php elseif ($_GET["accion"]=='Anular valores') :?>
    <h2><?= mostrarEliminados() ?></h2>
<?php endif ?>
<br>
<br>
<a href='clubformulario.html'>Volver a introducir sus datos</a>
</body>
</html>