<?php

require 'plantillas/headerIngresado.php';
require 'plantillas/menu-cuenta.php';

?>

    <div id="div-elegir-lote">
        <h1 id="h1-lote">Asignar paquetes a lote</h1>
        <select name="" id="select-lote">
            <option value="" selected disabled>Seleccionar lote</option>
            <option value="">Lote 1</option>
            <option value="">Lote 2</option>
            <option value="">Lote 3</option>
        </select>
        <div id="mov-lote-lote">
            <a href="asignar-paquetes-lote-2.php">
                <button class="boton-siguiente estilo-boton">Siguiente</button>
            </a>
            <a href="aplicacion-almacenero.php">
                <button class="boton-volver estilo-boton">Volver</button>
            </a>
        </div>
    </div>

</body>
</html>