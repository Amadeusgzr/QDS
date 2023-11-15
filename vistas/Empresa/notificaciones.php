<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
    header("Location: ../permisos.php");
    exit();
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-notificaciones">
    <div class="navbar">
        <button class="seccion-btn active espera" id="En espera">En Espera</button>
        <button class="seccion-btn historial" id="Historial">Historial</button>
        <button class="seccion-btn aceptadas" id="Aceptada">Aceptadas</button>
        <button class="seccion-btn denegadas" id="Denegada">Denegadas</button>
    </div>
    <div id="contenido">
    </div>
</div>

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
<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/ver-solicitudes.js"></script>




</body>

</html>