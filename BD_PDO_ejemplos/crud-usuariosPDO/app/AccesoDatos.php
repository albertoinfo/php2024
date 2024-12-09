<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    
    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton, se accede por getModelo
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objeto de Usuarios
    public function getUsuarios ():array {
        $tuser = [];
        // Sobre la conexión PDO prepara la consulta;
        $stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        // Los resultados se devuelven como objetos de la clase Usuarios
        $stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        
        // Ejecuto la sentencias 
        if ( $stmt_usuarios->execute() ){
            //$tuser = $stmt_usuarios->fetchAll();
            // Mientra $user no sea false, sea un objeto
            while ( $user = $stmt_usuarios->fetch()){
               // añado ese objeto a la tabla
               $tuser[]= $user;
            }
        }
        

        return $tuser;
    }
    
    // Devuelvo un usuario o false
    public function getUsuario (String $login) {
        $user = false;
        $stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $stmt_usuario->bindParam(':login', $login);
        if ( $stmt_usuario->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }
    
    // UPDATE
    public function modUsuario($user):bool{
      
        $stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $stmt_moduser->bindValue(':login',$user->login);
        $stmt_moduser->bindValue(':nombre',$user->nombre);
        $stmt_moduser->bindValue(':password',$user->password);
        $stmt_moduser->bindValue(':comentario',$user->comentario);
        $stmt_moduser->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_moduser->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user):bool{
        $stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        //$stmt_creauser->bindValue(1,$user->login);
        $stmt_creauser->execute( [$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($stmt_creauser->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login):bool {
        $stmt_boruser = $this->dbh->prepare("delete from Usuarios where login =:login");
        $stmt_boruser->bindValue(':login', $login);
        $stmt_boruser->execute();
        $resu = ($stmt_boruser->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

