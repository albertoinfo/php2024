<?php
  session_start(); // Inicia la sesión

  // La primera vez que se carga la página, se inicializan
  // las variables de sesión a y b a cero.
  if(!isset($_SESSION['a'])) {
    $_SESSION['a'] = 0;
  }

  if(!isset($_SESSION['b'])) {
    $_SESSION['b'] = 0;
  }
  
  // Si llega una petición para cambiar los valores
if (isset($_POST['accion'])){
    switch($_POST['accion']) {
      case "incA" :
        $_SESSION['a']++;
        break;
      case "decA" :
        $_SESSION['a']--;
        break;
      case "incB" :
        $_SESSION['b']++;
        break;
      case "decB" :
        $_SESSION['b']--;
        break;
      case "cierra":
        // Cierra la sesion
        session_destroy();
        header("refresh: 0;"); // refresca la página
        die(); // No hace falta continuar.
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <h1>
    a = <?= $_SESSION['a'] ?><br>
    b = <?= $_SESSION['b'];?>
    </h1> 

    <form action="#" method="POST">
      <select name="accion">
        <option value="incA"  >Incrementa a</option>
        <option value="decA"  >Decrementa a</option>
        <option value="incB"  >Incrementa b</option>
        <option value="decB"  >Decrementa b</option>
        <option value="cierra">Cierra sesión</option>
      </select>
      <input type="submit" value="OK">
    </form>
  </body>
</html>