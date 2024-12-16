<?php
class Cliente {

    private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $gender;
	private $ip_address;
	private $telefono;

    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }

}