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

    <form action="ingreso-paquete.php" id="form-paquete" method="post">

        <div class="div-datos-paq">
            <legend>Ingreso de Paquete</legend>
            <select name="select-remitente-paq" id="select-remitente-paq">
                <option value="Remitente" selected disabled>Remitente</option>
                <option value="CRECOM">CRECOM</option>
            </select>
            <p class="p-paquete">Sobre el destino</p>
            <input type="text" name="nombre-destinatario-paq" id="nombre-destinatario-paq" class="destino-paq" placeholder="Nombre destinatario" autocomplete="off">
            <input type="email" name="mail-destinatario-paq" id="mail-destinatario-paq" class="destino-paq" placeholder="Correo destinatario" autocomplete="off">
            <input type="text" name="calle-destino-paq" id="calle-destino-paq" class="destino-paq" placeholder="Calle" autocomplete="off">
            <input type="text" name="puerta-destino-paq" id="puerta-destino-paq" class="destino-paq" placeholder="N° de puerta" autocomplete="off">
            <p class="p-paquete">Características del paquete</p>
            <input type="number" name="peso-paq" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)" autocomplete="off">
            <input type="number" name="volumen-paq" id="volumen-paq" class="destino-paq" placeholder="Volumen (cm∧3)" autocomplete="off">
        </div>

        <div class="div-datos-paq">
            <p id="p-fragil">Contenido frágil</p>
            <div id="div-radios">
                <label for="radio-paq-si">Sí</label>
                <input type="radio" name="contenido-fragil" id="radio-paq-si" value="si">
                <label for="radio-paq-no">No</label>
                <input type="radio" name="contenido-fragil" id="radio-paq-no" value="no" checked>
                <select name="select-fragil-paq" id="select-fragil-paq" disabled>
                    <option value="" selected disabled>Contenido frágil</option>
                    <option value="Líquido">Líquido</option>
                    <option value="Vidrio">Vidrio</option>
                </select>
                <p class="p-paquete">Detalles</p>
                <textarea name="detalles-paq" id="detalles-paq" cols="30" rows="8" maxlength="150" placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
                <a href=""><input type="submit" class="submit-paquete boton-siguiente" value="Ingresar paquete"></a>
                <a href="index.php"><input type="button" class="submit-paquete boton-volver" value="Volver"></a>
            </div>
        </div>

    </form>

    <script src="../js/ingreso-paquete.js"></script>

</body>
</html>

<!--
<?php

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

?>
-->