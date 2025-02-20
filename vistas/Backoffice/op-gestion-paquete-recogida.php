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
    <h1 class="h1-tabla">Horarios de Salida y Recogida en Almacenes</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1-gestion-paquetes">Camioneta</th>
                <th id="th1-plataformas" class="th2-gestion-paquetes">Salida</th>
                <th>OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select distinct recoge.id_camioneta, vehiculo.matricula, fecha_salida, almacen_central_salida from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where fecha_vuelta IS NULL";
            $horarios_recogida = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($horarios_recogida, $row);
            }

            foreach ($horarios_recogida as $horario_recogida) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_camioneta = $horario_recogida["id_camioneta"];
                $matricula = $horario_recogida["matricula"];

                $fecha_salida = $horario_recogida["fecha_salida"];
                $almacen_central_salida = $horario_recogida["almacen_central_salida"];


                echo "<td>$matricula</td>";
                echo "<td>$fecha_salida</td>";


                echo "<td>
                <a href='baja-dato.php?icth=$id_camioneta&fs=$fecha_salida&acs=$almacen_central_salida'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-horario-recogida.php?icth=$id_camioneta&fs=$fecha_salida&acs=$almacen_central_salida'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?icth=$id_camioneta&fs=$fecha_salida&acs=$almacen_central_salida'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <a style="width: 100%;" href="alta-horario-recogida.php" id="a-agregar"><button style="width: 100%;" class="estilo-boton boton-agregar" id="op-alta">Agregar</button></a>
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