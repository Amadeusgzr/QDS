<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';


?>

<form action="../../controladores/api/lote/agregarDato.php" id="form-lote-2" method="post">

    <div class="div-datos-lote">
        <legend>Crear Lote</legend>
        <?php

        ?>
        <p class="p-lote">Almacén central</p>
        <select name="id_almacen_central[]" id="select-datos-paquete">
            <option value="" selected>Almacén Central</option>
            <?php
               require("../../controladores/api/almacenCentral/obtenerDato.php");
               foreach ($decode as $almacen_central){
                   $id_almacen_central = $almacen_central["id_almacen_central"];
                   $numero_almacen = $almacen_central["numero_almacen"];
                   echo "<option value='$id_almacen_central'> $numero_almacen </option>";
               }
            ?>
        </select>
        <p class="p-lote">Fecha traslado</p>
        <input type="date" name="fecha_ideal_traslado[]" id="fecha-traslado-lote" class="tiempo-lote"
            placeholder="Nombre destinatario" autocomplete="off">
        <p class="p-lote">Hora traslado</p>
        <input type="time" name="hora_ideal_traslado[]" id="hora-traslado-lote" class="tiempo-lote"
            placeholder="Nombre destinatario" autocomplete="off">
        <p class="p-lote">Contenido frágil</p>
        <div id="div-radios-lote">
            <label for="radio-lote-si">Sí</label>
            <input type="radio" name="fragil[]" id="radio-lote-si" value="Si">
            <label for="radio-lote-no">No</label>
            <input type="radio" name="fragil[]" id="radio-lote-no" value="No" checked>
            <select name="tipo[]" id="select-fragil-paq" class="select-fragil-paq">
                <option selected value="" id="select-tipo">Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
            </select>
        </div>
    </div>

    <div class="div-datos-lote">
        <p class="p-lote">Detalles</p>
        <textarea name="detalles[]" id="detalles-lote" cols="30" rows="8" maxlength="150"
            placeholder="Detalles adicionales (opcional)"></textarea>
        <a href=""><input type="submit" class="submit-lote boton-siguiente" value="Siguiente"></a>
        <a href="op-lotes.php"><input type="button" class="submit-lote boton-volver" class="boton-volver"
                value="Volver"></a>
    </div>

</form>

<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ingreso-lote.js"></script>

</body>

</html>