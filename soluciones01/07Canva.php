<?php
	$red   = random_int(50, 500);
	$green = random_int(50, 500);
	$blue  = random_int(50, 500);
?>

<!-- VERSION DONDE TODO ESTÁ GENERADO POR EL SERVIDOR -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="2" />
	<style>
		table,
		td,
		th {
			border: 0px;
		}
	</style>
	<style>
  canvas {
      width: 500px;
      height: 500px;
      background-color: #0D0909;
  }
</style>
</head>

<body>
<canvas id="pizarra"></canvas>
	<h1> CON PHP </h1>
	
	<table style="background-color:red">
		<tr>
			<td width="<?= $red ?>px" height="40px"> &nbsp; Rojo(<?= $red ?>)</td>
		</tr>
	</table>
	<table style="background-color:green">
		<tr>
			<td width="<?= $green ?>px" height="40px"> &nbsp;Verde(<?= $green ?>) </td>
		</tr>
	</table>
	<table style="background-color:blue">
		<tr>
			<td width="<?= $blue ?>px" height="40px"> &nbsp;Azul(<?= $blue ?>) </td>
		</tr>
	</table>

	<hr>


<script>
  //======================================================================
  // VARIABLES
  //======================================================================
  let miCanvas = document.querySelector('#pizarra');
  let lineas = [];
  let correccionX = 0;
  let correccionY = 0;
  let pintarLinea = false;
  // Marca el nuevo punto
  let nuevaPosicionX = 0;
  let nuevaPosicionY = 0;

  let posicion = miCanvas.getBoundingClientRect()
  correccionX = posicion.x;
  correccionY = posicion.y;

  miCanvas.width = 500;
  miCanvas.height = 500;

  //======================================================================
  // FUNCIONES
  //======================================================================

  /**
   * Funcion que empieza a dibujar la linea
   */
  function empezarDibujo () {
      pintarLinea = true;
      lineas.push([]);
  };

  /**
   * Funcion que guarda la posicion de la nueva línea
   */
  function guardarLinea() {
      lineas[lineas.length - 1].push({
          x: nuevaPosicionX,
          y: nuevaPosicionY
      });
  }

  /**
   * Funcion dibuja la linea
   */
  function dibujarLinea (event) {
      event.preventDefault();
      if (pintarLinea) {
          let ctx = miCanvas.getContext('2d')
          // Estilos de linea
          ctx.lineJoin = ctx.lineCap = 'round';
          ctx.lineWidth = 10;
          // Color de la linea
          ctx.strokeStyle = '#fff';
          // Marca el nuevo punto
          if (event.changedTouches == undefined) {
              // Versión ratón
              nuevaPosicionX = event.layerX;
              nuevaPosicionY = event.layerY;
          } else {
              // Versión touch, pantalla tactil
              nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
              nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
          }
          // Guarda la linea
          guardarLinea();
          // Redibuja todas las lineas guardadas
          ctx.beginPath();
          lineas.forEach(function (segmento) {
              ctx.moveTo(segmento[0].x, segmento[0].y);
              segmento.forEach(function (punto, index) {
                  ctx.lineTo(punto.x, punto.y);
              });
          });
          ctx.stroke();
      }
  }

  /**
   * Funcion que deja de dibujar la linea
   */
  function pararDibujar () {
      pintarLinea = false;
      guardarLinea();
  }

  //======================================================================
  // EVENTOS
  //======================================================================

  // Eventos raton
  miCanvas.addEventListener('mousedown', empezarDibujo, false);
  miCanvas.addEventListener('mousemove', dibujarLinea, false);
  miCanvas.addEventListener('mouseup', pararDibujar, false);

  // Eventos pantallas táctiles
  miCanvas.addEventListener('touchstart', empezarDibujo, false);
  miCanvas.addEventListener('touchmove', dibujarLinea, false);

</script>
</body>

</html>