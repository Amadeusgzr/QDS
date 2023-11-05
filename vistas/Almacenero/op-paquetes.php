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
<form action="op-paquetes.php" method="post">
    <input type="text" name="id_paquete" value="">
    <select name="id_almacen_cliente">
    <option value="" selected>Almacén Cliente</option>
        <?php
            require("../../controladores/api/almacenCliente/obtenerDato.php");
            foreach ($almacenes_clientes as $almacen_cliente){
                $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
                $direccion = $almacen_cliente["direccion"];
                echo "<option value='$id_almacen_cliente'> $direccion </option>";
            }
        ?>
    </select>
    <select name="estado">
        <option value="" selected>Estado</option>
        <option value="En almacén cliente">En almacén cliente</option>
        <option value="En almacén central (lote)">En almacén central (lote)</option>

    </select>
    <button>Enviar</button>
</form>

<div class="div-btn-uno">
    <a href="index.php">
        <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
    </a>
</div>
<div id="div-tabla">  
    <h1 class="h1-tabla">Paquetes</h1>
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
                <th class='th1-paquetes'>Destino</th>
                <th class='th2-paquetes'>Estado</th>
                <th>OP</th>
            </tr>
            <?php
            require("../../controladores/api/paquete/buscarPorId.php");
            if (isset($decode)){
                foreach ($decode as $paquete) {
                    $id_paquete = $paquete["id_paquete"];
                    echo '<tr class="fila-ingreso-lote fila-opcion">';
                    echo '<td>' . $paquete["id_paquete"] . '</td>';
                    echo '<td>' . $paquete["direccion"] . '</td>';
                    echo '<td>' . $paquete['estado'] . '</td>';
                    echo "<td>
                    <a href='baja-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                    <a href='modificar-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                    <a href='consultar-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                    </td>";
                    echo '</tr>';
                }
            } else {
            require("../../controladores/api/paquete/obtenerDato.php");
            foreach ($decode as $paquete) {
                $id_paquete = $paquete["id_paquete"];
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["direccion"] . '</td>';
                echo '<td>' . $paquete['estado'] . '</td>';
                echo "<td>
                <a href='baja-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-paquete.php?id_paquete=$id_paquete'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo '</tr>';
            }
        }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <button class="estilo-boton boton-largo btn-limpiar">Limpiar</button>
    </div>
    <div class="div-btn-doble">
        <a href="alta-paquete.php" id="a-agregar"><button class="estilo-boton boton-agregar" id="op-alta">Agregar</button></a>
        <button class="boton-siguiente estilo-boton boton-eliminar" id="submit-as-lote-2">Eliminar</button>
    </div>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/seleccionar-filas.js"></script>


</body>

</html>