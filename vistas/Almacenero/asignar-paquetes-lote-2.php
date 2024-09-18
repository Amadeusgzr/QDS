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
    <a href="asignar-paquetes-lote-menu.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla h1-1">Paquetes sin asignar</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th class="th1-paquetes-lotes">ID</th>
                <th class="th2-paquetes-lotes">Destino</th>
                <th class="th3-paquetes-lotes">Estado</th>
                <th>Op</th>
                <?php
                require("../../controladores/api/paquete/obtenerDato.php");
                foreach ($decode as $paquete) {
                    if (isset($_GET)) {
                        $id_lote = $_GET['id_lote'];
                    }
                    $id_paquete = $paquete["id_paquete"];
                    if ($paquete['estado'] == "En almacén central") {
                        echo '<tr class="fila-ingreso-lote fila-opcion">';
                        echo '<td>' . $paquete["id_paquete"] . '</td>';
                        echo '<td>' . $paquete["direccion"] . '</td>';
                        echo '<td>' . $paquete['estado'] . '</td>';
                        echo "<td>
                <a href='../../controladores/api/paquete_lote/agregarDato.php?id_paquete=$id_paquete&id_lote=$id_lote'><button class='btn-op btn-op1'><img src='../img/iconos/suma.png' width='20px'></button></a>
                </td>";
                        echo '</tr>';
                    }

                }
                ?>

        </table>
    </div>
    
</div>

<div id="div-tabla">
    <h1 class="h1-tabla h1-2">Paquetes asignados al lote
        <?= $id_lote ?>
    </h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th class="th1-paquetes-lotes2">ID</th>
                <th class="th2-paquetes-lotes2">Destino</th>
                <th class="th3-paquetes-lotes2">Estado</th>
                <th>Op</th>
                <?php
                require("../../controladores/api/paquete_lote/obtenerDatoPorId.php");
                foreach ($decode as $paquete) {
                    if (isset($_GET)) {
                        $id_lote = $_GET['id_lote'];
                    }

                    $id_paquete = $paquete["id_paquete"];
                    echo '<tr class="fila-ingreso-lote fila-opcion">';
                    echo '<td>' . $paquete["id_paquete"] . '</td>';
                    echo '<td>' . $paquete["direccion"] . '</td>';
                    echo '<td>' . $paquete["estado"] . '</td>';
                    echo "<td>
                    <a href='../../controladores/api/paquete_lote/eliminarDato.php?id_paquete=$id_paquete&id_lote=$id_lote'><button class='btn-op btn-op1'><img src='../img/iconos/resta.png' width='20px'></button></a>
                    </td>";
                    echo '</tr>';
                }
                ?>
        </table>
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

<script src="../js/seleccionar-filas-lotes.js"></script>
<script src="../js/seleccionar-filas-lotes-2.js"></script>
<script src="../js/asignar-paquetes-lote-2.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script>
    // Función para ocultar el parámetro "datos" en la URL
    function ocultarDatosEnURL() {
        if (window.history.replaceState) {
            // Reemplaza la URL actual sin el parámetro "datos"
            const urlSinDatos = window.location.href.replace(/\?datos=.*&/, '?').replace(/\&datos=.*$/, '');
            window.history.replaceState(null, null, urlSinDatos);
        }
    }

    // Llama a la función al cargar la página
    window.onload = ocultarDatosEnURL;
</script>



</body>

</html>