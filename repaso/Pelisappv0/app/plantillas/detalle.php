
<h1>Detalles de la Película</h1>
    <div id="pelicula">
             <p><strong>Id : </strong><?= $peli->codigo_pelicula ?></p>
            <p><strong>Nombre : </strong><?= $peli->nombre ?></p>
            <p><strong>Director :</strong> <?= $peli->director ?></p>
            <p><strong>Género : </strong> <?=$peli->genero ?></p>           
    </div>

<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
