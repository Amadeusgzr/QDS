<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <legend>Consultar Camión</legend>
    <p class="subtitulo-crud">Datos del camión</p>
        <p><b>Matrícula: </b>"AAA 1234"</p>
        <p><b>Peso max.: </b>"18000 Kg"</p>
        <p><b>Volumen max.: </b>"1234"</p>
        <p><b>Chofer: </b>"true/false"</p>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>