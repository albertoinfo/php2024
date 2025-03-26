<h2>Listado de Películas</h2>
<table>
	<tr>
	  <th>Id</th>
	  <th>Nombre</th>
		<th>Director</th>
		<th>Género</th>
		<th colspan=3></th>
	</tr>
	<?php foreach ($peliculas as $peli): ?>
		<tr>
			<td><?= $peli->codigo_pelicula ?></td>
			<td><?= $peli->nombre ?></td>
			<td><?= $peli->director ?></td>
			<td><?= $peli->genero ?></td>
			<td><a href="?orden=Modificar&id=<?= $peli->codigo_pelicula ?>">Modificar</a></td>
			<td><a href="?orden=Detalles&id=<?= $peli->codigo_pelicula ?>">Detalles</a></td>
			<td><a href="#" onclick="confirmarBorrar('<?= $peli->nombre ?>','<?= $peli->codigo_pelicula?>');">Borrar</a></td>
		</tr>
	<?php endforeach; ?>
</table>

<br>
<form>
	<button type="submit" name="orden" value="Nuevo"> Cliente Nuevo </button><br>
</form>