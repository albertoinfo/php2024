<?php
// Se puede mejorar el código chequeado los valores y si no existen los datos
// se redirige a la página de entrada de datos clubformulario.html con un mensaje por URL o por sesión
session_start();

$_SESSION["nombre"]=$_GET["nombre"];
$_SESSION["edad"]=$_GET['edad'];
$_SESSION["deportes"]=$_GET['deportes'];

header("Location: verdatos.php");
