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

<div id="div-tabla-lote">
    <h1 id="h1-lote">Usuarios</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>Usuario</th>
                <th>Tipo de Usuario</th>
                <th>Mail</th>
                <th class="th-op">OP</th>
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
                $nom_usu = $usuario["nom_usu"];
                $tipo_usu = $usuario["tipo_usu"];
                $mail = $usuario["mail"];
                echo "<td>$nom_usu</td>";
                echo "<td>$tipo_usu</td>";
                echo "<td>$mail</td>";
                echo "<td>
                <a href='baja-dato.php?nom_usu=$nom_usu'><button>B</button></a>
                <a href='modificar-usuario.php?nom_usu=$nom_usu'><button>M</button></a>
                <a href='consultar-dato.php?nom_usu=$nom_usu'><button>C</button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="estilo-boton btns-as-lote">Reiniciar</button>
        <a href="index.php">
            <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
        </a>
    </div>
    <div class="div-btn-doble">
        <a href="alta-usuario.php" id="a-agregar"><button class="estilo-boton btns-as-lote"
                id="op-alta">Agregar</button></a>
        <!--<button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>-->
    </div>
</div>

</body>

</html>