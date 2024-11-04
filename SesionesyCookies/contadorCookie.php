
<?php
// CONTADOR DE VISITAS MEDINATE COOKIE ( Dura 30 dias sin borrarse aprox)
$nvisitas = 0;
// Si existe el cookie lo muestro
if (isset($_COOKIE["visitas"])){
    $nvisitas = $_COOKIE["visitas"];
}
$nvisitas++;
// Vuelvo a fijar el valor de cookie válido por un mes
setcookie("visitas", $nvisitas, time() + 30*24*3600);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
      echo "Visitas: $nvisitas ";
    ?>
  </body>
</html>



