<?php
 
//  Ejemplo de procesamiento y muestra de un formulario en un mismo archivo

$error = false;
$acceso = false;
$usuario = "";

// SI es POST PROCESO 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tusuarios = [
        'pepe' => '1234',
        "luis" => "siul",
        "admin" => "admin"
    ];

    $msg = "";


    if (empty($_REQUEST['nombre']) ||  empty($_REQUEST['clave'])) {
        $msg = "Error: falta valores, introducir el  usuario y  la contraseña.<br> ";
        $error = true;
    } else {
        // PELIGRO: No controlo la seguridad de las entradas
        $usuario = $_REQUEST['nombre'];
        $clave   = $_REQUEST['clave'];
        if ($usuario == "pepe"  && $clave == "1234") {
            $msg = " Bienvenido D. $usuario al sistema ";
            $acceso = true;
        } else {
            $msg = "Error: Usuario y contraseña no válidos.<br> ";
            $error = true;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 380px;">
        <div id="header">
            <h1><?= ($acceso) ? "BIENVENIDO" : "FORMULARIO DE ACCESO" ?></h1>
        </div>

        <div id="content">

            <?php if ($acceso) : ?>
               <?= $msg ?>
            <?php else : ?>

                <?= ($error) ? $msg : "" ?>
                <!-- Si no hay clausula action= en el formulario lo procesa el mismo  archivo -->
                <form name='entrada' method="POST" >
                    <table style="border: node; ">
                        <tr>
                            <td>Nombre:</td>
                            <td><input type="text" name="nombre" value="<?= $usuario ?>" size="20"></td>
                        </tr>
                        <tr>
                            <td>Contraseña:</td>
                            <td><input type="password" name="clave" size="20"></td>
                        </tr>
                    </table>
                    <input type="submit" name="orden" value="Entrar">
                </form>

            <?php endif ?>
        </div>
    </div>
</body>

</html>