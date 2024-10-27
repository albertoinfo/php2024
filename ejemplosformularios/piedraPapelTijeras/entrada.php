<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Piedra, papel, tijera!</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

<b> Seleccione su valor:</b>
<form>
  
  <button name="usuario" value="<?=0 ?>"><span style="font-size: 7rem"> <?=PIEDRA  ?> </span></button>
  <button name="usuario" value="<?=1 ?>"><span style="font-size: 7rem"> <?=PAPEL   ?> </span></button>
  <button name="usuario" value="<?=2 ?>"><span style="font-size: 7rem"> <?=TIJERAS ?> </span></button>
</form>
</body>
</html>