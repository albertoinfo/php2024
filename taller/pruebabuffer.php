<?php

echo " Hola ";

ob_start();
echo " Manolo";
$msg = ob_get_clean();

echo " Adios $msg";

