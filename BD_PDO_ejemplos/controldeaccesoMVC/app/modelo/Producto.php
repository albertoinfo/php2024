<?php
class Producto {

private $id;
private $nombre;
private $stock;
private $precio;


function __set($name, $value)
{
 if ( property_exists($this,$name)){
     $this->$name = $value;
 }
}

function __get($name)
{
    if ( property_exists($this,$name)){
        return $this->$name;
    }
}


}
