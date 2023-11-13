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
$id_camioneta = $_GET['id_camioneta'];
$instruccion = "select * from camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where id_camioneta=$id_camioneta";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_camioneta = $fila["id_camioneta"];
    $matricula = $fila["matricula"];
    $peso_soportado = $fila["peso_soportado"];
    $volumen_disponible = $fila["volumen_disponible"];
    $estado = $fila["estado"];
}

?>
<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-camioneta">Modificar Camioneta</legend>
        <label><b class='p-id'>ID:</b> <?= $id_camioneta?></label>

        <label><b class="p-matricula">Matrícula: </b><?= $matricula ?></label>
        <input type="text" placeholder="Matrícula" class="txt-crud" name="matricula" value="<?= $matricula ?>" required readonly>

        <label><b class="p-peso-sop">Peso soportado: </b><?= $peso_soportado ?> Kg</label>
        <input type="text" placeholder="Peso soportado" class="txt-crud" name="peso_soportado" value="<?= $peso_soportado ?>" required>

        <label><b class="p-volumen-disp">Volumen disponible: </b><?= $volumen_disponible ?> Cm3</label>
        <input type="text" placeholder="Volumen disponible" class="txt-crud" name="volumen_disponible" value="<?= $volumen_disponible ?>" required>

        <label><b class="p-estado">Estado: </b><?= $estado ?></label>
        <input type="text" placeholder="Estado" class="txt-crud" name="estado" value="<?= $estado ?>" required>
        
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camionetas.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>