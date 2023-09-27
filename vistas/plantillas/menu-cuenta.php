<?php

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
?>
<div id="div-op-cuenta">
    <a href="../../index.php" class="a-op-cuenta">Inicio</a>
    <div class="a-op-cuenta" id="btnIdioma">Idioma</div>
    <a href="" class="a-op-cuenta">Cambiar contraseña</a>
    <a href="../../controladores/logout.php" class="a-op-cuenta">Cerrar sesión</a>
    <p id="btn-cerrar-menu">x</p>
</div>

<div id="div-idiomas">
    <div id="div-select-idioma">
        <select name="" id="select-idioma">
            <option value="" selected disabled>Idioma</option>
            <option value="">Español</option>
            <option value="">Inglés</option>
        </select>
        <button id="submit-idioma">Aceptar</button>
    </div>
</div>
<script src="../js/headerIngresado.js"></script>