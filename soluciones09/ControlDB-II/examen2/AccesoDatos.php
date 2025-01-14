<?php
include_once "Producto.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    // Creo un lista de alimentos, podría obtenerse de una base de datos
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=Empresa;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo la consulta
        
        
    }
    
    // Devuelvo la lista de Productos 
    public function obtenerListaProductos ():array {
        $tobjproductos= [];
        // Todos los productos PRUEBA
        // $stmt = $this->dbh->prepare("select * from PRODUCTOS");
        // Todos los que no tienen pedidos
        $stmt = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO NOT IN "
                                    ."(SELECT PRODUCTO_NO FROM PEDIDOS) " );
        

        // Devuelvo una tabla de objetos 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if ( $stmt->execute() ){
            $tobjproductos = $stmt->fetchAll();
        }
        return $tobjproductos;
    }
    
    public function actualizarPrecios($lista):int{
        $cont =0;
        $stmt = $this->dbh->prepare("UPDATE PRODUCTOS SET PRECIO_ACTUAL=PRECIO_ACTUAL*0.9 where PRODUCTO_NO = ?");
        // Devuelvo una tabla de objetos
        foreach ($lista as $producto_no){
             $stmt->bindValue(1, $producto_no);
             if ( $stmt->execute() ){
                 $cont++;
             }
             }
        return $cont;
    }
    
    public function actualizarPrecios2($lista):int{
        $cont =0;
        $lista_productos = implode(",",$lista);
        $stmt = $this->dbh->prepare("UPDATE PRODUCTOS SET PRECIO_ACTUAL=PRECIO_ACTUAL*0.9 where PRODUCTO_NO  IN (".$lista_productos.")");
        
      if ( $stmt->execute() ){
            $cont = $stmt->rowCount();
       }
    
        return $cont;
    }


     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

