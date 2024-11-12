<?php
// PLANTILLA DEL FORMULARIO
// El mismo fomularios lo utilizo para las ordenes: detalles, alta o modificar 


// Genero el token de seguridad
$_SESSION["token"] = md5(uniqid(mt_rand(), true));


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD DE USUARIOS</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="web/js/funciones.js"></script>
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>GESTIÓN DE USUARIOS versión 1.0</h1>
        </div>
        <div id="msg"> <?= isset($msg) ? $msg : "" ?></div>
        <div id="content">
            <p> Datos del usuario: </p>
            <form method="POST">
                <table>
                    <tr>
                        <td>Nombre </td>
                        <td>
                            <input type="text" name="nombre" value="<?= $nombre ?>"  <?= ($orden == "Detalles") ? "readonly" : "" ?> size="20" autofocus>
                        </td>
                    </tr>
                    <tr>
                        <td>Login </td>
                        <td>
                            <input type="text" name="login" value="<?= $login ?>" <?= ($orden == "Detalles" || $orden == "Modificar") ? "readonly" : "" ?> size="8">
                        </td>
                    </tr>
                    <tr>
                        <td>Contraseña </td>
                        <td>
                            <input type="password" name="clave" id="clave_id"  value="<?= $clave ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?> size=10>
                            <input type="checkbox" onclick="mostrarclave()">Mostrar password
                        </td>
                    </tr>
                    <tr>
                        <td>Comentario </td>
                        <td>
                            <input type="text" name="comentario"  value="<?= $comentario ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?> size=20>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                <?php if ($orden != "Detalles") : ?>
                    <input type="submit" name="orden" value="<?= $orden ?>">
                <?php endif ?>
                <input type="submit" name="orden" value="Volver">
            </form>
        </div>
    </div>
</body>

</html>
<?php exit(); ?>