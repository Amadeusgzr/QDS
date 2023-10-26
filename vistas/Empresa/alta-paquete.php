<?php

session_start();


if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
    header("Location: ../permisos.php");
    exit();
}



echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<form action="../../controladores/api/paqueteEmpresa/agregarDato.php" id="form-paquete" method="post">

    <div class="div-datos-paq" id="hola">
        <legend>Ingreso de Paquete</legend>

        <p class="p-paquete">Sobre el destino</p>
        <input type="email" name="mail_destinatario[]" id="mail-destinatario-paq" class="destino-paq" placeholder="Correo destinatario" autocomplete="off" required>
        <input type="text" name="direccion[]" id="calle-destino-paq" class="destino-paq" placeholder="Direccion" autocomplete="off" required>

        <select name="id_destino[]" id="select-fragil-paq" class="select-fragil-paq">
        <option selected value="">Departamento</option>
        <?php
            require("../../controladores/api/destino/obtenerDato.php");
            foreach ($decode as $destino){
                $id_destino = $destino["id_destino"];
                $departamento = $destino["departamento_destino"];
                echo "<option value='$id_destino'> $departamento </option>";
            }
        ?>
        </select>

        <p class="p-paquete">Características del paquete</p>
        <input type="number" step="any" name="peso[]" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)" autocomplete="off" required>
        <input type="number" step="any" name="volumen[]" id="volumen-paq" class="destino-paq" placeholder="Volumen (cm∧3)" autocomplete="off" required>

        <select name="id_almacen_cliente[]" id="select-fragil-paq" class="select-fragil-paq">
        <?php
            require("../../controladores/api/almacenClienteEmpresa/obtenerDatoPorEmpresa.php");

            foreach ($decode as $almacen_cliente){
                $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
                $direccion = $almacen_cliente["direccion"];
                echo "<option value='$id_almacen_cliente'> $direccion </option>";
            }
        ?>
        </select>


    </div>

    <div class="div-datos-paq">
        <p id="p-fragil">Contenido frágil</p>
        <div id="div-radios">
            <label for="radio-paq-si">Sí</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-si" class="chk" value="Si">
            <label for="radio-paq-no">No</label>
            <input type="checkbox" name="fragil[]" id="radio-paq-no" class="chk" value="No" checked>

            <select name="tipo[]" id="select-fragil-paq" class="select-fragil-paq" disabled>
                <option selected value="" id="select-tipo">Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
            </select>

            <p class="p-paquete">Detalles</p>
            <textarea name="detalles[]" id="detalles-paq" cols="30" rows="8" maxlength="150" placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
        </div>
    </div>

    <div class="div-btns-paquete">
        <button id="agregar" class="estilo-boton">Agregar otro paquete</button>
        <input type="submit" class="submit-paquete boton-siguiente" value="Ingresar paquete" id="btnIngreso">
        <a href="op-paquetes-cliente.php"><input type="button" class="submit-paquete boton-volver" value="Volver"></a>
    </div>
</form>

<script>
    document.getElementById("form-paquete").addEventListener("submit", function () {
        let selects = document.getElementsByClassName("select-fragil-paq");
        for (let i = 0; i < selects.length; i++) {
            selects[i].removeAttribute("disabled");
        }
    });
</script>

<script>
    let contador = 0;

    document.getElementById('agregar').addEventListener('click', function () {
        contador++;

        const html = `
        <hr class="hr-paq">
        <div class="div-paq-nuevo">
<div class="div-datos-paq">
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
        <input type="checkbox" name="fragil[]" id="radio-paq-si" class="chk" data-group="${contador}" value="Si">
        <label for="radio-paq-no">No</label>
        <input type="checkbox" name="fragil[]" id="radio-paq-no" class="chk" data-group="${contador}" value="No" checked>
        <select name="tipo[]" id="select-fragil-paq" class="select-fragil-paq" disabled>
                <option selected value="" id="select-tipo">Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
            </select>
        <p class="p-paquete">Detalles</p>
        <textarea name="detalles[]" id="detalles-paq" cols="30" rows="8" maxlength="150"
            placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
    </div>
</div>
</div>
`;

        document.getElementById('form-paquete').insertAdjacentHTML('beforeend', html);

        // Luego de agregar el nuevo formulario, actualizamos los listeners
        updateCheckboxListeners();
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Al cargar la página, establecemos los listeners iniciales
        updateCheckboxListeners();
    });

    function updateCheckboxListeners() {
        const checkboxes = document.querySelectorAll('.chk');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const group = this.getAttribute('data-group');

                // Desmarca todos los checkboxes en el mismo grupo
                checkboxes.forEach(function (otherCheckbox) {
                    if (otherCheckbox.getAttribute('data-group') === group && otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            });
        });
    }
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

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ingreso-paquete.js"></script>

</body>

</html>