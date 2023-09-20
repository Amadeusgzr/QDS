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

<div id="div-tabla-lote">
    <h1 id="h1-lote">Almacenes (central)</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Direccion</th>
                <th>OP</th>
            </tr>
            <?php
    include("../../modelos/db.php");
    $instruccion = "select * from almacen_central";
            $almacenes_central = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_central, $row);
            }
            foreach ($almacenes_central as $almacen_central) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_almacen_central = $almacen_central["id_almacen_central"];
                $direccion = $almacen_central["direccion"];
                echo "<td>$id_almacen_central</td>"; 
                echo "<td>$direccion</td>";
                echo "<td>
                <a href='baja-dato.php?id_almacen_central=$id_almacen_central'><button>B</button></a>
                <a href='modificar-almacen-central.php?id_almacen_central=$id_almacen_central'><button>M</button></a>
                <a href='consultar-dato.php?id_almacen_central=$id_almacen_central'><button>C</button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div id="mov-lote">
        <button class="btn-limpiar estilo-boton btns-as-lote">Reiniciar</button>
        <div id="btns-mov-lote">
            <a href="index.php">
                <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
            </a>
            <!--a-->
            <button class="boton-siguiente estilo-boton btns-as-lote" id="submit-as-lote-2">Siguiente</button>
            <!--a-->
        </div>
    </div>
    <div id="mov-lote2">
        <div class="div-mov-lote">
            <a href="alta-almacen-central.php"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
            <button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>
        </div>
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>