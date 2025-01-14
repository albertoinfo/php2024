<?php 
include_once 'AccesoDatos.php';
include_once 'Producto.php';



$ac = AccesoDatos::initModelo();


if  (isset($_POST['orden']) && isset($_POST["tproductos"])){

	 if ( isset($_COOKIE["precioscambiados"])){
	 	$msg=" Solo se puede hacer una rebaja al día ";
	 } else {
     setcookie("precioscambiados","si",time()+3600*24);
    $tProductoNoActualizar=$_POST["tproductos"];
    $ac->actualizarPrecios2($tProductoNoActualizar);
	}
}
// Obtiene la lista de productos actual 
$tproductos = $ac->obtenerListaProductos();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" style="width: 600px;">
		<div id="header">
			<h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
		</div>
		<div id="content">
		<?php if (isset($msg)): ?>
		  <h2> <?= $msg ?> </h2>
		<?php else: ?>
		<form name='entrada' method="post" >
			    <table border=1>
			    <tr>
			    <th></th>
			    <th>no</th>
			    <th >Descripción</th>
			    <th>stock</th>
			    <th>precio</th>
			    </tr>
			    <?php  foreach ($tproductos as $pro): ?>
			    <tr>
				<td><input type="checkbox" name="tproductos[]" value="<?=$pro->producto_no ?>"></td>
				<td><?=$pro->producto_no ?></td>
				<td><?=$pro->descripcion  ?></td>
				<td><?=$pro->stock_disponible ?></td>
				<td><?=$pro->precio_actual ?></td>
				<tr>
				<?php endforeach; ?>
				</table>
				
				<input type="submit" name="orden" value="ACTUALIZAR">
			</form>
		</div>
		<?php endif; ?>
	</div>
</body>
</html>