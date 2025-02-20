<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<div class="div-btn-uno">
    <a href="op-empresas-cliente.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Empresas-Cliente</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1-empresa-cliente">ID</th>
                <th class="th2-empresa-cliente">Nombre</th>
                <th class="th3-empresa-cliente">RUT</th>
                <th class="th4-empresa-cliente">Mail</th>
                <th class="th-op">OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from empresa_cliente where estado = 'De baja'";
            $empresas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($empresas, $row);
            }
            foreach ($empresas as $empresa) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_empresa = $empresa["id_empresa_cliente"];
                $nombre_empresa = $empresa["nombre_de_empresa"];
                $rut = $empresa["rut"];
                $mail = $empresa["mail"];
                echo "<td>$id_empresa</td>";
                echo "<td>$nombre_empresa</td>";
                echo "<td>$rut</td>";
                echo "<td>$mail</td>";
                echo "<td>
                <a href='alta-logica.php?id_empresa_cliente=$id_empresa'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?id_empresa_cliente1=$id_empresa'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
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

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-alta.js"></script>

</body>

</html>