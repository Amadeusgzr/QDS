<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div id="div-tabla-lote">
    <h1 id="h1-lote">Camioneros</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>Nombre</th>
                <th>Estado</th>
                <th class="th-op">OP</th>
            </tr>
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "logistic");
            $instruccion = "select * from camionero";
            $camioneros = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camioneros, $row);
            }
            foreach ($camioneros as $camionero) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $cedula = $camionero["cedula"];
                $nombre_completo = $camionero["nombre_completo"];
                $estado = $camionero["estado"];
                echo "<td>$nombre_completo</td>"; 
                echo "<td>$estado</td>";
                echo "<td>
                <a href='baja-dato.php?cedula=$cedula'><button>B</button></a>
                <a href='modificar-camionero.php?cedula=$cedula'><button>M</button></a>
                <a href='consultar-dato.php?cedula=$cedula'><button>C</button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div id="mov-lote">
        <button class="btn-limpiar estilo-boton btns-as-lote">Reiniciar</button>
        <div id="btns-mov-lote">
            <a href="aplicacion-administrador.php">
                <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
            </a>
            <!--a-->
            <button class="boton-siguiente estilo-boton btns-as-lote" id="submit-as-lote-2">Siguiente</button>
            <!--a-->
        </div>
    </div>
    <div id="mov-lote2">
        <div class="div-mov-lote">
            <a href="alta-camionero.php"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
            <button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>
        </div>
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>