<?php

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
?>
<div id="div-op-cuenta">
    <a href="../../index.php" class="a-op-cuenta">Inicio</a>
    <div class="div-toggle-idioma">
        <input type="checkbox" name="" id="btn-idioma">
        <label for="btn-idioma" class="lbl-idioma"></label>
    </div>
    <a href="" class="a-op-cuenta">Cambiar contraseña</a>
    <a href="../../controladores/logout.php" class="a-op-cuenta">Cerrar sesión</a>
    <p id="btn-cerrar-menu">x</p>
</div>

<script src="../js/idioma.js"></script>
<script src="../js/headerIngresado.js"></script>