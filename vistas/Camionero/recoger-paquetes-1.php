<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'camionero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<div id="div-elegir-lote">
    <h1 class="h1-tabla2">Elegir camioneta</h1>
    <p class="adv">Elija la camioneta asignada para ver los paquetes a recoger</p>
    <form action="recoger-paquetes-3.php" method="get" class="form-asignar">
        <select name="id_camioneta" id="select-lote">
            <?php
            require("../../controladores/api/camioneta/obtenerDato.php");
            foreach ($decode as $camioneta) {
                $id_camioneta = $camioneta["id_camioneta"];
                $estado = $camioneta["estado"];
                $matricula = $camioneta["matricula"];
                echo "<option value='$id_camioneta'>$matricula - $estado</option>";
            }

            ?>
        </select>
        <button class="boton-siguiente estilo-boton">Siguiente</button>
    </form>

    <div id="mov-lote-lote">
        <a href="index.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
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
</body>

</html>