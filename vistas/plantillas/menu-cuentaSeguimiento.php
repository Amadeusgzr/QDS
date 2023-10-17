<?php

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
?>
<div id="div-op-cuenta">
    <?php

    if ($_SESSION['tipo_usu'] == "admin") {
        echo "<a href='Backoffice/index.php' class='a-op-cuenta aop1-index'>Acceder</a>";
    } else if ($_SESSION['tipo_usu'] == "almacenero") {
        echo "<a href='Almacenero/index.php' class='a-op-cuenta aop1-index'>Acceder</a>";
    } else if ($_SESSION['tipo_usu'] == "camionero") {
        echo "<a href='Camionero/index.php' class='a-op-cuenta aop1-index'>Acceder</a>";
    }

    ?>
    <div class="div-toggle-idioma">
        <input type="checkbox" name="" id="btn-idioma">
        <label for="btn-idioma" class="lbl-idioma"></label>
    </div>
    <a href="" class="a-op-cuenta aop3-index">Cambiar contraseña</a>
    <a href="../controladores/logout.php" class="a-op-cuenta aop4-index">Cerrar sesión</a>
    <p id="btn-cerrar-menu">x</p>
</div>

<script src="js/idioma.js"></script>
<script src="js/headerIngresado.js"></script>