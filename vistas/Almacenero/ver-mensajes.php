<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton">Volver</button>
    </a>
</div>
<div id="div-notificaciones">
    <div class="navbar">
        <button class="seccion-btn active sin-responder" id="Sin responder">Sin responder</button>
        <button class="seccion-btn en-curso" id="En curso">En curso</button>
        <button class="seccion-btn resuelto" id="Resuelto">Resuelto</button>
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
<?php
    if ($_GET){
        require ("../../modelos/db.php");
        $id_mensaje = $_GET["id_mensaje"];
        $accion = $_GET["a"];

        if ($accion == "ec") {
        $instruccion = "update mensaje set estado='En curso' where id_mensaje=$id_mensaje";
        mysqli_query($conexion, $instruccion);
        } else if ( $accion == "r") {
            $instruccion = "update mensaje set estado='Resuelto' where id_mensaje=$id_mensaje";
            mysqli_query($conexion, $instruccion);
        }
    }

?>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-alta.js"></script>
<script>
    $(document).ready(function () {
        function cargarSolicitudes(estado) {
            $.ajax({
                url: "../Backoffice/procesar_mensajes.php",
                type: "POST",
                data: { estado: estado },
                success: function (data) {
                    $("#contenido").html(data);
                }
            });
        }

        $(".seccion-btn").click(function () {
            $(".seccion-btn").removeClass("active");

            $(this).addClass("active");

            var estado = this.id;
            cargarSolicitudes(estado);
        });

        var intervalo = 10000;




        function actualizarSolicitudesPeriodicamente() {
            var seccionActual = $(".seccion-btn.active").attr("id");
            cargarSolicitudes(seccionActual);
        }

        actualizarSolicitudesPeriodicamente();

        setInterval(actualizarSolicitudesPeriodicamente, intervalo);
    });
</script>




</body>

</html>