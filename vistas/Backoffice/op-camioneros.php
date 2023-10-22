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
    <h1 class="h1-tabla">Camioneros</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1">Nombre</th>
                <th class="th2">Estado</th>
                <th class="th-op">OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from camionero";
            $camioneros = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camioneros, $row);
            }
            foreach ($camioneros as $camionero) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_camionero = $camionero["id_camionero"];
                $nombre_completo = $camionero["nombre_completo"];
                $estado = $camionero["estado"];
                echo "<td>$nombre_completo</td>";
                echo "<td>$estado</td>";
                echo "<td>
                <a href='baja-dato.php?id_camionero=$id_camionero'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-camionero.php?id_camionero=$id_camionero'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?id_camionero=$id_camionero'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="estilo-boton btns-as-lote btn-limpiar">Reiniciar</button>
        <a href="index.php">
            <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
        </a>
    </div>
    <div class="div-btn-doble">
        <a href="alta-camionero.php" id="a-agregar"><button class="estilo-boton btns-as-lote boton-agregar" id="op-alta">Agregar</button></a>
        <!--<button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>-->
    </div>
</div>

<script src="../js/seleccionar-filas.js"></script>

</body>

</html>