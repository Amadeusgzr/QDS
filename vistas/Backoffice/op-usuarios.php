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
    <a href="index.php">
        <button class="boton-volver estilo-boton">Volver</button>
    </a>
</div>
<div id="div-tabla">
    <h1 class="h1-tabla">Usuarios</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th class="th1">ID</th>
                <th class="th2">Usuario</th>
                <th class="th3">Tipo de Usuario</th>
                <th>Mail</th>
                <th>OP</th>
            </tr>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from login";
            $usuarios = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($usuarios, $row);
            }
            foreach ($usuarios as $usuario) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_usuario = $usuario["id_usuario"];
                $nom_usu = $usuario["nom_usu"];
                $tipo_usu = $usuario["tipo_usu"];
                $mail = $usuario["mail"];
                echo "<td>$id_usuario</td>";
                echo "<td>$nom_usu</td>";
                echo "<td>$tipo_usu</td>";
                echo "<td>$mail</td>";
                echo "<td>
                <a href='baja-dato.php?id_usuario=$id_usuario'><button class='btn-op btn-op1'><img src='../img/iconos/eliminar.png' width='20px'></button></a>
                <a href='modificar-usuario.php?id_usuario=$id_usuario'><button class='btn-op btn-op2'><img src='../img/iconos/modificar.png' width='20px'></button></a>
                <a href='consultar-dato.php?id_usuario=$id_usuario'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-uno">
        <button class="estilo-boton boton-largo btn-limpiar">Limpiar</button>
    </div>
    <div class="div-btn-doble">
        <a href="alta-usuario.php" id="a-agregar"><button class="estilo-boton boton-agregar" id="op-alta">Agregar</button></a>
        <button class="boton-siguiente estilo-boton boton-eliminar" id="submit-as-lote-2">Eliminar</button>
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

<script src="../js/seleccionar-filas-usuarios.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-alta.js"></script>
</div>

</body>

</html>