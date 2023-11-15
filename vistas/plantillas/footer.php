<footer id="footer-principal">
    <div id="div-footer1">
        <h2 id="h2-contacto">Contacto</h2>
        <ul>
            <li>+598 91 234 567</li>
            <li>2525 2525</li>
            <li>qds@gmail.com</li>
        </ul>
        <div class="div-redes">
            <div class="div-redes-2">
                <a href=""><img src="vistas/img/iconos/facebook.png" alt="" class="red"></a>
                <a href=""><img src="vistas/img/iconos/instagram.png" alt="" class="red"></a>
            </div>
            <div class="div-redes-2">
                <a href=""><img src="vistas/img/iconos/twitter.png" alt="" class="red"></a>
                <a href=""><img src="vistas/img/iconos/linkedin.png" alt="" class="red"></a>
            </div>
        </div>
    </div>

    <div id="div-footer2">
        <h2 id="h2-msg">Envíanos un mensaje</h2>
        <form action="controladores/api/mensaje/agregarDato.php" id="form-mensaje" method="post">
            <div id="div-inputs">
                <input type="text" name="nombre_remitente" id="msg-nombre" placeholder="Nombre">
                <input type="mail" name="mail_remitente" id="msg-mail" placeholder="Correo electrónico">
                <textarea name="mensaje" id="txt-mensaje-footer" cols="30" rows="8" placeholder="Mensaje"></textarea>
                <input type="submit" id="msg-submit" value="Enviar">
            </div>
        </form>
        <?php
        if (isset($_GET['datos'])) {
            $jsonDatos = urldecode($_GET['datos']);
            $datos = json_decode($jsonDatos, true);
            $respuesta = $datos['respuesta'];
            echo "<p style='color: white'>$respuesta</p>";
        }
        ?>

</div>
</footer>
<script src="vistas/js/ocultar-get-alta.js"></script>


</body>

</html>