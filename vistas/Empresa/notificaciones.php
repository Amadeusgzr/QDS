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
<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div id="div-notificaciones">
        <div class="navbar">
            <button class="seccion-btn" id="En espera">En Espera</button>
            <button class="seccion-btn active" id="Historial">Historial</button>
            <button class="seccion-btn" id="Aceptada">Aceptadas</button>
            <button class="seccion-btn" id="Denegada">Denegadas</button>
        </div>
        <div id="contenido">
    </div>
    <!-- Aquí se cargarán las solicitudes según la sección seleccionada -->
</div>

    <script>
$(document).ready(function() {
    // Función para cargar las solicitudes y actualizar el contenido
    function cargarSolicitudes(estado) {
        $.ajax({
            url: "procesar_solicitudes.php",
            type: "POST",
            data: { estado: estado },
            success: function(data) {
                $("#contenido").html(data);
            }
        });
    }

    // Agrega un manejador de eventos para los botones de sección
    $(".seccion-btn").click(function() {
        // Remueve la clase 'active' de todos los botones
        $(".seccion-btn").removeClass("active");

        // Agrega la clase 'active' al botón seleccionado
        $(this).addClass("active");

        var estado = this.id;
        // Carga las solicitudes de la sección seleccionada
        cargarSolicitudes(estado);
    });

    // Establece la actualización automática cada 60 segundos (ajusta el intervalo según tus necesidades)
    var intervalo = 10000; // 60000 ms = 60 segundos

    // Función para realizar la solicitud AJAX periódicamente
    function actualizarSolicitudesPeriodicamente() {
        var seccionActual = $(".seccion-btn.active").attr("id");
        cargarSolicitudes(seccionActual);
    }

    // Llama a la función inicialmente
    actualizarSolicitudesPeriodicamente();

    // Establece el intervalo de actualización periódica
    setInterval(actualizarSolicitudesPeriodicamente, intervalo);
});
    </script>




</body>

</html>