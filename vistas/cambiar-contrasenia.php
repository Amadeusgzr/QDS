<?php
session_start();
echo "<link rel='stylesheet' href='css/estilos.css'>";
if (!isset($_SESSION['nom_usu'])) {
    header('Location: permisos.php');
    exit(); 
} else {
     echo "<link rel='stylesheet' href='css/estilos.css'>";
    require 'plantillas/headerSeguimiento.php';
    require 'plantillas/menu-cuentaSeguimiento.php';
}
?>

<div id="div-cambiar-contrasenia">
    <h1 class="h1-tabla2">Cambiar contraseña</h1>
    <p class="adv adv-cambiar">La contraseña debe contener al menos 8 dígitos, una mayúscula, una minúscula y un número.</p>
    <form action="../controladores/api/contrasenia/modificarDato.php" method="post" id="form-cambiar-contrasenia">

    <div class="div-contrasenia div-contrasenia2">
        <input type="password" name="contrasenia_actual" class="txt-crud txt1 txt-cambiar" id="txt-contrasenia" placeholder="Contraseña actual">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo1"></img>
    </div>

    <div class="div-contrasenia div-contrasenia2">
        <input type="password" name="contrasenia_cambiar" class="txt-crud txt2 txt-cambiar" id="txt-contrasenia" placeholder="Contraseña nueva">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo2"></img>
    </div>
    <div class="div-contrasenia div-contrasenia2">
    <input type="password" name="contrasenia_repetir" class="txt-crud txt3 txt-cambiar" id="txt-contrasenia" placeholder="Repetir contraseña nueva">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo3"></img>
    </div>
    <p class="adv adv-cambiar"><?php if (isset($_GET['datos'])) {$respuesta = urldecode($_GET['datos']); $respuesta = json_decode($respuesta, true); echo $respuesta['respuesta'];} ?></p>
    <input type="submit" value="Confirmar" class="estilo-boton btn-confirmar">
        </form>

    <div id="mov-lote-lote" class="mov-cambiar">
        <a href="../index.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
    
</div>
<script src="js/ocultar-get-alta.js"></script>
<script src="js/cambiar-contrasenia.js"></script>



