<?php

// Caracteres asociadas a las logos 
// PIEDRA (Puño derecho)
// PIEDRA2 (Puño Izquierdo / jugador 2 ) 
define ('PIEDRA',   '&#x1F91C;');
define ('PIEDRA2',  '&#x1F91B;');
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;" );

// Tabla de mensajes en función del ganador
$msg = ["¡Empate !",
    " Ha ganado el usuario",
    " Ha ganado el ordenador"];


/**
 *  Calcula el ganador 
 *  Parámetros: Dos valores PIEDRA, PAPEL O TIJERA
 *  Resultado: 0 (Empate),1 (1 Gana jugador 1), 2 (Gana jugador 2)   
 *  
 */

function calcularGanador (String $usuario, String $ordenador): int{
    
    $ganador =0;
    
    if ( $usuario == $ordenador ) return $ganador;
    
    switch ($usuario){
        case PIEDRA:  $ganador = ( $ordenador == TIJERAS)?1:2; break;
        case TIJERAS: $ganador = ( $ordenador == PAPEL  )?1:2; break;
        case PAPEL:   $ganador = ( $ordenador == PIEDRA )?1:2; break;
    }
    return $ganador;
}
$valores = [PIEDRA,PAPEL,TIJERAS];

if ( isset($_GET["usuario"]) ){
    $usuario =     $valores[$_GET["usuario"]];
    $ordenador =   $valores[rand(0,2)];
    include "resu.php";
} else {
    include "entrada.php";
}

