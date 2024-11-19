<?php 
session_start();

// Si no existe lo creo con vacio.
if (!isset($_SESSION['nombre'])) {
    $_SESSION['lenguajes'] = [];
    $_SESSION['nombre'] = "";
}

// Me envian nueva selección 
if (isset ($_POST['lenguajes'])){
    $_SESSION['lenguajes']=$_POST['lenguajes'];
}

if (isset($_POST['nombre'])) {
    $_SESSION['nombre'] = $_POST['nombre'];
}


function estaLenguaje($lenguaje):bool {

    return ( in_array($lenguaje,$_SESSION['lenguajes']));
}


$nombre = $_SESSION["nombre"];
// Lista de lenguajes que se pueden seleccionar
$nombreLenguajes = ["Java","Javascript","Php","Python","Perl","C#"];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Selección de personal</title>
</head>
<body>

<h2> Datos de candidato: Paso 2º </h2>
<form  action="seleccion2.php" method="POST">
<fieldset>
	<legend>Datos Profesionales </legend>
    Nombre : <input type="text" name="nombre" value="<?= $nombre ?>"> </br>
Lenguajes de programación:<br>
<!-- Este select se prodría generar por programa -->
<select name="lenguajes[]" multiple="multiple" size=6>
<?php foreach ($nombreLenguajes as $leng): ?>
     <option value="<?=$leng ?>" <?= estaLenguaje($leng)? "selected='selected'" :"" ?> > <?= $leng ?> </option>    
<?php endforeach ?>     
</select><br>
<input type="submit" value="Enviar">
</fieldset>
</form>
</body>
</html>

