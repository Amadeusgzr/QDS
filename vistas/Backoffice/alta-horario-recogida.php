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
        <legend class="legend-titulo">Agregar horario (recogida de paquetes)</legend>

        <p class="p-paquete p-camioneta">Camioneta</p>
        <select name="id_camioneta[]" class="estilo-select">
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from mostrar_camionetas";
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

        <p class="p-paquete p-sobre-salida">Sobre la salida</p>
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

        <p class="p-paquete p-sobre-recogida">Sobre la recogida</p>
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

            $origen = "Escuela+Superior+de+Informatica,Departamento+de+Montevideo";
            $direccionDestino = "Escuela+Superior+de+Informatica,Departamento+de+Montevideo";

            $tiempoEsperaSegundos = 600;

            $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';

            $horaEstimadaLlegadaTimestamp = strtotime("$fecha_salida[$i] $hora_salida[$i]");

            $puntosIntermedios = [];
            foreach ($id_almacenes_cliente as $key => $id_almacen_cliente) {
                $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
                $resultado = mysqli_query($conexion, $instruccion);
                $fila = mysqli_fetch_assoc($resultado);
                $puntoIntermedio = $fila["direccion"];
                array_push($puntosIntermedios, $puntoIntermedio);
            }


            $puntosIntermedios = str_replace(' ', '+', $puntosIntermedios);
            $puntosIntermedios = implode('|', $puntosIntermedios);

            $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$direccionDestino&waypoints=optimize:true|$puntosIntermedios&key=$api_key&region=uy&language=es";

            $response = file_get_contents($apiURL);
            $data = json_decode($response);

            if ($data->status === "OK") {

                $rutaOptimizada = $data->routes[0];

                // Calcular los horarios para la ruta optimizada
                $horaEstimadaLlegadaTimestamp = strtotime("$fecha_salida[0] $hora_salida[0]");
            
                foreach ($rutaOptimizada->legs as $leg) {
                    $duracionEnSegundos = $leg->duration->value;

                    $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

                    $direccion = $leg->end_address;
                    $direccion = explode(",", $direccion);
                    $direccion = trim($direccion[0]);
                    echo $direccion . "<br>";



                    $fechaEstimadaLlegada = date("Y-m-d", $horaEstimadaLlegadaTimestamp);
                    $horaEstimadaLlegada = date("H:i:s", $horaEstimadaLlegadaTimestamp);

                    echo "Fecha estimada de llegada: $fechaEstimadaLlegada<br>";
                    echo "Hora estimada de llegada: $horaEstimadaLlegada<br>";

                    $fecha = $fechaEstimadaLlegada . " "  . $horaEstimadaLlegada;
                    $fecha1 = $fecha_salida[$i] . " "  . $hora_salida[$i];

                    $instruccion = "select * from almacen_cliente where direccion = '$direccion'";
                    $resultado = mysqli_query($conexion, $instruccion);
                    $fila = mysqli_fetch_assoc($resultado);
                    if(isset($fila["id_almacen_cliente"])){

                    $id_almacen_cliente =  $fila["id_almacen_cliente"];

                    $instruccion = "insert into recoge(id_camioneta, id_almacen_cliente, fecha_recogida_ideal, fecha_salida, almacen_central_salida) value ('$id_camioneta[$i]', '$id_almacen_cliente', '$fecha', '$fecha1', '$id_almacen_central[$i]')";
                    $conexion->query($instruccion);
                    }

                }

            } else {
                echo "Error al calcular la ruta: " . $data->status;
                break;
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

    // Formar la cadena de waypoints para la API de Optimización de Rutas
    $waypoints = implode('|', $direccionesPuntosRecogida);

    // Hacer solicitud a la API de Direcciones de Google con optimización de ruta
    $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$destino&waypoints=optimize:true|$waypoints&key=$api_key&region=uy&language=es";

    $response = file_get_contents($apiURL);
    $data = json_decode($response);

    if ($data->status === "OK") {
        // Procesar la respuesta y obtener la ruta optimizada
        $rutaOptimizada = $data->routes[0];

        // Calcular los horarios para la ruta optimizada
        $horaEstimadaLlegadaTimestamp = strtotime("$fecha_salida[0] $hora_salida[0]");

        foreach ($rutaOptimizada->legs as $leg) {
            $duracionEnSegundos = $leg->duration->value;

            $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

            // Resto de tu código para almacenar la información en la base de datos
        }
    } else {
        echo "Error al calcular la ruta optimizada: " . $data->status;
    }
    ?>
</div>

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>