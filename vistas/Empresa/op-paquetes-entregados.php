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
<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Paquetes entregados</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th class="th1-paq-entregados">ID</th>
                <th class="th2-paq-entregados">Destino</th>
                <th class="th3-paq-entregados">Fecha y Hora</th>
                <th>OP</th>

            </tr>
            <?php
            require("../../controladores/api/paqueteEmpresa/obtenerDato.php");
            foreach ($decode as $paquete) {
                if ($paquete["estado"] == "Entregado"){
                $id_paquete = $paquete["id_paquete"];
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["paquete_direccion"] . '</td>';
                echo '<td>' . $paquete["fecha_recibido"] . '</td>';

                echo "<td>
                <a href='consultar-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo '</tr>';
                } 
            }
            ?>
        </table>
    </div>

</div>


</body>
<script>
    document.addEventListener("keydown", function(event) {
        if (event.key === "b" || event.key === "B") {
            window.location.href = "index.php";
        }
    });
</script>

</html>