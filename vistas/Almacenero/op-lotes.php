<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div id="div-tabla-lote">
    <h1 id="h1-lote">Lotes</h1>
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['error'] . " ";
        echo $datos['respuesta'];
    }
    ?>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Cantidad de paquetes</th>
                <th>Peso</th>
                <th>OP</th>
            </tr>
            <?php
                require("../../controladores/api/lote/obtenerDato.php");
                foreach ($decode as $lote) {
                $id_lote = $lote["id_lote"];
                echo '<tr>';
                echo '<td>' . $lote["id_lote"] . '</td>';
                echo '<td>' . $lote["cant_paquetes"] . '</td>';
                echo '<td>' . $lote['peso'] . '</td>';
                echo "<td>
                <a href='baja-lote.php?id_lote=$id_lote'><button>B</button></a>
                <a href='modificar-lote.php?id_lote=$id_lote'><button>M</button></a>
                <a href='consultar-lote.php?id_lote=$id_lote'><button>C</button></a>
                </td>";
                echo '</tr>';
                }
                ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="estilo-boton btns-as-lote">Reiniciar</button>
            <a href="index.php">
                <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
            </a>
    </div>
    <div class="div-btn-doble">
        <a href="alta-lote.php" id="a-agregar"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
        <!--<button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>-->
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>