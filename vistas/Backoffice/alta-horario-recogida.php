<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../../controladores/funciones.php';
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="alta-horario-recogida.php" method="post">
        <legend>Agregar Empresa Cliente</legend>

        <p class="p-paquete">Camioneta</p>
        <select name="id_camioneta[]" class="estilo-select">
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from camioneta inner join vehiculo on camioneta.id_camioneta = vehiculo.id_vehiculo";
            $camionetas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camionetas, $row);
            }
            foreach ($camionetas as $camioneta) {
                $id_camioneta = $camioneta['id_camioneta'];
                $matricula = $camioneta['matricula'];
                $estado = $camioneta['estado'];

                echo "<option value='$id_camioneta'>$matricula - $estado</option>";
            }
            ?>
        </select>

        <p class="p-paquete">Sobre la salida</p>
        <select name="id_almacen_central[]" class="estilo-select">
        <option value="" selected>Almacén Central</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from almacen_central";
            $almacenes_centrales = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_centrales, $row);
            }
            foreach ($almacenes_centrales as $almacen_central) {
                $id_almacen_central = $almacen_central['id_almacen_central'];
                $numero_almacen = $almacen_central['numero_almacen'];
                echo "<option value='$id_almacen_central'>Almacen $id_almacen_central - Puerta $numero_almacen</option>";
            }
            ?>
        </select>
        <input type="date" placeholder="Fecha salida" class="txt-crud" name="fecha_salida[]" required>
        <input type="time" placeholder="Hora salida" class="txt-crud" name="hora_salida[]" required>

        <p class="p-paquete">Sobre la recogida</p>
        <select name="id_almacen_cliente[]" class="estilo-select">
        <option value="" selected>Almacén Cliente</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from almacen_cliente inner join tiene on almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente";
            $almacenes_cliente = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_cliente, $row);
            }
            foreach ($almacenes_cliente as $almacen_cliente) {
                $id_almacen_cliente = $almacen_cliente['id_almacen_cliente'];
                $direccion = $almacen_cliente['direccion'];
                $empresa = $almacen_cliente['nombre_de_empresa'];
                echo "<option value='$id_almacen_cliente'>$direccion - $empresa</option>";
            }
            ?>
        </select>
        <select name="id_almacen_cliente[]" class="estilo-select">
        <option value="" selected>Almacén Cliente</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from almacen_cliente inner join tiene on almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente";
            $almacenes_cliente = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_cliente, $row);
            }
            foreach ($almacenes_cliente as $almacen_cliente) {
                $id_almacen_cliente = $almacen_cliente['id_almacen_cliente'];
                $direccion = $almacen_cliente['direccion'];
                $empresa = $almacen_cliente['nombre_de_empresa'];
                echo "<option value='$id_almacen_cliente'>$direccion - $empresa</option>";
            }
            ?>
        </select>

 
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>




    </form>
    <a href="op-gestion-paquete-recogida.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $id_camioneta = $_POST["id_camioneta"];

    $id_almacen_central = $_POST["id_almacen_central"];
    $fecha_salida = $_POST["fecha_salida"];
    $hora_salida = $_POST["hora_salida"];

    $id_almacenes_cliente = $_POST["id_almacen_cliente"];

    print_r($id_almacenes_cliente);

    $numArrays = count($id_camioneta);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('camioneta', 'id_camioneta', $id_camioneta[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe una camioneta con el ID $id_camioneta[$i]"
            ];
            break;
        }
        $respuesta = existencia('almacen_central', 'id_almacen_central', $id_almacen_central[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe un almacén central con el ID $id_almacen_central[$i]"
            ];
            break;
        }
        $respuesta = existencia('almacen_cliente', 'id_almacen_cliente', $id_almacenes_cliente[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe un almacén cliente con el ID $id_almacenes_cliente[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($id_camioneta);

        $respuesta1 = atributosVacio($id_almacen_central);
        $respuesta2 = atributosVacio($fecha_salida);
        $respuesta3 = atributosVacio($hora_salida);  

        $respuesta4 = atributosVacio($id_almacenes_cliente);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error") {
            
            $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Horario asignado correctamente"
            ];

            $instruccion = "insert into sale(id_vehiculo, id_almacen_central, fecha_salida, hora_salida) value ('$id_camioneta[$i]', '$id_almacen_central[$i]', '$fecha_salida[$i]', '$hora_salida[$i]')";
            $conexion->query($instruccion);

            $origen = "FelipeSanguinetti2474,DepartamentodeMontevideo";
            $direccionDestino = "FelipeSanguinetti2474,DepartamentodeMontevideo";

            $tiempoEsperaSegundos = 600; 

            $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';

            $horaEstimadaLlegadaTimestamp = strtotime("$fecha_salida[$i] $hora_salida[$i]");

            foreach ($id_almacenes_cliente as $key => $id_almacen_cliente){
                $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
                $resultado = mysqli_query($conexion, $instruccion);
                $fila =  mysqli_fetch_assoc($resultado);
                $puntoIntermedio = $fila["direccion"];


                $puntoIntermedio = str_replace(' ', '', $puntoIntermedio);
                $puntoIntermedio = "$puntoIntermedio,DepartamentodeMontevideo";
                echo $puntoIntermedio . "<br>";


                $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$puntoIntermedio&key=$api_key&region=uy&language=es";

                $response = file_get_contents($apiURL);
                $data = json_decode($response);

                if ($data->status === "OK") {
                    $duracionEnSegundos = $data->routes[0]->legs[0]->duration->value;

                    $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

                    // if ($key > 0) {
                    //     $horaEstimadaLlegadaTimestamp += $tiempoEsperaSegundos;
                    // }

                    $fechaEstimadaLlegada = date("Y-m-d", $horaEstimadaLlegadaTimestamp);
                    $horaEstimadaLlegada = date("H:i:s", $horaEstimadaLlegadaTimestamp);
    
                    echo "Fecha estimada de llegada: $fechaEstimadaLlegada<br>";
                    echo "Hora estimada de llegada: $horaEstimadaLlegada<br>";

                    $origen = $puntoIntermedio;

                    $instruccion = "insert into recoge(id_camioneta, id_almacen_cliente, fecha_recogida_ideal, hora_recogida_ideal) value ('$id_camioneta[$i]', '$id_almacen_cliente', '$fechaEstimadaLlegada', '$horaEstimadaLlegada')";
                    $conexion->query($instruccion);
                } else {
                    echo "Error al calcular la ruta: " . $data->status;
                    break;
                }
            }

            $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$direccionDestino&key=$api_key&region=uy&language=es";
            $response = file_get_contents($apiURL);
            $data = json_decode($response);

            if ($data->status === "OK") {
                $duracionEnSegundos = $data->routes[0]->legs[0]->duration->value;

                // if (count($id_almacenes_cliente) > 0) {
                //     $horaEstimadaLlegadaTimestamp += $tiempoEsperaSegundos;
                //  }

                $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

                $fechaEstimadaLlegada = date("Y-m-d", $horaEstimadaLlegadaTimestamp);
                $horaEstimadaLlegada = date("H:i:s", $horaEstimadaLlegadaTimestamp);

// Imprimir la fecha y la hora estimadas de llegada
                echo "Fecha estimada de llegada: $fechaEstimadaLlegada<br>";
                echo "Hora estimada de llegada: $horaEstimadaLlegada<br>";
                } else {
                    echo "Error al calcular la ruta al destino final: " . $data->status;
                }

        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
}





?>
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