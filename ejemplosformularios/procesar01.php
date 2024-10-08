<code>
    <?php
   
    echo " Hola " . $_REQUEST["nombre"] . "<br>";

    
    // No existe o es
    if (empty($_REQUEST['clave'])) {
        echo " Conviene introducir una contraseña <br>";
    }

$msg = <<<FIN
Estos son tu datos:
Modo de juego :$_REQUEST[modo]<br>
Nivel de juego : $_REQUEST[nivel]<br>
Su color es: <b> <span style='color:$_REQUEST[tucolor]'> COLOR </span></b> <br>
<hr>
FIN;

    echo $msg;

    $armas = $_REQUEST['armas'];
    echo " Estas son sus armas elegidas: <ul>";
    foreach ($armas as $valor) {
        echo "<li>$valor</li>";
    }
    echo "</ul>";

    if (isset($_REQUEST['velocidad'])) {
        echo " Su velocidad es " . $_REQUEST['velocidad'] . "<br>";
    }

    // Ojo !! Es un ckeckbox si no se marca nada no existe
    if (isset($_REQUEST['poderes'])) {
        $poderes = $_REQUEST['poderes'];
        echo " Has elegido " . count($poderes) . " poderes :";
        foreach ($poderes as $valor) {
            echo "$valor,";
        }
    } else {
        echo " No tienes poderes.";
    }

    ?>

</code>