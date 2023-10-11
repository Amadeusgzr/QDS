<footer id="footer-principal">
    <div id="div-footer1">
        <h2 id="h2-contacto">Contacto</h2>
        <ul>
            <li>+598 91 234 567</li>
            <li>2525 2525</li>
            <li>qds@gmail.com</li>
        </ul>
    </div>
    <div id="div-footer2">
        <h2 id="h2-msg">Envíanos un mensaje</h2>
        <form action="controladores/enviar-correo.php" id="form-mensaje">
            <div id="div-inputs">
                <input type="text" name="nombre" id="msg-nombre" placeholder="Nombre">
                <input type="email" name="correo" id="msg-mail" placeholder="Correo electrónico">
            </div>
            <div id="div-textarea">
                <textarea name="mensaje" id="txt-mensaje-footer" cols="30" rows="4" placeholder="Mensaje"></textarea>
            </div>
            <div id="div-submit-mensaje">
                <input type="submit" id="msg-submit" value="Enviar">
            </div>
        </form>
    </div>
</footer>
</body>

</html>