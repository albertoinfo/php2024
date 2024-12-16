<?php

// 1) Establezco la conexión con la BD Usuarios
////////////////////////////////////////////////
$datosconexion = "mysql:host=localhost;dbname=Usuarios;charset=utf8";

try {
    // Creo el objeto PDO estableciendo la conexión a la BD
    $dbh = new PDO($datosconexion, "root", "root");
    // Si falla genera una excepción y no emula la senticas preparadas
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Error de conexión " . $e->getMessage();
    exit();
}


// 2 ) Preparo la sentencia
////////////////////////////////////
$stmt = $dbh->prepare("SELECT * FROM Usuarios ");

// La ejecuto sentencia
$stmt->execute();

// Otra forma diecta, pero no recomendada por riegos de inyección de SQL
// Se ejecuta directamente
/// $stmt = $dbh->query("SELECT * FROM Usuarios ");

// 3) Especifico la forma de reperar los datos.

echo "<br> A ) Mediante un  array asociativo <br>";
$stmt->setFetchMode(PDO::FETCH_ASSOC);

echo " <table border=1><tr><th>login</th><th>nombre</th><th>password</th><th>Comentario</th></tr>";
while ( $fila = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>".$fila['login']."</td>";
    echo "<td>$fila[nombre]</td>";
    echo "<td>$fila[password]</td>";
    echo "<td>$fila[comentario]</td>";
    echo "</tr>";
}
echo "</table>";


// La ejecuto sentencia de nuevo, se puede evitar si el cursor permite localización
$stmt->execute();

// Array con indices númericos orden del SELECT
$stmt->setFetchMode(PDO::FETCH_NUM);

echo "<br> B ) Mediante un  array númerico <br>";
echo " <table border=1><tr><th>login</th><th>nombre</th><th>password</th><th>Comentario</th></tr>";
while ( $fila = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>$fila[0]</td>";
    echo "<td>$fila[1]</td>";
    echo "<td>$fila[2]</td>";
    echo "<td>$fila[3]</td>";
    echo "</tr>";
}
echo "</table>";


// La ejecuto sentencia de nuevo
$stmt->execute();

// Array con objetos anónimos clase por defecto 
$stmt->setFetchMode(PDO::FETCH_OBJ);

// Si quiero usar  objetos de una clase concreta:
// $stmt->setFetchMode(PDO::FETCH_CLASS,'Miclase');
// El nombre de las propiedades deben ser igual que los nombre de las columnas 

echo "<br> C ) Mediante un  objeto anónimo con clase por defecto <br>";
echo " <table border=1><tr><th>login</th><th>nombre</th><th>password</th><th>Comentario</th></tr>";
while ( $obj = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>$obj->login</td>";
    echo "<td>$obj->nombre</td>";
    echo "<td>$obj->password</td>";
    echo "<td>$obj->comentario]</td>";
    echo "</tr>";
}
echo "</table>";


// Inserto una nueva fila
$stmt2 = $dbh->prepare("INSERT INTO Usuarios (login, nombre, password, comentario) ". 
                                     " VALUES (:login, :nombre,:password,:comentario) " );

// Asigno valores, tambien se podrían poner directamente en la sentencia SQL

$login = "nuevo".random_int(1,1000); // EL login no se puede repetir por ser clave primaria 
$stmt2->bindValue(':login', $login);
$stmt2->bindValue(':nombre', "Pepe");
$stmt2->bindValue(':password', "joseplus22");
$stmt2->bindValue(':comentario', "Jefe RRHH");
$stmt2->execute(); 

echo " <br> INSERT Se han afectado ". $stmt2->rowCount()." filas <br>";
// rowCount es util en DELETE/DELETE/INSERT

$stmt3 = $dbh->prepare(" DELETE from Usuarios Where nombre='Pepe'");
$stmt3->execute();
echo " <br> DELETE Se han afectado ". $stmt3->rowCount()." filas <br>";

// Otra forma de obtener todos los resultados  fetchAll
// La ejecuto sentencia de consulta de nuevo
$stmt->execute();

// Array con objetos anónimos clase por defecto 
$stmt->setFetchMode(PDO::FETCH_OBJ);

echo "<br> D ) Mediante un  objeto anónimo con clase por defecto  con fetchaLL<br>";
echo " <table border=1><tr><th>login</th><th>nombre</th><th>password</th><th>Comentario</th></tr>";

// Obtengo una tabla con todos los datos;
$tobj = $stmt->fetchAll(PDO::FETCH_OBJ);
// Recorro la tabla.
foreach ( $tobj as $obj ) {
    echo "<tr>";
    echo "<td>$obj->login</td>";
    echo "<td>$obj->nombre</td>";
    echo "<td>$obj->password</td>";
    echo "<td>".$obj->comentario."</td>";
    echo "</tr>";
}
echo "</table>";



