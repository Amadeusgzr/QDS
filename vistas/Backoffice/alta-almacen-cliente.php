<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
require '../../controladores/funciones.php';
if ($_POST) {
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $id_empresa_cliente = $_POST["id_empresa_cliente"];

    $numArrays = count($telefono);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('almacen_cliente', 'telefono', $telefono[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el telefono $telefono[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($telefono);
        $respuesta1 = atributosVacio($direccion);
        $respuesta2 = atributosVacio($id_empresa_cliente);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {

            $respuesta = longitud($telefono[$i], 20);
            $respuesta1 = longitud($direccion[$i], 65);
            $respuesta2 = longitud($id_empresa_cliente[$i], 11);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {

                $respuesta = numeros($telefono[$i]);
                $respuesta1 = numeros($id_empresa_cliente[$i]);

                if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {

                    $respuesta = [
                        'error' => "Éxito",
                        'respuesta' => "Almacén guardado"
                    ];
                    $instruccion = "insert into almacen_cliente(direccion, telefono) value ('$direccion[$i]', '$telefono[$i]')";
                    $conexion->query($instruccion);

                    $id_almacen_cliente = mysqli_insert_id($conexion);

                    $instruccion = "insert into tiene(id_almacen_cliente, id_empresa_cliente) value ('$id_almacen_cliente', '$id_empresa_cliente[$i]')";
                    $conexion->query($instruccion);
                } else {
                    $respuesta = [
                        'error' => "Error",
                        'respuesta' => "Debes completar el teléfono y el ID con números"
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
    header('Location: alta-almacen-cliente.php?datos=' . urlencode($respuesta));
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";

require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="alta-almacen-cliente.php" method="post">
        <legend>Agregar Almacén Cliente</legend>
        <input type="text" placeholder="Teléfono" class="txt-crud" name="telefono[]" required maxlength="20">
        <input type="tel" placeholder="Dirección" class="txt-crud" name="direccion[]" required maxlength="45" id='direccion'>
        <select name="id_empresa_cliente[]" class="estilo-select" maxlength="11">
            <option value="" selected>Empresa</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from empresa_cliente where estado != 'De baja'";
            $empresas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($empresas, $row);
            }
            foreach ($empresas as $empresa) {
                $id_empresa_cliente = $empresa['id_empresa_cliente'];
                $nombre_de_empresa = $empresa['nombre_de_empresa'];

                echo "<option value='$id_empresa_cliente'>$nombre_de_empresa</option>";
            }
            ?>
        </select>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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