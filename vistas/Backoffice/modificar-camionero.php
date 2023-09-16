<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="">
        <legend>Modificar Camionero</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>Cédula: </b>"12345678"</p>
        <p><b>Nombre: </b>"Lionel Messi"</p>
        <p><b>Teléfono: </b>"091234567"</p>
        <p><b>Mail: </b>"messi10@gmail.com"</p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="Cédula" class="txt-crud">
        <input type="text" placeholder="Nombre Completo" class="txt-crud">
        <input type="tel" placeholder="Teléfono" class="txt-crud">
        <input type="mail" placeholder="Mail" class="txt-crud">
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>