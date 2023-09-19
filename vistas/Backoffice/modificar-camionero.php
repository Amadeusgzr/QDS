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
    $id_camionero = $_GET['id_camionero'];
    $instruccion = "select * from camionero where id_camionero=$id_camionero";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camionero = $fila["id_camionero"];
        $cedula = $fila["cedula"];
        $nombre_completo = $fila["nombre_completo"];
        $estado = $fila["estado"];
        $mail = $fila["mail"];
        $telefono = $fila["telefono"];
    }

    if (isset($_GET["telefono"])) {
        $id_camionero = $_GET["id_camionero"];
        $cedula = $_GET["cedula"];
        $nombre_completo = $_GET["nombre_completo"];
        $mail = $_GET["mail"];
        $telefono = $_GET["telefono"];

        $instruccion1 = "update camionero set cedula='$cedula', nombre_completo='$nombre_completo', mail='$mail', telefono='$telefono' where id_camionero=$id_camionero";
        $conexion->query($instruccion1);
    }

    ?>
<div class="form-crud">
    <form action="modificar-camionero.php" method="get">
        <legend>Modificar Camionero</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b><?= $id_camionero?></p>
        <p><b>Cédula: </b><?= $cedula?></p>
        <p><b>Nombre: </b><?= $nombre_completo?></p>
        <p><b>Teléfono: </b><?= $telefono?></p>
        <p><b>Mail: </b><?= $mail?></p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_camionero" value="<?= $id_camionero?>" required readonly>
        <input type="text" placeholder="Cédula" class="txt-crud" name="cedula" value="<?= $cedula?>" required readonly>
        <input type="text" placeholder="Nombre Completo" class="txt-crud" name="nombre_completo" value="<?= $nombre_completo?>" required>
        <input type="tel" placeholder="Teléfono" class="txt-crud" name="telefono" value="<?= $telefono?>" required>
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail" value="<?= $mail?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>