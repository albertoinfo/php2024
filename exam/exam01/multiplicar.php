<?php
$nombres = ["uno","dos","tres","cuatro","cinco","seis","siete","ocho","nuevo","diez"];
$tmulti =[];
for ($i=0;$i <10; $i++){
    $valores=[];
    for ($j=1;$j<=10;$j++){
        $valores[$j]=($i+1)*$j;
    }
    $tmulti[$nombres[$i]]=$valores;
}

echo "<pre>";
print_r($tmulti);
echo "</pre>";