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
        <legend class="legend-m-camion">Modificar Camión</legend>
        <select name="id_camionero[]" id="" class="estilo-input">
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
                    echo "<option value='$id_camionero' selected>$nombre_completo</option>";
                } else {
                    echo "<option value='$id_camionero'>$nombre_completo</option>";
                }
            }
            ?>
        </select>
        <label><b class='p-id'>ID:</b> <?= $id_camion?></label>

        <label><b class="p-matricula">Matrícula: </b></label>
        <input type="text" placeholder="Matrícula" class="txt-crud" name="matricula" value="<?= $matricula ?>" required readonly>

        <label><b class="p-peso-sop">Peso soportado: </b></label>
        <input type="text" placeholder="Peso soportado" class="txt-crud" name="peso_soportado" value="<?= $peso_soportado ?>" required>

        <label><b class="p-volumen-disp">Volumen disponible: </b></label>
        <input type="tel" placeholder="Volumen disponible" class="txt-crud" name="volumen_disponible" value="<?= $volumen_disponible ?>" required>

        <label><b class="p-estado">Estado: </b></label>
        <input type="text" placeholder="Estado" class="txt-crud" name="estado" value="<?= $estado ?>" required>
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>