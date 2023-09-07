<!DOCTYPE html>
<?php

require 'plantillas/headerIngresado.php';
require 'plantillas/menu-cuenta.php';

?>

    

    <main id="main-almacenero">
        <a href="ingreso-lote.php" class="opcion-almacenero" id="op2">
            <h2>Camioneros</h2>
            <p>Gestión de Camioneros</p>
            <div class="div-img-icono"><img src="img/iconos/icono-usuario.png" alt=""></div>
        </a>
        <a href="ingreso-paquete.php" class="opcion-almacenero" id="op1">
            <h2>Camiones</h2>
            <p>Gestión de Camiones</p>
            <div class="div-img-icono"><img src="img/iconos/camion.png" alt=""></div>
        </a>
        <a href="" class="opcion-almacenero" id="op3">
            <h2>Modificar usuario</h2>
            <p>Modifique un usuario del sistema</p>
            <div class="div-img-icono2"><img src="img/iconos/paquete-lote.png" alt=""></div>
        </a>
        <a href="" class="opcion-almacenero" id="op4">
            <h2>Consultar Usuario</h2>
            <p>Consulte los datos de un usuario</p>
            <div class="div-img-icono2"><img src="img/iconos/lote-camion.png" alt=""></div>
        </a>
    </main>

</body>
</html>