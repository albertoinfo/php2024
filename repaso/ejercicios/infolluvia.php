<?php
// Crear la tabla

$tdias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
foreach ($tdias as $dia) {
    $valores = [];
    for ($i = 0; $i < 24; $i++) {
        $valores[$i] = 0;
    }
    $tprecipitaciones[$dia] = $valores;
}



// Rellenarla
for ($i = 0; $i < 30; $i++) {
    $valor = random_int(1, 40);
    $hora =  random_int(0, 23);
    $ndia = random_int(0, 6);
    $nombredia = $tdias[$ndia];
    $tprecipitaciones[$nombredia][$hora] = $valor;
}




function precipitacionMaxima(): string
{
    global $tdias,$tprecipitaciones;
    $valormax = 0;
    $diamax = "";
    $horamax = 0;

    foreach ($tdias as $dia) {
        for ($i = 0; $i < 24; $i++) {
            if ($tprecipitaciones[$dia][$i] > $valormax) {
                $diamax = $dia;
                $valormax = $tprecipitaciones[$dia][$i];
                $horamax = $i + 1;
            }
        }
    }
    return " La máxima precipitación fue el " . $diamax . " a las " . $horamax . " horas ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe precipitaciones</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            text-align: right;
        }

        ;
    </style>
</head>

<body>
    <table>
        <tr>
            <th></th>
            <?php for ($i = 1; $i <= 24; $i++): ?>
                <th><?= $i ?></th>
            <?php endfor ?>
            <th>TOTAL </th>
        </tr>
        <?php
        foreach ($tdias as $dia) {
            $total = 0;
        ?>
            <tr>
                <td> <?= $dia ?></td>
                <?php for ($i = 0; $i < 24; $i++) {
                    echo "<td>" . $tprecipitaciones[$dia][$i] . "</td>";
                    $total += $tprecipitaciones[$dia][$i];
                }
                ?>
                <td><?= $total ?></td>
            </tr>
        <?php } ?>
    <table>
    <?= precipitacionMaxima() ?>

</body>

</html>