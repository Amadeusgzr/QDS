<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="">
        <legend>Agregar Camión</legend>
        <input type="text" placeholder="Matrícula" class="txt-crud">
        <input type="text" placeholder="Peso max. (Kg)" class="txt-crud">
        <input type="text" placeholder="Volumen max. (Mts3)" class="txt-crud">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>