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
    <a href="index.php">
        <button class="boton-volver estilo-boton">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Paquetes a recoger</h1>
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
                <th>ID</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/paqueteCamionero/obtenerDatoPorCamioneta.php");
            foreach ($decode as $paquete) {
                $id_camioneta = $_GET["id_camioneta"];
                $id_paquete = $paquete["id_paquete"];
                if ($paquete['estado'] == "En almacén cliente"){
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["direccion"] . '</td>';
                echo '<td>' . $paquete['paquete_estado'] . '</td>';
                echo "<td>
                <a href='../../controladores/api/paqueteCamionero/modificarDato.php?id_paquete=$id_paquete&id_camioneta=$id_camioneta'><button>Recogido</button></a>
                <a href='#'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>";
                }
            }

            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar estilo-boton btns-as-lote">Limpiar</button>
        <button class="boton-siguiente estilo-boton">Siguiente</button>
    </div>
</div>

<div id="div-tabla">
    <h1 class="h1-tabla">Paquetes ya recogidos</h1>
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
                <th>ID</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/paqueteCamionero/obtenerDatoPorCamioneta.php");
            foreach ($decode as $paquete) {
                $id_camioneta = $_GET["id_camioneta"];
                $id_paquete = $paquete["id_paquete"];
                if ($paquete['estado'] == "En camioneta (central)") {
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["direccion"] . '</td>';
                echo '<td>' . $paquete['estado'] . '</td>';
                echo "<td>
                <a href='../../controladores/api/paqueteCamionero/modificarDato.php?id_paquete=$id_paquete&id_camioneta=$id_camioneta'><button>Desrecogido</button></a>";
                }
        
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar estilo-boton btns-as-lote">Limpiar</button>
        <button class="boton-siguiente estilo-boton">Siguiente</button>
    </div>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/asignar-paquetes-lote-2.js"></script>


</body>

</html>