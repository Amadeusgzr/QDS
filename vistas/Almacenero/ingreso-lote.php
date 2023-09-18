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

    <form action="ingreso-lote-2.php" id="form-lote-2" method="post">

        <div class="div-datos-lote">
            <legend>Crear Lote</legend>
            <select name="select-almacen-lote" id="select-almacen-lote">
                <option value="Almacen" selected disabled>Almacen destino</option>
                <option value="Maldonado">Maldonado</option>
                <option value="Canelones">Canelones</option>
                <option value="Rocha">Rocha</option>
            </select>
            <p class="p-lote">Fecha traslado</p>
            <input type="date" name="fecha-traslado-lote" id="fecha-traslado-lote" class="tiempo-lote" placeholder="Nombre destinatario" autocomplete="off">
            <p class="p-lote">Hora traslado</p>
            <input type="time" name="hora-traslado-lote" id="hora-traslado-lote" class="tiempo-lote" placeholder="Nombre destinatario" autocomplete="off">
            <p class="p-lote">Contenido frágil</p>
            <div id="div-radios-lote">
                <label for="radio-lote-si">Sí</label>
                <input type="radio" name="contenido-fragil" id="radio-lote-si" value="si">
                <label for="radio-lote-no">No</label>
                <input type="radio" name="contenido-fragil" id="radio-lote-no" value="no" checked>
                <select name="select-fragil-lote" id="select-fragil-lote" disabled>
                    <option value="" selected disabled>Contenido frágil</option>
                    <option value="Líquido">Líquido</option>
                    <option value="Vidrio">Vidrio</option>
                </select>
            </div>
        </div>

        <div class="div-datos-lote">
                <p class="p-lote">Detalles</p>
                <textarea name="detalles-lote" id="detalles-lote" cols="30" rows="8" maxlength="150" placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
                <a href="ingreso-lote-2.php"><input type="submit" class="submit-lote boton-siguiente" value="Siguiente"></a>
                <a href="index.php"><input type="button" class="submit-lote boton-volver" class="boton-volver" value="Volver"></a>
        </div>

    </form>

    <script src="../js/ingreso-lote-2.js"></script>

</body>
</html>

<!-- <?php

if($_POST){
    $remitente = $_POST["select-remitente-paq"];
    $nombre_destinatario = $_POST["nombre-destinatario-paq"];
    $correo_destinatario = $_POST["mail-destinatario-paq"];
    $calle_destino = $_POST["calle-destino-paq"];
    $num_puerta_destino = $_POST["puerta-destino-paq"];
    $peso = $_POST["peso-paq"];
    $volumen = $_POST["volumen-paq"];
    $fragil = $_POST["contenido-fragil"];
    $contenido_fragil = $_POST["select-fragil-paq"];
    $detalles = $_POST["detalles-paq"];

    $conexion = new mysqli("127.0.0.1","root","","bdprueba");
    $instruccion = "insert into paquete(remitente, nom_destinatario, correo_destinatario, calle_destino, num_puerta_destino, peso, volumen, fragil, contenido_fragil, detalles) value ('$remitente', '$nombre_destinatario', '$correo_destinatario', '$calle_destino', '$num_puerta_destino', $peso, $volumen, $fragil, '$contenido_fragil', '$detalles')";
    $conexion->query($instruccion);
}

?> -->