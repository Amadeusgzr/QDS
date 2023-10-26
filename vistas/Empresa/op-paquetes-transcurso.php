<?php
session_start();

if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
    header("Location: ../permisos.php");
    exit();
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div id="div-tabla-lote">
    <h1 id="h1-lote">Paquetes</h1>

    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>OP</th>

            </tr>
            <?php
            require("../../controladores/api/paqueteEmpresa/obtenerDato.php");
            foreach ($decode as $paquete) {
                if ($paquete["estado"] !== "En almacén cliente" && $paquete["estado"] !== "Entregado"){
                $id_paquete = $paquete["id_paquete"];
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["direccion"] . '</td>';
                echo '<td>' . $paquete['estado'] . '</td>';

                echo "<td>
                <a href='consultar-paquete.php?id_paquete=$id_paquete'><button>C</button></a>
                </td>";
                echo '</tr>';
                } 
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <a href="index.php">
            <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
        </a>
    </div>

</div>


</body>

</html>