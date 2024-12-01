<?php

class Cliente {

    private $id;
    private $nombre;

    public function __get($atributo){

        if ( property_exists($this, $atributo)){
            return  "Hola Pepe";
       }
       else{
           return "El valor no está definido";
       }

    }    

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
  }
}

$cli = new Cliente();
$cli->id = 31;
$cli->nombre = " Pepe";
echo "\n".$cli->id.":".$cli->nombre3;
echo "\n";
