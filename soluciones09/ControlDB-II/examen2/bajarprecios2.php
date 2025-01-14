<?php 
include_once 'AccesoDatos.php';
include_once 'Producto.php';

$ac = AccesoDatos::initModelo();


if  (isset($_POST['orden'])){
    $tProductoNoActualizar=[];
    foreach ($_POST as $clave => $valor ) {
        if (is_numeric($clave)){
            $tProductoNoActualizar[]=$clave;
        }
    }
    $ac->actualizarPrecios($tProductoNoActualizar);
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
			<h1>BAJAR PRECIOS</h1>
		</div>
		<div id="content">
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
				<td><input type="checkbox" name="<?=$pro->producto_no ?>"></td>
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
	</div>
</body>
</html>
