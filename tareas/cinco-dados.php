<?php

/**
 * Cinco dados - cinco-dados.php
 *
 * @author Alberto López
 *
 */
define('NUMDADOS', 5);

// Caracteres UTF8( de dados 1 a 6)
$tcharDados = [
  1 => "&#9856;", 2 => "&#9857;",
  3 => "&#9858;", 4 => "&#9859;",
  5 => "&#9860;",  6 => "&#9861;"
];



/* Funciones auxiliares */


function generarDados($numdados): array
{
  $valores = [];
  for ($i = 0; $i < $numdados; $i++) {
    // Valores del dado
    $valores[] = random_int(1, 6);
  }
  return $valores;
}

function calcularPuntos( array $tdados): int
{
  
  $sum = array_sum($tdados);
  // Quito el valor máximo y mínimo
  $sum = $sum - max($tdados) - min($tdados);
  return $sum;
}

// Otra forma de calcular
function calcularPuntos2( array $tdados): int
{
  sort($tdados);
  array_shift($tdados); // Quito el primero
  array_pop($tdados);   // Quito el último
  $sum = array_sum($tdados);
  return $sum;
}



function generarMensajeGanador($puntos1, $puntos2): string
{
  $msg = "";
  if ($puntos1 == $puntos2) {
    $msg = " Han empatado los jugadores";
  } else {
    if ($puntos1 > $puntos2) {
      $msg = " Ha Ganado el Jugador 1";
    } else {
      $msg = " Ha Ganado el Jugador 2";
    }
  }
  return $msg;
}

// Función que genera un mensaje para múltiples ganadores
// Recibe un lista de parámetros variables
function generarMensajeGanadorvar(...$puntos): string
{
  // Máximo de puntos 
  $maxpuntos = max ($puntos);
  // Lista de jugadores con esos puntos, puede existir empate
  $ganadores=[];
  foreach ( $puntos as $clave => $valor){
    if ( $valor == $maxpuntos){
       $ganadores[] = $clave;
    }
  }
  
  if ( count($ganadores) > 1){
    $msg = " Han empatado los jugadores ";
    foreach ($ganadores as $value){
      $msg .= ($value+1)." ";
    }
  } else {
      $msg = " Ha Ganado el Jugador ". ($ganadores[0]+1);
    }
  return $msg;
}

function generarImagenes( array $tdados): string
{
  $msg = "";
  global $tcharDados;
  foreach ($tdados as $valor) {
    $msg .= "<span style='font-size:100px;'>" . $tcharDados[$valor] . "</span>";
  }
  return $msg;
}

/* Programa principal */

$dadosJugador1 = generarDados(NUMDADOS);
$dadosJugador2 = generarDados(NUMDADOS);
$dadosJugador3 = generarDados(NUMDADOS);
$puntosJugado1 = calcularPuntos($dadosJugador1);
$puntosJugado2 = calcularPuntos($dadosJugador2);
$puntosJugado3 = calcularPuntos($dadosJugador3);

$msgGanador    = generarMensajeGanadorvar($puntosJugado1, $puntosJugado2,$puntosJugado3);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>
    Cinco dados.

  </title>

</head>

<body>
  <h1>Cinco dados</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>


  <table>
    <tbody>
      <tr>
        <th>Jugador 1</th>
        <td style="padding: 10px; background-color: red;">
          <?= generarImagenes($dadosJugador1); ?>

        </td>
        <th> <?= $puntosJugado1; ?> puntos</th>
      </tr>
      <tr>
        <th>Jugador 2</th>
        <td style="padding: 10px; background-color: blue;">
          <?= generarImagenes($dadosJugador2); ?>

        </td>
        <th> <?= $puntosJugado2 ?> puntos</th>
      </tr>
      <tr>
        <th>Jugador 3</th>
        <td style="padding: 10px; background-color: green;">
          <?= generarImagenes($dadosJugador3); ?>

        </td>
        <th> <?= $puntosJugado3 ?> puntos</th>
      </tr>
      <tr>
        <th>Resultado</th>
        <td><?= $msgGanador ?></td>
      </tr>
    </tbody>
  </table>

  <footer>
    <p><u>By Alberto López</u></p>
  </footer>
</body>

</html>