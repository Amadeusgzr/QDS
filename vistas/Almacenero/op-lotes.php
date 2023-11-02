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
<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Lotes</h1>
    <div class="div-error">
        <?php
        if (isset($_GET['datos'])) {
            $jsonDatos = urldecode($_GET['datos']);
            $datos = json_decode($jsonDatos, true);
            echo $datos['respuesta'];
        }
        ?>
    </div>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1-lotes">ID</th>
                <th class="th2-lotes">Cantidad de paquetes</th>
                <th class="th3-lotes">Peso</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/lote/obtenerDato.php");
            foreach ($decode as $lote) {
                $id_lote = $lote["id_lote"];
                echo '<tr>';
                echo '<td>' . $lote["id_lote"] . '</td>';
                if (!isset($lote["cant_paquetes"]) || is_null($lote["cant_paquetes"]) || empty(trim($lote["cant_paquetes"]))) {
                    echo '<td>Paquetes no asignados</td>';
                } else {
                    echo '<td>' . $lote["cant_paquetes"] . '</td>';
                }
                echo '<td>' . $lote['peso'] . " kg" . '</td>';
                echo "<td>
                <a href='baja-lote.php?id_lote=$id_lote'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-lote.php?id_lote=$id_lote'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-lote.php?id_lote=$id_lote'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <button class="estilo-boton boton-largo btn-limpiar">Limpiar</button>
    </div>
    <div class="div-btn-doble">
        <a href="alta-lote.php" id="a-agregar"><button class="estilo-boton boton-agregar" id="op-alta">Agregar</button></a>
        <button class="boton-siguiente estilo-boton boton-eliminar" id="submit-as-lote-2">Eliminar</button>
    </div>
</div>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/seleccionar-filas.js"></script>

</body>

</html>