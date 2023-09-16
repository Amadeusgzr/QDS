<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="">
        <legend>Eliminar Camión</legend>
        <p class="adv">¿Seguro que quiere eliminar el siguiente camión? Los cambios serán irreversibles</p>
        <p><b>Matrícula: </b>"AAA 1234"</p>
        <p><b>Peso max.: </b>"18000 Kg"</p>
        <p><b>Volumen max.: </b>"1234"</p>
        <p><b>Chofer: </b>"true/false"</p>
        <a href=""><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>