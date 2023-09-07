<!DOCTYPE html>
<?php

require 'plantillas/headerIngresado.php';
require 'plantillas/menu-cuenta.php';

?>

    

    <main id="main-almacenero">
        <a href="ingreso-paquete.php" class="opcion-almacenero" id="op1">
            <h2>Ingresar Paquete</h2>
            <p>Ingrese paquetes al almacén</p>
            <div class="div-img-icono"><img src="img/iconos/paquete.png" alt=""></div>
        </a>
        <a href="ingreso-lote.php" class="opcion-almacenero" id="op2">
            <h2>Crear Lote</h2>
            <p>Crea un lote desde cero</p>
            <div class="div-img-icono"><img src="img/iconos/lote.png" alt=""></div>
        </a>
        <a href="" class="opcion-almacenero" id="op3">
            <h2>Asignar Paquetes a Lote</h2>
            <p>Asigne paquetes a los diferentes lotes</p>
            <div class="div-img-icono2"><img src="img/iconos/paquete-lote.png" alt=""></div>
        </a>
        <a href="" class="opcion-almacenero" id="op4">
            <h2>Asignar Lotes a Camión</h2>
            <p>Asigne lotes a los diferentes camiones</p>
            <div class="div-img-icono2"><img src="img/iconos/lote-camion.png" alt=""></div>
        </a>
    </main>

</body>
</html>