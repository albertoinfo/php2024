<?php
include_once "config.php";
require_once "Cliente.php";

/**
 * Clase AccesoDAO
 * 
 * Clase que se encarga de acceder a la base de datos y obtener los datos de los clientes
 * 
 */

class AccesoDAO {

    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    private $stmt_numclientes = null;
    
    
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
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
        $this->stmt_clientes  = $this->dbh->prepare("select * from Clientes limit :primero ,:cuantos");
        $this->stmt_numclientes  = $this->dbh->prepare("SELECT count(*) FROM Clientes ");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;   
            $obj->stmt_clientes = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Clientes
    public function getClientes (int $primero, int $cuantos):array {
        $tuser = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":primero",$primero);
        $this->stmt_clientes->bindParam(":cuantos",$cuantos);
        if ( $this->stmt_clientes->execute() ){
            while ( $user = $this->stmt_clientes->fetch()){
               $tuser[]= $user;
            }
        }
        return $tuser;
    }

    public function totalClientes ():int{
        $this->stmt_numclientes->execute();
        $valor = $this->stmt_numclientes->fetch();
        return $valor[0];
    }
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

