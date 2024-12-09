<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 400px;">
<div id="header">
<h1> SISTEMA EN FUNCIONAMIENTO</h1>
</div>
<div id="content">
    <?= $mensaje ?>
    <br>
    <table>
    <tr><th>id</th><th>nombre</th><th>stock</th><th>precio</th><tr>
    <?php foreach ( $tproductos as $producto): ?>
    <tr>
    <td><?= $producto->id ?></td>
    <td><?= $producto->nombre ?></td>
    <td><?= $producto->stock ?></td>
    <td><?= $producto->precio ?></td>
    </tr>
    <?php endforeach ?>
    </table>
    <br>
    <form method="POST">
     <input type="submit" name="orden" value="Salir">
    </form>
    </div>
    </body>
    </html>
