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
    <a href="asignar-lotes-camion.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Lotes sin asignar</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Peso</th>
                <th>Cantidad de paquetes</th>
                <th>Op</th>
                <?php
                require("../../controladores/api/lote/obtenerDato.php");
                foreach ($decode as $lote) {
                    if (isset($_GET)) {
                        $id_camion = $_GET['id_camion'];
                    }
                    $id_lote = $lote["id_lote"];
                    if ($lote['estado'] == "En almacén central") {
                        echo '<tr class="fila-ingreso-lote fila-opcion">';
                        echo '<td>' . $lote["id_lote"] . '</td>';
                        echo '<td>' . $lote["peso"] . ' kg</td>';
                        echo '<td>' . $lote['cant_paquetes'] . ' paquete/s</td>';
                        echo "<td>
                <a href='../../controladores/api/lote_camion/agregarDato.php?id_lote=$id_lote&id_camion=$id_camion'><button>Agregar</button></a>
                </td>";
                        echo '</tr>';
                    }

                }
                ?>

        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar estilo-boton btn-limpiar">Limpiar</button>
        <a href="hola.php?id_lote=<?= $id_lote ?>"><button class="boton-agregar estilo-boton btns-as-lote">Agregar Selección</button></a>
    </div>

    
</div>

<div id="div-tabla">
    <h1 class="h1-tabla">Lotes asignados al camión
    </h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Peso</th>
                <th>Cantidad de paquetes</th>
                <th>Op</th>
                <?php
                require("../../controladores/api/lote_camion/obtenerDatoPorId.php");
                foreach ($decode as $camion) {
                    if (isset($_GET)) {
                        $id_camion = $_GET['id_camion'];
                    }
                    $id_lote = $camion["id_lote"];
                    echo '<tr class="fila-ingreso-lote fila-opcion">';
                    echo '<td>' . $camion["id_lote"] . '</td>';
                    echo '<td>' . $camion["peso"] . ' kg</td>';
                    echo '<td>' . $camion["cant_paquetes"] . ' paquete/s</td>';
                    echo "<td>
                    <a href='../../controladores/api/lote_camion/eliminarDato.php?id_lote=$id_lote&id_camion=$id_camion'><button>Eliminar</button></a>
                    </td>";
                    echo '</tr>';
                }
                ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="btn-limpiar estilo-boton btn-limpiar">Limpiar</button>
        <a href="hola.php?id_lote=<?= $id_lote ?>"><button class="boton-volver estilo-boton btns-as-lote">Eliminar Selección</button></a>
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
