<?php

// Caracteres asociadas a las logos 
// PIEDRA (Puño derecho)
// PIEDRA2 (Puño Izquierdo / jugador 2 ) 
define ('PIEDRA',   "&#x1F91C;");
define ('PIEDRA2',  "&#x1F91B;");
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;" );

// Tabla de mensajes en función del ganador

$tmsg = [
      "¡Empate !",
      " Ha ganado el jugador 1",
      " Ha ganado el jugador 2"
];

/**
 *  Calcula el ganador usando una tabla
 *  Parámetros: Dos valores PIEDRA (0), PAPEL(1) O TIJERA(2)
 *  Resultado: 0 (Empate),1 (1 Gana jugador 1), 2 (Gana jugador 2)   
 *  
 */
function calcularGanadorTabla (int $valor1, int $valor2): int{
    
  static $ganador = [[0,2,1],[1,0,2],[2,1,0]];

  return $ganador[$valor1][$valor2];
}


// 0 -> PIEDRA, 1 -> PAPEL 2-> TIJERAS
$valores = [PIEDRA,PAPEL,TIJERAS];
$num1 = rand(0,2);
$num2 = rand(0,2);
$jugador1 = $valores[$num1];
$jugador2 = $valores[$num2];
$jugador2 = ($jugador2 == PIEDRA)?PIEDRA2:$jugador2;

$mensaje = $tmsg[calcularGanadorTabla($num1,$num2)];


?>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <table>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><?= $jugador1; ?></span></td>
        <td><span style="font-size: 7rem"><?= $jugador2; ?></span></td>
      </tr>
      <tr>
        <td colspan="2"><?= $mensaje ?></td>
      </tr>
    </table>
</body>
</html>