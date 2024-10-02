<?php
require_once("funcionesvar.php")
?>
<html>
<head>
<meta charset="UTF-8">
<title>Ejercicio 2 Funciones</title>
</head>
<body>
<?php
$n1 = rand(1, 10);
$n2 = rand(1, 10);
echo "1º Número: $n1</br>";
echo "2º Número : $n2</br>";
echo "$n1 + $n2 = " . (calSuma($n1, $n2)) . "</br>";
echo "$n1 - $n2 = " . (calResta($n1, $n2)) . "</br>";
echo "$n1 * $n2 = " . (calMulti($n1, $n2)) . "</br>";
echo "$n1 / $n2 = " . (calDivi($n1, $n2)) . "</br>";
echo "$n1 % $n2 = " . (calModulo($n1, $n2)) . "</br>";
echo "$n1<sup>$n2</sup> = " . (calPotencia($n1, $n2)) . "</br>"; 
?>

<hr>

<hr>
</body>
</html>
