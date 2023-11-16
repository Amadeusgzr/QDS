<?php
session_start();

if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
    header("Location: ../permisos.php");
    exit();
}

if (!isset($_GET['id_paquete']) || is_null($_GET['id_paquete']) || empty(trim($_GET['id_paquete']))) {
    header("Location: ../error.php");
}

require("../../controladores/api/paquete/obtenerDatoPorId.php");
if(isset($decode['error'])){
    header("Location: ../error.php");
}

foreach ($decode as $paquete) {
    $id_paquete = $paquete["id_paquete"];
    $mail_destinatario = $paquete["mail_destinatario"];
    $direccion = $paquete["direccion"];
    $peso = $paquete["peso"];
    $volumen = $paquete["volumen"];
    $fragil = $paquete["fragil"];
    $tipo = $paquete["tipo"];
    $estado = $paquete["paquete_estado"];
    $detalles = $paquete["detalles"];
    $empresa = $paquete["nombre_de_empresa"];
    if ($estado !== "En almacén cliente" || $empresa !== $_SESSION["nom_usu"]){
        header("Location: ../permisos.php");
    }
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>
<script>
    // Función para ocultar el parámetro "datos" en la URL
    function ocultarDatosEnURL() {
        if (window.history.replaceState) {
            // Reemplaza la URL actual sin el parámetro "datos"
            const urlSinDatos = window.location.href.replace(/\?datos=.*&/, '?').replace(/\&datos=.*$/, '');
            window.history.replaceState(null, null, urlSinDatos);
        }
    }

    // Llama a la función al cargar la página
    window.onload = ocultarDatosEnURL;
</script>



<div class="form-crud">
    <form action="../../controladores/api/paquete/modificarDato.php" method="post">
        <legend class="legend-m-paquete">Modificar Paquete</legend>

        <label><b class='p-id'>ID:</b> <?= $id_paquete ?></label>
        <input type="text" placeholder="ID" class="txt-crud txt1" name="id_paquete" value="<?= $id_paquete ?>" required hidden>

        <label><b class='p-direccion'>Dirección: </b></label>
        <input type="tel" placeholder="Direccion" class="txt-crud" id='direccion' name="direccion" value="<?= $direccion ?>" required>

        <label><b class='p-peso'>Peso: </b></label>
        <input type="number" placeholder="Peso" class="txt-crud" name="peso" value="<?= $peso ?>" required>

        <label><b class='p-volumen'>Volumen: </b></label>
        <input type="number" placeholder="Volumen" class="txt-crud" name="volumen" value="<?= $volumen ?>" required>

        <label><b class='p-fragil'>Fragil: </b></label>
        <input type="text" placeholder="Fragil" class="txt-crud" name="fragil" value="<?= $fragil ?>" required>

        <?php
        if ($fragil == "Si") {
        echo "<label><b class='p-tipo'>Tipo: </b>$tipo</label>";
        }
        ?>
        <label><b class='p-estado'>Estado: </b><?= $estado ?></label>
        
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-paquetes-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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
    <script>
    document.addEventListener("keydown", function(event) {
        if (event.key === "b" || event.key === "B") {
            window.location.href = "op-paquetes-cliente.php";
        }
    });
</script>
        
</div>

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