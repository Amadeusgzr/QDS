<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
include("../../modelos/db.php");
require '../../controladores/funciones.php';

if ($_POST) {
    $id_camionero = $_POST["id_camionero"];
    $id_vehiculo = $_POST["id_vehiculo"];
    $fecha_inicio_manejo = $_POST["fecha_inicio_manejo"];
    $fecha_fin_manejo = $_POST["fecha_fin_manejo"];
    
    $numArrays = count($id_camionero);
    for ($i = 0; $i < $numArrays; $i++) {
        $respuesta = existencia('camionero', 'id_camionero', $id_camionero[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe el ID $id_camionero[$i]"
            ];
            break;
        }
        $respuesta = existencia('vehiculo', 'id_vehiculo', $id_vehiculo[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe el ID $id_vehiculo[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($id_camionero);
        $respuesta1 = atributosVacio($id_vehiculo);
        $respuesta2 = atributosVacio($fecha_inicio_manejo);
        $respuesta3 = atributosVacio($fecha_fin_manejo);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Asignación completa"
            ];
            $instruccion = "insert into maneja (id_vehiculo,id_camionero,fecha_inicio_manejo,fecha_fin_manejo) values ('$id_camionero[$i]','$id_vehiculo[$i]','$fecha_inicio_manejo[$i]','$fecha_fin_manejo[$i]')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Campos sin completar"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-camionero-vehiculo.php?datos=' . urlencode($respuesta));
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';


?>



<div class="form-crud">
    <form action="alta-camionero-vehiculo.php" method="post">
        <legend class="legend-form">Asignar vehículo a camionero</legend>
        <select name="id_camionero[]" id="">
            <?php
            $instruccion = "select * from camionero where estado != 'De baja'";
            $camioneros = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camioneros, $row);
            }
            foreach ($camioneros as $camionero) {
                $id_camionero = $camionero["id_camionero"];
                $nombre_completo = $camionero["nombre_completo"];
                echo "<option value='$id_camionero'>$nombre_completo</option>";
            }
            ?>
        </select>
        <select name="id_vehiculo[]" id="">
        <?php
            include("../../modelos/db.php");
            $instruccion = "select * from vehiculo";
            $vehiculos = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($vehiculos, $row);
            }
            foreach ($vehiculos as $vehiculo) {
                $id_vehiculo = $vehiculo["id_vehiculo"];
                $matricula = $vehiculo["matricula"];
                echo "<option value='$id_vehiculo'>$matricula</option>";
            }
            ?>
        </select>
        <input type="date" name="fecha_inicio_manejo[]">
        <input type="date" name="fecha_fin_manejo[]">

        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente boton-agregar"></a>
    </form>
    <a href="op-camionero-vehiculo.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>