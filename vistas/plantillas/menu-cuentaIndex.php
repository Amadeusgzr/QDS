<?php

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
?>
<div id="div-op-cuenta">
    <?php

    if ($_SESSION['tipo_usu'] == "admin"){
        echo "<a href='vistas/Backoffice/index.php' class='a-op-cuenta'>Acceder</a>";
    }else if($_SESSION['tipo_usu'] == "almacenero"){
        echo "<a href='vistas/Almacenero/index.php' class='a-op-cuenta'>Acceder</a>";
    }else if($_SESSION['tipo_usu'] == "camionero"){
        echo "<a href='vistas/Camionero/index.php' class='a-op-cuenta'>Acceder</a>";
    }

    ?>
    <div class="a-op-cuenta" id="btnIdioma">Idioma</div>
    <a href="" class="a-op-cuenta">Cambiar contraseña</a>
    <a href="controladores/logout.php" class="a-op-cuenta">Cerrar sesión</a>
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

<script src="vistas/js/headerIngresado.js"></script>
