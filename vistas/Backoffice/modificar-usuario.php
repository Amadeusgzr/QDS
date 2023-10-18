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
$nom_usu = $_GET['nom_usu'];
$instruccion = "select * from login where nom_usu='$nom_usu'";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $nom_usu = $fila["nom_usu"];
    $tipo_usu = $fila["tipo_usu"];
    $mail = $fila["mail"];
}

?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend>Modificar Usuario</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>Usuario: </b>
            <?= $nom_usu ?>
        </p>
        <p><b>Tipo de Usuario: </b>
            <?= $tipo_usu ?>
        </p>
        <p><b>Mail: </b>
            <?= $mail ?>
        </p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="Usuario" class="txt-crud" name="nom_usu" value="<?= $nom_usu ?>" required readonly>
        <input type="text" placeholder="Tipo de Usuario" class="txt-crud" name="tipo_usu" value="<?= $tipo_usu ?>" required>
        <input type="text" placeholder="Mail" class="txt-crud" name="mail" value="<?= $mail ?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-usuarios.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>