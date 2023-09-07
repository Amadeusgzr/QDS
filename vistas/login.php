<?php

require 'plantillas/headerInvitado.php';

?>

    <form action="apps.php" id="form-login" method="post">

        <div class="div-datos-login">
            <h1 id="h1-login">Iniciar Sesión</h1>
            <input type="text" name="txt-mail" id="txt-mail" class="destino-paq" placeholder="Correo electrónico" autocomplete="off" require>
            <input type="password" name="txt-contraseña" id="txt-contraseña" class="destino-paq" placeholder="Contraseña" autocomplete="off" require>
            <input type="submit" id="submit-login" value="Ingresar">
            <hr>
            <a href="" id="a-contraseña">¿Olvidaste tu contraseña?</a>
        </div>

    </form>

</body>
</html>