<?php
session_start();
if (isset($_SESSION['nom_usu'])) {
    header("Location: ../index.php");
} else {
    require 'plantillas/headerInvitado.php';
}
?>

<form action="../controladores/authControlador.php" id="form-login" method="post">

    <div class="div-datos-login">
        <h1 id="h1-login">Iniciar Sesión</h1>
        <input type="text" name="nom_usu" id="txt-mail" class="destino-paq" placeholder="Nombre de usuario" autocomplete="off" require>
        <div class="div-contrasenia">
            <input type="password" name="contrasenia" id="txt-contrasenia" class="destino-paq" placeholder="Contraseña" autocomplete="off" require>
            <img src="img/iconos/ojo-cerrado.png" class="icono-ojo"></img>
        </div>
        <input type="submit" id="submit-login" value="Ingresar">
        <?php
        if (isset($_GET['datos'])) {
            $jsonData = urldecode($_GET['datos']);
            $data = json_decode($jsonData, true);
            $respuesta = $data['respuesta'];
            if ($data['error'] == 'Error') {
            echo "<p class='p-respuesta'>$respuesta</p>";
            } else {
                echo "<p style='color:green'>$respuesta</p>";
            }
        }
        ?>
        <hr>
        <a href="" id="a-contrasenia">¿Olvidaste tu contraseña?</a>
    </div>
</form>

<script src="js/ocultar-get-alta.js"></script>
<script src="js/contrasenia.js"></script>

</body>

</html>