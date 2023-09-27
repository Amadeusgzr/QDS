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
    <h1 id="h1-lote">Trayectos</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Dirección final</th>
                <th>Departamento final</th>
                <th>OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "SELECT trayecto.id_trayecto, plataforma.direccion, plataforma.departamento FROM trayecto INNER JOIN plataforma ON trayecto.id_plataforma=plataforma.id_plataforma;    ";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_trayecto = $plataforma["id_trayecto"];
                $direccion = $plataforma["direccion"];
                $departamento = $plataforma['departamento'];
                echo "<td>$id_trayecto</td>";
                echo "<td>$direccion</td>";
                echo "<td>$departamento</td>";
                echo "<td>
                <a href='baja-dato.php?id_trayecto=$id_trayecto'><button>B</button></a>
                <a href='modificar-almacen-cliente.php?id_trayecto=$id_trayecto'><button>M</button></a>
                <a href='consultar-dato.php?id_trayecto=$id_trayecto'><button>C</button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="estilo-boton btns-as-lote">Reiniciar</button>
        <a href="op-rutas-tray.php">
            <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
        </a>
    </div>
    <div class="div-btn-doble">
        <a href="alta-trayecto.php" id="a-agregar"><button class="estilo-boton btns-as-lote"
                id="op-alta">Agregar</button></a>
        <!--<button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>-->
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>