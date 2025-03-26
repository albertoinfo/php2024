<?php
/* DATOS DE UNA PELICULA */

class Pelicula
{
   private $codigo_pelicula;
   private $nombre;
   private $director;
   private $genero;
   private $imagen;
   
   
   // Getter con método mágico
   public function __get($atributo){
       if(property_exists($this, $atributo)) {
           return $this->$atributo;
       }
   }
   
   // Set con método mágico
   public function __set($atributo,$valor){
       if(property_exists($this, $atributo)) {
           $this->$atributo = $valor;
       }
   }
   
}

