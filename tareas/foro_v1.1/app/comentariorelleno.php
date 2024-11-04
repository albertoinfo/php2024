<?php include "cabecera.html"; ?>
<?= $msg  ?>
<form name='mensaje' method="get">
Tema<br>
 <input type="text" name="tema" size=30 
   value="<?=(isset($_REQUEST['tema']))?$_REQUEST['tema']:''?>" ><br>
Comentario: <br>
<textarea name="comentario" rows="4" cols="50"><?=(isset($_REQUEST['comentario']))?$_REQUEST['comentario']:''?></textarea>
<br><br>
<input type="hidden" name="token" value="<?= (isset($_SESSION['token']))? $_SESSION['token']:' ' ?>" >
<input type="submit" name="orden" value="Detalles">
<input type="submit" name="orden" value="Nueva opinión">
<input type="submit" name="orden" value="Terminar">
</form>
<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen            ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= contarPalabras    ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraMasrepetida  ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= palabraMasrepetida($_REQUEST['comentario']) ?></td></tr>
</table>
</div>

<?php include "pie.html"; ?>
