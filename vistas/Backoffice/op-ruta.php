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
    <h1 id="h1-lote">Rutas</h1>
    <div class="contenedor-tabla">
        <table id="tabla-admin-camioneros">
            <tr class="fila-ingreso-lote">
                <th>ID</th>
                <th>Nombre/Numero</th>
                <th>OP</th>
            </tr>
            <?php
    include("../../modelos/db.php");
    $instruccion = "SELECT * FROM ruta";
            $rutas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($rutas, $row);
            }
            foreach ($rutas as $ruta) {
                echo "<tr class='fila-ingreso-lote fila-opcion' id='fila-1'>";
                $id_ruta = $ruta["id_ruta"];
                $nom_ruta = $ruta["nom_ruta"];
                echo "<td>$id_ruta</td>"; 
                echo "<td>$nom_ruta</td>";
                echo "<td>
                <a href='baja-dato.php?id_ruta=$id_ruta'><button>B</button></a>
                <a href='modificar-ruta.php?id_ruta=$id_ruta'><button>M</button></a>
                <a href='consultar-dato.php?id_ruta=$id_ruta'><button>C</button></a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="div-btn-doble">
        <button class="estilo-boton btns-as-lote">Reiniciar</button>
            <a href="op-rutas-trayectos.php">
                <button class="boton-volver estilo-boton btns-as-lote ">Volver</button>
            </a>
    </div>
    <div class="div-btn-doble">
        <a href="alta-ruta.php" id="a-agregar"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
        <!--<button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>-->
    </div>
</div>

</body>

</html>