<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <legend>Consultar Camionero</legend>
    <p class="subtitulo-crud">Datos del camionero</p>
    <p><b>Cédula: </b>"12345678"</p>
    <p><b>Nombre: </b>"Lionel Messi"</p>
    <p><b>Teléfono: </b>"091234567"</p>
    <p><b>Mail: </b>"messi10@gmail.com"</p>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>