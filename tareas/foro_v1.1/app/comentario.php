<?php include "cabecera.html" ?>
<?= $msg  ?>
<form name='mensaje' method="get">
Tema <br>
<input type="text" name="tema" placeholder="Introduzca un asunto" size=30><br>
Comentario: <br>
<textarea name="comentario" rows="4" cols="50" placeholder="Introduzca su comentario"></textarea>
<br><br>
<input type="hidden" name="token" value="<?= (isset($_SESSION['token']))? $_SESSION['token']:' '?>" >
<input type="submit" name="orden" value="Detalles">
<input type="submit" name="orden" value="Nueva opinión">
<input type="submit" name="orden" value="Terminar">
</form>
<?php include "pie.html" ?>
