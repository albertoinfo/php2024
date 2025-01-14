<?php


class Producto
{
    private $producto_no;
    private $descripcion;
    private $precio_actual;
    private $stock_disponible;
    
    // Métodos mágicos para setter y getter
    
    public function __set($nombre,$valor){
        $class = get_class($this);
        $nombre= strtolower($nombre); // Campo esta en mayusculas 
        if ( property_exists($class, $nombre)){
            $this->$nombre = $valor; // Ojo $nombre
        }
    }
    
    public function __get($nombre){
        $class = get_class($this);
        $nombre= strtolower($nombre);
        if ( property_exists($class, $nombre)){
            return  $this->$nombre;
        }
    }
}

