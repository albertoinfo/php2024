<?php
class User {

private $login;
private $passwd;
private $Nombre;
private $accesos;
private $bloqueo;
private $salidatimeout;

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



