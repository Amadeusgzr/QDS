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
    $id_ruta = $_GET['id_ruta'];
    $instruccion = "select * from ruta where id_ruta=$id_ruta";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_ruta = $fila["id_ruta"];
        $nom_ruta = $fila["nom_ruta"];
    }

    if (isset($_GET["nom_ruta"])) {
        $id_ruta = $_GET["id_ruta"];
        $nom_ruta = $_GET["nom_ruta"];

        $instruccion1 = "update ruta set id_ruta='$id_ruta', nom_ruta='$nom_ruta' where id_ruta=$id_ruta";
        $conexion->query($instruccion1);
    }

    ?>
<div class="form-crud">
    <form action="modificar-ruta.php" method="get">
        <legend>Modificar Ruta</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b><?= $id_ruta?></p>
        <p><b>Nombre/Numero: </b><?= $nom_ruta?></p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_ruta" value="<?= $id_ruta?>" required readonly>
        <input type="text" placeholder="Nombre/Numero" class="txt-crud" name="nom_ruta" value="<?= $nom_ruta?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-ruta.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>