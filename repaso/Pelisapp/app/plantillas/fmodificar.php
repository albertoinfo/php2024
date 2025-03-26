
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='MODIFICAR' enctype="multipart/form-data" method="POST">
<table>
<tr><td>Código</td><td>  
 <input name="codigo_pelicula" type="text" value="<?=$peli->codigo_pelicula ?>" readonly > </td></tr>
<tr><td>Título del la película    
</td><td>   <input name="nombre" type="text" value="<?=$peli->nombre ?>" > </td></tr>
<tr><td>Director  
</td><td>  <input name="director" type="text" value="<?= $peli->director ?>"> </td></tr>
<tr><td>Genero    
</td><td>  <input name="genero" type="text" value ="<?= $peli->genero ?>"></td></tr>
<tr><td>    
Imagen Nueva  
</td><td> 
      <img src="<?='app/img/'.$peli->imagen; ?>" alt="Imagen no disponible"><br>
      <input name="imagenold" type="hidden" value="<?= $peli->imagen ?>" > 
      <input name="imagen" type="file">  </td></tr>
</table>
<button type="submit" name="orden" value="Modificar">Modificar</button>
<button type="button" size="10" onclick="javascript:window.location='index.php'" >Volver</button>
</form>

