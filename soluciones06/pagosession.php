<?php
session_start();

$cambiotarjeta = false;
// Si hay cambio de tarjeta
if (isset($_GET['nuevatarjeta'])) {
    $tarjetaactual = $_GET['nuevatarjeta'];
    $_SESSION['tipotarjeta']= $tarjetaactual;
    header("Refresh:3; url=\"".$_SERVER['PHP_SELF']."\"");
    $cambiotarjeta = true;   
}
else {
    if (isset($_SESSION['tipotarjeta'])){
        $tarjetaactual= $_SESSION['tipotarjeta'];
    }
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Forma de pago</title>
</head>
<body>
<div style="text-align:center"> 

<?php if ($cambiotarjeta ) :?>
    <br><h1> Cambiando su tipo de tarjeta...</h1> 
    <img src='imagenes/waiting.gif' />
<?php endif; ?>

<?php if (isset($tarjetaactual) ): ?>
    <H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>
    <img src='imagenes/<?=$tarjetaactual.".gif" ?>' /></a>
<?php else: ?>
    <H2> NO TIENE FORMA  DE PAGO ASIGNADA ES</H2> </br> 
    <br><br>
<?php endif; ?>



<h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br> 
<a href="?nuevatarjeta=cashu"><img  src='imagenes/cashu.gif' /></a>&ensp; 
<a href="?nuevatarjeta=cirrus1"><img  src='imagenes/cirrus1.gif' /></a>&ensp; 
<a href="?nuevatarjeta=dinersclub"><img  src='imagenes/dinersclub.gif' /></a>&ensp; 
<a href="?nuevatarjeta=mastercard1"><img  src='imagenes/mastercard1.gif'/></a>&ensp; 
<a href="?nuevatarjeta=paypal"><img  src='imagenes/paypal.gif' /></a>&ensp; 
<a href="?nuevatarjeta=visa1"><img  src='imagenes/visa1.gif' /></a>&ensp; 
<a href="?nuevatarjeta=visa_electron"><img  src='imagenes/visa_electron.gif'/></a> 		
</div>
</body>
</html>