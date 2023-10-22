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
$id_plataforma = $_GET['id_plataforma'];
$instruccion = "select * from plataforma where id_plataforma=$id_plataforma";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_plataforma = $fila["id_plataforma"];
    $telefono = $fila["telefono"];
    $direccion = $fila["direccion"];
    $departamento = $fila["departamento"];
    $volumen = $fila["volumen_maximo"];
}


?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-plataforma">Modificar Plataforma</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b class="p-id">ID: </b>
            <?= $id_plataforma ?>
        </p>
        <p><b class="p-telefono">Teléfono: </b>
            <?= $telefono ?>
        </p>
        <p><b class="p-direccion">Dirección: </b>
            <?= $direccion ?>
        </p>
        <p><b class="p-departamento">Departamento: </b>
            <?= $departamento ?>
        </p>
        <p><b class="p-volumen-maximo">Volumen máx: </b>
            <?= $volumen ?>
        </p>
        <p class="subtitulo-crud subtitulo-crud-2">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_plataforma" value="<?= $id_plataforma ?>" required
            readonly>
        <input type="tel" placeholder="Teléfono" class="txt-crud" name="telefono" value="<?= $telefono ?>" required>
        <input type="text" placeholder="Dirección" class="txt-crud" name="direccion" value="<?= $direccion ?>" required>
        <input type="text" placeholder="Departamento" class="txt-crud" name="departamento" value="<?= $departamento ?>"
            required>
        <input type="text" placeholder="Volumen máx." class="txt-crud" name="volumen_maximo" value="<?= $volumen ?>"
            required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-plataforma.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>