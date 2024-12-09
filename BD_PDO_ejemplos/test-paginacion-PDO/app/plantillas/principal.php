<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CLIENTES PAGINADO</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" >
<div id="header">
<h1>LISTADO DE CLIENTES</h1>
</div>
<div id="content">

<table>
<tr>
   <th>id</th>
   <th>first_name</th>
   <th>email</th>
   <th>gender</th>
   <th>ip_address</th>
   <th>teléfono</th>
   <tr>
   <?php foreach ( $tclientes as $cliente) :?>
    <tr>
        <td> <?= $cliente->id ?> </td>
        <td> <?= $cliente->first_name ?> </td>
        <td> <?= $cliente->last_name ?> </td>
        <td> <?= $cliente->gender ?> </td>
        <td> <?= $cliente->ip_address ?> </td>
        <td> <?= $cliente->telefono ?> </td>  
    </tr>
   <?php endforeach ?>

</table>

<form>
<button name="orden" value="Primero"> << </button>
<button name="orden" value="Anterior"> < </button>
<button name="orden" value="Siguiente"> > </button>
<button name="orden" value="Ultimo"> >>  </button>
</form>
</div>
</div>
</body>