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
        <input type="text" name="nom_usu" id="txt-mail" class="destino-paq" placeholder="Nombre usuario"
            autocomplete="off" require>
        <input type="password" name="contrasenia" id="txt-contraseña" class="destino-paq" placeholder="Contraseña"
            autocomplete="off" require>
        <input type="submit" id="submit-login" value="Ingresar">
        <?php
        if (isset($_GET['data'])) {
            $jsonData = urldecode($_GET['data']);
            $data = json_decode($jsonData, true);
            $respuesta = $data['resultado'];
            echo "<p class='p-respuesta'>$respuesta</p>";
        }
        ?>
        <hr>
        <a href="" id="a-contraseña">¿Olvidaste tu contraseña?</a>
    </div>
</form>

<script src="js/ocultar-get-alta.js">

</script>

</body>

</html>