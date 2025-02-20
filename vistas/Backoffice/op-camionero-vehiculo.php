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
<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Camioneros a camiones</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1-camionero-vehiculo">Matrícula</th>
                <th class="th2-camionero-vehiculo">Nombre</th>
                <th class="th3-camionero-vehiculo">Fecha Inicio</th>
                <th class="th4-camionero-vehiculo">Fecha Fin</th>
                <th class="th-op">OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from maneja inner join vehiculo on maneja.id_vehiculo = vehiculo.id_vehiculo inner join camionero on camionero.id_camionero = maneja.id_camionero";
            $manejas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($manejas, $row);
            }
            foreach ($manejas as $maneja) {
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
                echo "<td>
                <a href='baja-dato.php?id_maneja=$id_maneja'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-camionero-vehiculo.php?id_maneja=$id_maneja'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?id_maneja=$id_maneja'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <a style="width:100%;" href="alta-camionero-vehiculo.php" id="a-agregar"><button style="width:100%;" class="estilo-boton boton-agregar"></button></a>
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