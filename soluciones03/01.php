<?php
   //Rellenar un array
   function crearTabla($tamaño){
       $tablaResu =[];
       for ($i = 0; $i < $tamaño; $i++) {
        $tablaResu[] = rand (1,10);
       }
       return $tablaResu;
   }
     
   // Equivale a la funcion max($array) de la libreria PHP
   function valorMaximo ($tabla) {
        $valor = $tabla[0];
        for ($i = 0; $i < count($tabla); $i++) {
            if ($tabla[$i] > $valor) {
                $valor = $tabla[$i];
            }
        }
        return $valor;
    }
    // Equivale a la funcion min($array) de la librería PHP
    function valorMinimo ($tabla) {
        $valor = $tabla[0];
        for ($i = 0; $i < count($tabla); $i++) {
            if ($tabla[$i] < $valor) {
                $valor = $tabla[$i];
            }
        }
       
        return $valor;
    }
    //Devuelve el número que mas veces se repite
    function valorRepetido ($tabla) {
        $maxrepes = 0;
        $valor =0;
        for ($i = 0; $i < count($tabla); $i++) {
            $veces = 0;
            // Anoto cuantas veces se repite el elemento $i
            for ($j = $i; $j < count($tabla); $j++) {
                if ($tabla[$i] == $tabla[$j]) {
                    $veces++;
                }    
            }
            if ($veces > $maxrepes) {
                $valor = $tabla[$i];
                $maxrepes = $veces;
            }
        }
        return $valor;
    }
    // Otra forma usando la libreria sobre arrays
    function valorRepetido2 ($tabla) {
        // Obtengo una tabla con los valores como clave 
        // y las frecuencias como valor
        $tvaloresyfrecuencias = array_count_values($tabla); 
        // Me devuelve la clave/posicion de valor con mayor frecuencia
        $moda = array_search(max($tvaloresyfrecuencias), $tvaloresyfrecuencias);
        return $moda;
    }

 // PROGRAMA PRINCIPAL
 define ('TAMAÑO',20);

 $numeros = crearTabla(TAMAÑO);

 // Sin usar la librería
 $maximo = valorMaximo($numeros);
 $minimo = valorMinimo($numeros);
 $repetido = valorRepetido($numeros);

 // Usando la librería
 $maximo = max($numeros);
 $minimo = min($numeros);
 $repetido = valorRepetido2($numeros);
  ?>  
<html>
<head>
<meta charset="UTF-8">
<title>Máximo y mínimo de una tabla</title>
</head>
<body>
    <!-- Muestro la tabla -->
    <h2>Contenido de la tabla </h2>
    <p>
    <table style='border: 1px solid black; border-collapse:collapse';>
    <tr>
    <?php for ($i = 0; $i<count($numeros);$i++): ?> 
        <td style='border: 1px solid black; padding: 5px';><?=$numeros[$i] ?></td>
    <?php endfor ?>
    </tr>
    </table>
    </p>
    <br> Máximo = <?= $maximo ?>
    <br> Mínimo = <?= $minimo ?>
    <br> Moda   = <?= $repetido ?>
<hr>
<?php show_source(__FILE__); ?>
<hr>
</body>
</html>
