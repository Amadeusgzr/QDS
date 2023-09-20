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
    <h1 id="h1-lote">Camiones</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Matrícula</th>
                <th>Estado</th>
                <th class="th-op">OP</th>
            </tr>
            <?php
    include("../../modelos/db.php");
    $instruccion = "select * from camion";
            $camiones = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camiones, $row);
            }
            foreach ($camiones as $camion) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_camion = $camion["id_camion"];
                $matricula = $camion["matricula"];
                $estado = $camion["estado"];
                echo "<td>$id_camion</td>"; 
                echo "<td>$matricula</td>";
                echo "<td>$estado</td>";
                echo "<td>
                <a href='baja-dato.php?id_camion=$id_camion'><button>B</button></a>
                <a href='modificar-camion.php?id_camion=$id_camion'><button>M</button></a>
                <a href='consultar-dato.php?id_camion=$id_camion'><button>C</button></a>
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
            <a href="alta-camion.php"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
            <button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>
        </div>
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>