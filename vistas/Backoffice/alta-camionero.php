<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="">
        <legend>Agregar Camionero</legend>
        <input type="text" placeholder="Cédula" class="txt-crud">
        <input type="text" placeholder="Nombre Completo" class="txt-crud">
        <input type="tel" placeholder="Teléfono" class="txt-crud">
        <input type="mail" placeholder="Mail" class="txt-crud">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>