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
    <h1 id="h1-lote">Asignar paquetes a lote</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID del paquete</th>
                <th>Destino</th>
                <th>Empresa remitente</th>
                <th>Riesgo</th>
                <?php
                require("../../controladores/api/paquete/obtenerDato.php");
                foreach ($decode as $paquete) {
                    $id_paquete = $paquete["id_paquete"];
                    if (isset($_GET['datos'])) {
                        $jsonDatos = urldecode($_GET['datos']);
                        $datos = json_decode($jsonDatos, true);
                        $id_lote = $datos['id_lote'];
                    }
                    if ($paquete['estado'] == "En almacén cliente"){
                    echo '<tr class="fila-ingreso-lote fila-opcion">';
                    echo '<td>' . $paquete["id_paquete"] . '</td>';
                    echo '<td>' . $paquete["direccion"] . '</td>';
                    echo '<td>' . $paquete['estado'] . '</td>';
                    echo "<td>
                <a href='../../controladores/api/paquete_lote/agregarDato.php?id_paquete=$id_paquete&id_lote=$id_lote'><button>Agregar</button></a>
                </td>";
                    echo '</tr>';
                    }

                }
                ?>
        </table>
    </div>
    <div id="mov-lote">
        <button class="btn-limpiar estilo-boton btns-as-lote">Borrar</button>
        <div id="btns-mov-lote">
            <a href="asignar-paquetes-lote.php">
                <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
            </a>
            <!--a-->
            <a href="hola.php?id_lote=<?= $id_lote ?>"><button class="boton-siguiente estilo-boton btns-as-lote">Siguiente</button></a>
            <!--a-->
        </div>
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


</body>

</html>