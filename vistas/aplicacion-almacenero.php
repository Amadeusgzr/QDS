<!DOCTYPE html>
<?php

require 'plantillas/headerIngresado.php';
require 'plantillas/menu-cuenta.php';

?>

    

    <main class="main-aplicacion">
        <a href="ingreso-paquete.php" class="opcion-aplicacion" id="op1">
            <h2>Ingresar Paquete</h2>
            <p>Ingrese paquetes al almacén</p>
            <div class="div-img-icono"><img src="img/iconos/paquete.png" alt=""></div>
        </a>
        <a href="ingreso-lote.php" class="opcion-aplicacion" id="op2">
            <h2>Crear Lote</h2>
            <p>Crea un lote desde cero</p>
            <div class="div-img-icono"><img src="img/iconos/lote.png" alt=""></div>
        </a>
        <a href="asignar-paquetes-lote.php" class="opcion-aplicacion" id="op3">
            <h2>Asignar Paquetes a Lote</h2>
            <p>Asigne paquetes a los diferentes lotes</p>
            <div class="div-img-icono2"><img src="img/iconos/paquete-lote.png" alt=""></div>
        </a>
        <a href="" class="opcion-aplicacion" id="op4">
            <h2>Asignar Lotes a Camión</h2>
            <p>Asigne lotes a los diferentes camiones</p>
            <div class="div-img-icono2"><img src="img/iconos/lote-camion.png" alt=""></div>
        </a>
    </main>

</body>
</html>