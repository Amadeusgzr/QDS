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
    <a href="op-almacenes.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Almacenes (central)</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th id="th1-almacen-central">Número de almacén</th>
                <th>OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from almacen_central where estado != 'De baja' ";
            $almacenes_central = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_central, $row);
            }
            foreach ($almacenes_central as $almacen_central) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_almacen_central = $almacen_central["id_almacen_central"];
                $numero_almacen = $almacen_central["numero_almacen"];
                echo "<td>$id_almacen_central</td>";
                echo "<td>$numero_almacen</td>";
                echo "<td>
                <a href='baja-dato.php?id_almacen_central=$id_almacen_central'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-almacen-central.php?id_almacen_central=$id_almacen_central'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?id_almacen_central=$id_almacen_central'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <button class="estilo-boton boton-largo btn-limpiar">Limpiar</button>
    </div>
    <div class="div-btn-doble">
        <a href="alta-almacen-central.php" id="a-agregar"><button class="estilo-boton boton-agregar" id="op-alta">Agregar</button></a>
        <button class="boton-siguiente estilo-boton boton-eliminar" id="submit-as-lote-2">Eliminar</button>
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

<script src="../js/seleccionar-filas.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-alta.js"></script>
</body>

</html>