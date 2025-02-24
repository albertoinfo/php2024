<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos
{

    private static $modelo = null;
    private $dbh = null;
    private $stmt_usuarios = null;
    private $stmt_usuario  = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;
    private $stmt_updateBloqueo = null;
    private $stmt_updateSaldo =null; 

    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



    // Constructor privado  Patron singleton

    private function __construct()
    {

        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=usuariosctl;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        $this->stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $this->stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =:login");
        $this->stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        $this->stmt_updateBloqueo    = $this->dbh->prepare("update Usuarios set bloqueo=:bloqueo where login=:login ");
        $this->stmt_updateSaldo      = $this->dbh->prepare("update Usuarios set saldo=saldo*1.10 where login=:login ");
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Usuarios
    public function getUsuarios(): array
    {
        $tuser = [];
        $this->stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Usuario');

        if ($this->stmt_usuarios->execute()) {
            while ($user = $this->stmt_usuarios->fetch()) {
                $tuser[] = $user;
            }
        }
        return $tuser;
    }

    // Devuelvo un usuario o false
    public function getUsuario(String $login)
    {
        $user = false;

        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $this->stmt_usuario->bindParam(':login', $login);
        if ($this->stmt_usuario->execute()) {
            if ($obj = $this->stmt_usuario->fetch()) {
                $user = $obj;
            }
        }
        return $user;
    }

    // UPDATE
    public function modUsuario($user): bool
    {

        $this->stmt_moduser->bindValue(':login', $user->login);
        $this->stmt_moduser->bindValue(':nombre', $user->nombre);
        $this->stmt_moduser->bindValue(':password', $user->password);
        $this->stmt_moduser->bindValue(':comentario', $user->comentario);
        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount() == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user): bool
    {

        $this->stmt_creauser->execute([$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($this->stmt_creauser->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login): bool
    {
        $this->stmt_boruser->bindParam(':login', $login);
        $this->stmt_boruser->execute();
        $resu = ($this->stmt_boruser->rowCount() == 1);
        return $resu;
    }

    public function actualizarSaldos(array $tuser)
    {
        foreach ($tuser as $user) {
            $this->stmt_updateSaldo->bindValue(':login', $user);
            $this->stmt_updateSaldo->execute();
        }
    }
   
    


    public function actualizarBloqueos(array $bloqueoUsuario)
    {
        $tuser = $this->getUsuarios();
        foreach ($tuser as $user) {
            // Esta para bloquear y no lo estaba previamente
            if (in_array($user->login, $bloqueoUsuario)) {
                // Si no está bloqueado previamente lo bloqueo
                if ($user->bloqueo == 0) {
                    $this->stmt_updateBloqueo->bindValue(':login', $user->login);
                    $this->stmt_updateBloqueo->bindValue(':bloqueo', 1);
                    $this->stmt_updateBloqueo->execute();
                }
            } else {
                // No está la lista y estaba bloquedo, lo desbloqueo
                if ($user->bloqueo == 1) {
                    $this->stmt_updateBloqueo->bindValue(':login', $user->login);
                    $this->stmt_updateBloqueo->bindValue(':bloqueo', 0);
                    $this->stmt_updateBloqueo->execute();
                }
            }
        }
    }


    // Solución alternativa
    public function actualizarBloqueos2(array $bloqueoUsuarios){
        // Ejecuto la consulta directamente, todos desploqueados
        $this->dbh->exec("UPDATE Usuarios SET bloqueo=0");
        // Ojo con las comillas simples
        $listalogin = implode("','", $bloqueoUsuarios);
        // OJO!! Esta orden no es inmune a la inyección de SQL
        $this->dbh->exec("UPDATE Usuarios SET bloqueo=1 WHERE login in ('$listalogin') ");
  
      }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
