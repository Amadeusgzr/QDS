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
        <input type="text" name="direccion[]" id="direccion" class="destino-paq" placeholder="Direccion"
            autocomplete="off" required>
        <select name="id_destino[]" id="select-datos-paquete">
            <option selected value="" class="option-departamento">Departamento</option>
            <?php
            require("../../controladores/api/destino/obtenerDato.php");
            foreach ($decode as $destino) {
                $id_destino = $destino["id_destino"];
                $departamento = $destino["departamento_destino"];
                $ciudad = $destino["ciudad_destino"];
                echo "<option value='$id_destino'> $ciudad, $departamento</option>";
            }
            ?>
        </select>
        <p class="p-paquete">Características del paquete</p>
        <input type="number" step="any" name="peso[]" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)"
            autocomplete="off" required>
        <input type="number" step="any" name="volumen[]" id="volumen-paq" class="destino-paq"
            placeholder="Volumen (cm∧3)" autocomplete="off" required>

        <select name="id_almacen_cliente[]" id="select-datos-paquete">
        <option selected value="" class="option-almacen">Almacén</option>

            <?php
            require("../../controladores/api/almacenCliente/obtenerDato.php");
            foreach ($almacenes_clientes as $almacen_cliente) {
                $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
                $direccion = $almacen_cliente["direccion"];
                $empresa = $almacen_cliente["nombre_de_empresa"];
                echo "<option value='$id_almacen_cliente'> $direccion - $empresa</option>";
            }
            ?>
        </select>
    </div>

    <div class="div-datos-paq">
        <p id="p-fragil">Contenido frágil</p>
        <div id="div-radios">
            <label for="radio-paq-si">Sí</label>
            <input type="radio" name="fragil[]" id="radio-paq-si" class="chk" value="Si">
            <label for="radio-paq-no">No</label>
            <input type="radio" name="fragil[]" id="radio-paq-no" class="chk" value="No" checked>
            <select name="tipo[]" id="select-fragil-paq" class="select-fragil-paq" disabled>
                <option selected value="" id="select-tipo">Contenido frágil</option>
                <option value="Líquido">Líquido</option>
                <option value="Vidrio">Vidrio</option>
                <option value="Inflamable">Inflamable</option>

            </select>
            <p class="p-paquete">Detalles</p>
            <textarea name="detalles[]" id="detalles-paq" cols="30" rows="8" maxlength="150"
                placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
        </div>
    </div>
    <div class="div-btns-paquete">
        <input type="submit" class="submit-paquete boton-siguiente" value="Ingresar paquete" id="btnIngreso">
        <a href="op-paquetes.php"><input type="button" class="submit-paquete boton-volver" value="Volver"></a>
    </div>
</form>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM&libraries=places"></script>
<script>
  function initAutocomplete() {
    var input = document.getElementById('direccion');
    var options = {
      types: ['address'],
      componentRestrictions: { country: 'uy' }, // Código de país para Uruguay (UY)
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);

    autocomplete.setFields(['formatted_address']);

    autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      var filteredAddress = filterAddress(place.formatted_address);
      input.value = filteredAddress;
    });
  }

  function filterAddress(fullAddress) {
    var commaIndex = fullAddress.indexOf(',');
    if (commaIndex !== -1) {
      return fullAddress.substring(0, commaIndex).trim();
    } else {
      return fullAddress;
    }
  }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    initAutocomplete();
  });
</script>

<script>
    document.getElementById("form-paquete").addEventListener("submit", function () {
        let selects = document.getElementsByClassName("select-fragil-paq");
        for (let i = 0; i < selects.length; i++) {
            selects[i].removeAttribute("disabled");
        }
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

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ingreso-paquete.js"></script>

</body>

</html>