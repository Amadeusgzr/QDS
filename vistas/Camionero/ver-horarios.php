<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'camionero') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
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
<div id="div-tabla">
    <h1 class="h1-tabla">Horarios</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1-ver-horario">Matrícula</th>
                <th class="th2-ver-horario">Nombre</th>
                <th class="th3-ver-horario">Fecha Inicio</th>
                <th class="th4-ver-horario">Fecha Fin</th>
            </tr>
            <?php
            require("../../controladores/api/maneja/obtenerDato.php");
                foreach ($decode as $maneja) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                
                $id_maneja = $maneja["id_maneja"];
                $nombre_completo = $maneja["nombre_completo"];
                $matricula = $maneja["matricula"];
                $fecha_inicio_manejo = $maneja["fecha_inicio_manejo"];
                $fecha_fin_manejo = $maneja["fecha_fin_manejo"];

                echo "<td>$matricula</td>";
                echo "<td>$nombre_completo</td>";
                echo "<td>$fecha_inicio_manejo</td>";
                echo "<td>$fecha_fin_manejo</td>";
            }
            ?>
        </table>
    </div>

</div>


</body>

</html>