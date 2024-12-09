<?php
include_once "config.php";
require_once "Cliente.php";

class AccesoDAO {
    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDAO();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_clientes  = $this->dbh->prepare("Select * from Clientes limit :primero ,:cuantos ");
    }
        

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Clientes
    public function getClientes (int $primero, int $cuantos):array {
        $tuser = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":cuantos",$cuantos,PDO::PARAM_INT);
        $this->stmt_clientes->bindParam(":primero",$primero,PDO::PARAM_INT);
        if ( $this->stmt_clientes->execute() ){
             $tuser = $this->stmt_clientes->fetchAll();
        }
        return $tuser;
    }

    public function totalClientes ():int{
        $resu = $this->dbh->query(" Select Count(*) from Clientes");
        $valor = $resu->fetch();
        return ($valor[0]); 
    }
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
     public function __clone()
     { 
         trigger_error('La clonación no permitida', E_USER_ERROR); 
     }
 

}