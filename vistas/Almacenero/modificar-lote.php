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

<div class="form-crud">
    <form action="modificar-lote.php" method="get">
        <legend>Modificar Lote</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b><?= " " ?></p>
        <p><b>Dirección: </b><?=  " "?></p>
        <p><b>Peso: </b><?=  " "?></p>
        <p><b>Volumen: </b><?=  " "?></p>
        <p><b>Frágil: </b><?=  " "?></p>
        <p><b>Estado: </b><?=  " "?></p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_paquete" value="<?=  " "?>" required readonly>
        <input type="tel" placeholder="Remitente" class="txt-crud" name="telefono" value="<?=  " "?>" required>
        <input type="text" placeholder="Dirección" class="txt-crud" name="direccion" value="<?=  " "?>" required>
        <input type="text" placeholder="Estado" class="txt-crud" name="direccion" value="<?= " "?>" required>
        <input type="text" placeholder="Dirección" class="txt-crud" name="direccion" value="<?=  " "?>" required>
        <input type="text" placeholder="Estado" class="txt-crud" name="direccion" value="<?= " "?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-lotes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>