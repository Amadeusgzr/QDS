<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<h1 id="h1-camioneros">Gestión de Almacenes</h1>

<main id="main-doble">
    <div class="opcion-doble">
    <h2 class="h2-doble">Almacén (cliente)</h2>
        <a href="" class="opcion-aplicacion-2" id="op1">
            <h2>Alta</h2>
            <p>Ingresar un nuevo Almacén al sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op2">
            <h2>Baja</h2>
            <p>Eliminar un Almacén del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op3">
            <h2>Modificación</h2>
            <p>Modificar un Almacén del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op4">
            <h2>Consulta</h2>
            <p>Consultar los datos de uno o varios Almacenes</p>
        </a>
    </div>
    
    <div class="opcion-doble">
    <h2 class="h2-doble">Plataforma (QC)</h2>
        <a href="" class="opcion-aplicacion-2" id="op1">
            <h2>Alta</h2>
            <p>Ingresar una nueva Plataforma al sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op2">
            <h2>Baja</h2>
            <p>Eliminar una Plataforma del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op3">
            <h2>Modificación</h2>
            <p>Modificar una Plataforma del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op4">
            <h2>Consulta</h2>
            <p>Consultar los datos de una o varias Plataformas</p>
        </a>
    </div>
</main>