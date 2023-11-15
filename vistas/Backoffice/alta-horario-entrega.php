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
    <form action="alta-horario-entrega.php" method="post">
        <legend class="legend-alta-horario-entrega">Agregar horarios de entrega</legend>

        <p class="p-paquete p-camion">Camión</p>
        <select name="id_camion[]" class="estilo-select">
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from mostrar_camiones";
            $camiones = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camiones, $row);
            }
            foreach ($camiones as $camion) {
                $id_camion = $camion['id_camion'];
                $matricula = $camion['matricula'];
                $estado = $camion['estado'];

                echo "<option value='$id_camion'>$matricula - $estado</option>";
            }
            ?>
        </select>

        <p class="p-paquete p-sobre-la-salida">Sobre la salida</p>
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

        <p class="p-paquete p-sobre-la-entrega">Sobre la entrega</p>
        <select name="id_plataforma[]" class="estilo-select">
            <option value="" selected>Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma inner join destino on plataforma.ubicacion = destino.id_destino";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento_destino'];
                echo "<option value='$id_plataforma'>$direccion, $departamento</option>";
            }
            ?>
        </select>
        <select name="id_plataforma[]" class="estilo-select">
            <option value="" selected>Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma inner join destino on plataforma.ubicacion = destino.id_destino";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento_destino'];
                echo "<option value='$id_plataforma'>$direccion, $departamento</option>";
            }
            ?>
        </select>


        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>

    </form>
    <a href="op-gestion-lote-entrega.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $id_camion = $_POST["id_camion"];

    $id_almacen_central = $_POST["id_almacen_central"];
    $fecha_salida = $_POST["fecha_salida"];
    $hora_salida = $_POST["hora_salida"];

    $id_plataformas = $_POST["id_plataforma"];



    $numArrays = count($id_camion);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('camion', 'id_camion', $id_camion[$i]);
        if ($respuesta['error'] !== "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "No existe una camioneta con el ID $id_camion[$i]"
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

        $respuesta = atributosVacio($id_camion);

        $respuesta1 = atributosVacio($id_almacen_central);
        $respuesta2 = atributosVacio($fecha_salida);
        $respuesta3 = atributosVacio($hora_salida);

        $respuesta4 = atributosVacio($id_plataformas);


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
            foreach ($id_plataformas as $key => $id_plataforma) {
                $instruccion = "select * from plataforma inner join destino on plataforma.ubicacion = destino.id_destino where id_plataforma=$id_plataforma";
                $resultado = mysqli_query($conexion, $instruccion);
                $fila = mysqli_fetch_assoc($resultado);
                $puntoIntermedio = $fila["direccion"] . ", Departamento de " . $fila["departamento_destino"];

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

                    $fecha = $fechaEstimadaLlegada . " " . $horaEstimadaLlegada;
                    $fecha1 = $fecha_salida[$i] . " " . $hora_salida[$i];

                    $instruccion = "select * from plataforma where direccion = '$direccion'";
                    $resultado = mysqli_query($conexion, $instruccion);
                    $fila = mysqli_fetch_assoc($resultado);
                    if (isset($fila["id_plataforma"])) {

                        $id_plataforma = $fila["id_plataforma"];
                        echo $id_plataforma;

                        $instruccion = "insert into lleva(id_camion, id_plataforma, fecha_entrega_ideal, fecha_salida, almacen_central_salida) value ('$id_camion[$i]', '$id_plataforma', '$fecha', '$fecha1', '$id_almacen_central[$i]')";
                        $conexion->query($instruccion);
                    }
                }
            } else {
                $respuesta = [
                    'error' => "Error",
                    'respuesta' => "Hay atributos que no deben estar vacíos"
                ];
            }
        }    // header("Location: alta-horario-entrega.php?datos=" . urlencode($respuesta));
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