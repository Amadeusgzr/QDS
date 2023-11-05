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
    <h1 class="h1-tabla2">Elegir camión</h1>
    <p class="adv">Elija el camión asignado para ver los lotes a entregar</p>
    <form action="entregar-lotes-2.php" method="get" class="form-asignar">
        <select name="id_camion" id="select-lote">
            <?php
            require("../../controladores/api/camion/obtenerDato.php");
            foreach ($decode as $camion) {
                $id_camion = $camion["id_camion"];
                $estado = $camion["estado"];
                $matricula = $camion["matricula"];

                echo "<option value='$id_camion'>$matricula - $estado</option>";
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

</body>

</html>