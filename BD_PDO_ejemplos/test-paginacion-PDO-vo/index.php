<?php
define('FPAG', 10); // Número de clientes por página

require_once "app/Cliente.php";
require_once  "app/AccesoDAO.php";
session_start();

// Valor por defecto de la posición inicial
if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}


// Segun la paginación se cambia la posición inicial



$primero = $_SESSION['posini'];     

// Acceder a la base de datos y pedir los clientes de la página
// Guardar en la variable en una tabla
// Mostrar la tabla en la vista

include "app/plantillas/principal.php";
