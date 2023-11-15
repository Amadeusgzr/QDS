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

<?php
include("../../modelos/db.php");
$id_maneja = $_GET['id_maneja'];
$instruccion = "select * from maneja where id_maneja=$id_maneja";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_vehiculo = $fila["id_vehiculo"];
    $id_camionero = $fila["id_camionero"];
    $fecha_inicio_manejo = $fila["fecha_inicio_manejo"];
    $fecha_fin_manejo = $fila["fecha_fin_manejo"];
}

?>
<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-relacion">Modificar Asignacion</legend>

        <label for=""></label>
        <input type="text" name="id_maneja" value="<?= $id_maneja?>" class="txt-crud" hidden readonly required>

        <label for="" class="p-nombre"></label>
        <select name="ic" id="" class="txt-crud">
            <?php
            $instruccion = "select * from camionero where estado != 'De baja'";
            $camioneros = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camioneros, $row);
            }
            foreach ($camioneros as $camionero) {
                $id_camionero1 = $camionero["id_camionero"];
                $nombre_completo = $camionero["nombre_completo"];
                if ($id_camionero == $id_camionero1){
                    echo "<option value='$id_camionero1' selected>$nombre_completo</option>";
                } else {
                    echo "<option value='$id_camionero1'>$nombre_completo</option>";
                }
            }
            ?>
        </select>

        <label for="" class="p-matricula"></label>
        <select name="iv" id="" class="txt-crud">
        <?php
            include("../../modelos/db.php");
            $instruccion = "select * from vehiculo where estado != 'De baja'";
            $vehiculos = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($vehiculos, $row);
            }
            foreach ($vehiculos as $vehiculo) {
                $id_vehiculo1 = $vehiculo["id_vehiculo"];
                $matricula = $vehiculo["matricula"];
                if ($id_vehiculo == $id_vehiculo1){
                    echo "<option value='$id_vehiculo1' selected>$matricula</option>";
                } else {
                    echo "<option value='$id_vehiculo1'>$matricula</option>";
                }
            }
            ?>
        </select>

        <label for="" class="p-fecha-inicio"></label>
        <input type="date" name="fecha_inicio_manejo" class="txt-crud" value="<?=$fecha_inicio_manejo?>">

        <label for="" class="p-fecha-fin"></label>
        <input type="date" name="fecha_fin_manejo" class="txt-crud" value="<?=$fecha_fin_manejo?>">
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camionero-vehiculo.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>