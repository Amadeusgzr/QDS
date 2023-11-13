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
$id_camion = $_GET['id_camion'];
$instruccion = "select * from camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where id_camion=$id_camion";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_camion = $fila["id_camion"];
    $matricula = $fila["matricula"];
    $peso_soportado = $fila["peso_soportado"];
    $volumen_disponible = $fila["volumen_disponible"];
    $estado = $fila["estado"];
}

?>
<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-camion">Modificar Camión</legend>

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