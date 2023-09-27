<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<form action="../../controladores/api/paquete/agregarDato.php" id="form-paquete" method="post">

    <div class="div-datos-paq" id="hola">
        <legend>Ingreso de Paquete</legend>
        <p class="p-paquete">Sobre el destino</p>
        <input type="email" name="mail_destinatario[]" id="mail-destinatario-paq" class="destino-paq"
            placeholder="Correo destinatario" autocomplete="off" required>
        <input type="text" name="direccion[]" id="calle-destino-paq" class="destino-paq" placeholder="Direccion"
            autocomplete="off" required>
        <p class="p-paquete">Características del paquete</p>
        <input type="number" step="any" name="peso[]" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)"
            autocomplete="off" required>
        <input type="number" step="any" name="volumen[]" id="volumen-paq" class="destino-paq"
            placeholder="Volumen (cm∧3)" autocomplete="off" required>
    </div>

    <div class="div-datos-paq">
        <p id="p-fragil">Contenido frágil</p>
        <div id="div-radios">
            <label for="radio-paq-si">Sí</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-si" value="Si">
            <label for="radio-paq-no">No</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-no" value="No" checked>
            <select name="tipo[]" id="select-fragil-paq" disabled>
                <option value="default" selected disabled>Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
            </select>
            <p class="p-paquete">Detalles</p>
            <textarea name="detalles[]" id="detalles-paq" cols="30" rows="8" maxlength="150"
                placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
            <button type="button" id="agregar">Agregar otro paquete</button>
            <a href=""><input type="submit" class="submit-paquete boton-siguiente" value="Ingresar paquete"></a>
            <a href="op-paquetes.php"><input type="button" class="submit-paquete boton-volver" value="Volver"></a>
        </div>
    </div>
</form>
<script>
    document.getElementById('agregar').addEventListener('click', function () {
        const packageDiv = document.createElement('div');
        packageDiv.classList.add('div-datos-paq');

        const html = `
  <legend>Ingreso de Paquete</legend>
        <p class="p-paquete">Sobre el destino</p>
        <input type="email" name="mail_destinatario[]" id="mail-destinatario-paq" class="destino-paq"
            placeholder="Correo destinatario" autocomplete="off" required>
        <input type="text" name="direccion[]" id="calle-destino-paq" class="destino-paq" placeholder="Direccion"
            autocomplete="off" required>
        <p class="p-paquete">Características del paquete</p>
        <input type="number" step="any" name="peso[]" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)" autocomplete="off"
            required>
        <input type="number" step="any" name="volumen[]" id="volumen-paq" class="destino-paq" placeholder="Volumen (cm∧3)"
            autocomplete="off" required>
    </div>

    <div class="div-datos-paq">
        <p id="p-fragil">Contenido frágil</p>
        <div id="div-radios">
            <label for="radio-paq-si">Sí</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-si" value="Si">
            <label for="radio-paq-no">No</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-no" value="No" checked>
            <select name="tipo[]" id="select-fragil-paq" disabled>
                <option value="default" selected disabled>Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
            </select>
            <p class="p-paquete">Detalles</p>
            <textarea name="detalles[]" id="detalles-paq" cols="30" rows="8" maxlength="150"
                placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
  `;

        packageDiv.innerHTML = html;
        document.getElementById('form-paquete').appendChild(packageDiv);
    });
</script>

<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ingreso-paquete.js"></script>

</body>

</html>