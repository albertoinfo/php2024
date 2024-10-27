<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Piedra, papel, tijera!</title>
</head>
<body>
<body>
<h1>¡Piedra, papel, tijera!</h1>


    <table>
      <tr>
        <th>USUARIO</th>
        <th>ORDENADOR</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><?= $usuario; ?></span></td>
        <td><span style="font-size: 7rem"><?= ($ordenador == PIEDRA)?PIEDRA2:$ordenador; ?></span></td>
      </tr>
      <tr>
        <th colspan="2"><?= $msg[calcularGanador($usuario,$ordenador)] ?></th>
      </tr>
    </table>
</body>
</body>
</html>