<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'camionero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<div class="div-btn-uno">
    <a href="entregar-lotes-1.php">
        <button class="boton-volver estilo-boton">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla h1-1">Lotes a entregar</h1>
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
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th class="th1-entregar-lotes">ID</th>
                <th class="th2-entregar-lotes">Cantidad de paquetes</th>
                <th class="th3-entregar-lotes">Estado</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/lote_camion/obtenerDatoPorId.php");
            foreach ($decode as $lote) {
                $id_camion = $lote["id_camion"];
                $id_lote= $lote["id_lote"];
                if ($lote['estado'] == "En almacén central (camión)"){
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $lote["id_lote"] . '</td>';
                echo '<td>' . $lote["cant_paquetes"] . ' paquete(s)</td>';
                echo '<td>' . $lote['estado'] . '</td>';
                echo "<td>
                <a href='../../controladores/api/loteCamionero/modificarDato.php?id_lote=$id_lote&id_camion=$id_camion'><button>Entregado</button></a>
                <a href='#'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>";
                
                }
            }

            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar estilo-boton btns-as-lote">Limpiar</button>
        <button class="boton-agregar estilo-boton">Agregar Selección</button>
    </div>
</div>

<div id="div-tabla">
    <h1 class="h1-tabla h1-2">Lotes ya entregados</h1>
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
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th class="th1-entregar-lotes-2">ID</th>
                <th class="th2-entregar-lotes-2">Destino</th>
                <th class="th3-entregar-lotes-2">Estado</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/lote_camion/obtenerDatoPorId.php");
            foreach ($decode as $lote) {
                $id_camion = $lote["id_camion"];
                $id_lote = $lote["id_lote"];
                if ($lote['estado'] == "Entregado") {
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $lote["id_lote"] . '</td>';
                echo '<td>' . $lote["cant_paquetes"] . '</td>';
                echo '<td>' . $lote['estado'] . '</td>';
                echo "<td>
                <a href='../../controladores/api/loteCamionero/modificarDato.php?id_lote=$id_lote&id_camion=$id_camion'><button>Desentregado</button></a>";
                }
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar btn-limpiar2 estilo-boton btns-as-lote">Limpiar</button>
        <button class="boton-volver boton-eliminar estilo-boton">Remover Selección</button>
    </div>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/asignar-paquetes-lote-2.js"></script>


</body>

</html>