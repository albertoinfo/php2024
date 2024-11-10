<?php
// Leer el contenido completo de una URL y muestro el contenido.
// Se supone que el contenido es HTML
// Este función puede servir para realizar labores de  web scraping 
// MAS INFO  https://kinsta.com/es/base-de-conocimiento/que-es-web-scraping/


header("Content-Type: image/jpeg");
$contenido = file_get_contents("https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/if_w_gt_580,w_580/Visual_nav_tiles_March_2023_Mobile_800x900px_1_MENS_t_f8268fdac6.jpg");
echo $contenido;
