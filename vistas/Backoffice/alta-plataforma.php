<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
  header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
  exit();
}
require '../../controladores/funciones.php';
include('../../modelos/db.php');


if ($_POST) {
  $telefono = $_POST["telefono"];
  $direccion = $_POST["direccion"];
  $departamento = $_POST["departamento"];
  $volumen_max = $_POST["volumen_max"];

  $numArrays = count($telefono);
  for ($i = 0; $i < $numArrays; $i++) {
    include("../../modelos/db.php");
    $respuesta = existencia('plataforma', 'telefono', $telefono[$i]);
    if ($respuesta['error'] == "Error") {
      $respuesta = [
        'error' => "Error",
        'respuesta' => "Ya existe el telefono $telefono[$i]"
      ];
      break;
    }

    $respuesta = atributosVacio($telefono);
    $respuesta1 = atributosVacio($direccion);
    $respuesta2 = atributosVacio($departamento);
    $respuesta3 = atributosVacio($volumen_max);

    if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

      $respuesta = longitud($telefono[$i], 20);
      $respuesta1 = longitud($direccion[$i], 65);
      $respuesta2 = longitud($departamento[$i], 11);
      $respuesta3 = longitud($volumen_max[$i], 11);

      if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

        $respuesta = numeros($telefono[$i]);
        $respuesta1 = numeros($volumen_max[$i]);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error"){
          $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Plataforma guardada"
          ];
          $instruccion = "insert into plataforma(direccion, telefono, ubicacion, volumen_maximo) value ('$direccion[$i]', '$telefono[$i]', '$departamento[$i]','$volumen_max[$i]')";
          $conexion->query($instruccion);
        } else {
          $respuesta = [
            'error' => "Error",
            'respuesta' => "El teléfono y el volumen deben de tener solo números"
          ];
        }



      } else {
        $respuesta = [
          'error' => "Error",
          'respuesta' => "Palabras inválidas"
        ];
      }

    } else {
      $respuesta = [
        'error' => "Error",
        'respuesta' => "Hay atributos que no deben estar vacíos"
      ];
    }
  }
  $respuesta = json_encode($respuesta);
  header('Location: alta-plataforma.php?datos=' . urlencode($respuesta));
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<div class="form-crud">
  <form action="alta-plataforma.php" method="post">
    <legend>Agregar Plataforma</legend>
    <input type="text" placeholder="Teléfono" class="txt-crud" name="telefono[]" maxlength="20" required>
    <input type="text" placeholder="Dirección" class="txt-crud" name="direccion[]" required id="direccion" maxlenght="65">
    <select name="departamento[]" class="txt-crud">
      <?php
      $instruccion = "select * from destino";
      $destinos = [];
      $result = mysqli_query($conexion, $instruccion);
      while ($row = mysqli_fetch_assoc($result)) {
          array_push($destinos, $row);
      }
      foreach ($destinos as $destino) {
          $id_destino = $destino['id_destino'];
          $departamento = $destino['departamento_destino'];
          echo "<option value='$id_destino'>$departamento</option>";
      }
      ?>
    </select>
    <input type="text" placeholder="Volumen máx." class="txt-crud" name="volumen_max[]" maxlenght="11">
    <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
  </form>
  <a href="op-plataforma.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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