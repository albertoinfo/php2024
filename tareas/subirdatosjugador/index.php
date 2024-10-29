<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include  "captura.html";
    exit();
}

// PROCESO EL FORMULARIO 
// Configuración para el manejo de la subida de imagen
$directorioSubida = "uploads/";
$imagenSubida = "";
$errorsubida = "";

// Procesar la subida de la imagen si se ha seleccionado un fichero
if ($_FILES['imagen']['error'] != UPLOAD_ERR_NO_FILE) {
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES["imagen"]["name"]);
        $rutaArchivo = $directorioSubida . $nombreArchivo;

        // Si es una imagen png y no supera el tamaño permitido
        if ($_FILES['imagen']['type'] == "image/png" && $_FILES['imagen']['size'] <=  10000) {
            // Mover la imagen subida a la carpeta de destino
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo)) {
                $imagenSubida = $rutaArchivo;
            } else {
                $errorsubida = " No se podido copiar la imagen ";
            }
        } else {
            $errorsubida = " Fichero no es una imagen PNG o supera el máximo tamaño";
        }
    } else {
        $errorsubida = " Error al subir el fichero ".$_FILES['imagen']['error'];
    }
} else {
    $errorsubida = " No se indicado imagen a subir ";
}

// Recoger los datos del formulario
$nombre = htmlspecialchars($_POST['nombre']);
$alias = htmlspecialchars($_POST['alias']);
$edad = htmlspecialchars($_POST['edad']);
$armas = isset($_POST['armas']) ? $_POST['armas'] : [];
$artes_magicas = htmlspecialchars($_POST['artes_magicas']) === 'si' ? 'Sí' : 'No';

$listadearmas = count($armas) > 0 ? implode(', ', $armas) : 'Ninguna';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Jugador</title>
    <style>
        body {
    
            background-color: #9a9ab4;
            padding: 20px;
            font-family: "Lucida Console", "Courier New", monospace;
        }
        table {
            background-color: yellow;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        img {
            width: 100px;
            border: 2px solid;
            border-color: black;            
        }
        
    </style>
   
</head>
<body>

    <div class="container">
        <h2>Datos del Jugador</h2>
        <table>
            <tr>
            <td>
                <p><strong>Nombre:</strong> <?= $nombre ?></p>
                <p><strong>Alias:</strong> <?= $alias ?></p>
                <p><strong>Edad:</strong> <?= $edad ?></p>
                <p><strong>Armas seleccionadas:</strong> <?= $listadearmas ?>
                </p>
                <p><strong>¿Practica artes mágicas?:</strong> <?= $artes_magicas ?></p>

            </td>
            <td>
                <?php if ($imagenSubida): ?>
                    <p><strong>Imagen subida:</strong></p>
                    <img src="<?= $imagenSubida; ?>" alt="Imagen del jugador">
                <?php else: ?>
                    <p><strong>No se subió ninguna imagen.</strong></p>
                    <img src="calavera.png" alt="Imagen del jugador">
                    <p>
                        <?= $errorsubida ?>
                    </p>
                <?php endif; ?>
            </td>
            </tr>
        </table>


    </div>

</body>

</html>
