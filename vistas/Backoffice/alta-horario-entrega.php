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
        <legend>Agregar horarios de entrega</legend>

        <p class="p-paquete">Camión</p>
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

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error']) {

            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Horario asignado correctamente"
            ];

            $instruccion = "SELECT DISTINCT plataforma.direccion, plataforma.ubicacion FROM transporta INNER JOIN lote ON transporta.id_lote = lote.id_lote INNER JOIN lleva ON lote.id_lote = lleva.id_lote INNER JOIN plataforma ON lleva.id_plataforma = plataforma.id_plataforma WHERE id_camion = $id_camion[$i]";
            $lotes = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($lotes, $row);
            }
            foreach ($lotes as $lote) {
                $direccion = $lote["direccion"];
                $ubicacion = $lote["ubicacion"];



                $fecha_ideal_entrega = "2023-11-23";
                $hora_ideal_entrega = "14:00:00";

                $instruccion = "SELECT * FROM transporta INNER JOIN lote ON transporta.id_lote = lote.id_lote INNER JOIN lleva ON lote.id_lote = lleva.id_lote INNER JOIN plataforma ON lleva.id_plataforma = plataforma.id_plataforma WHERE id_camion = $id_camion[$i]";
                $lotes1 = [];
                $result = mysqli_query($conexion, $instruccion);
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($lotes1, $row);
                }
                foreach ($lotes1 as $lote1) {
                    $id_lote = $lote1["id_lote"];
                    echo $id_lote;
                    $instruccion = "SELECT * FROM transporta INNER JOIN lote ON transporta.id_lote = lote.id_lote INNER JOIN lleva ON lote.id_lote = lleva.id_lote INNER JOIN plataforma ON lleva.id_plataforma = plataforma.id_plataforma WHERE plataforma.direccion = '$direccion' AND plataforma.ubicacion = '$ubicacion' AND lote.id_lote = '$id_lote'";
                    $resultado = mysqli_query($conexion, $instruccion);
                    $fila =  mysqli_fetch_assoc($resultado);
                    if (isset($fila)) {
                        if (count($fila) > 0) {
                            $instruccion = "UPDATE lleva SET fecha_entrega_ideal = '$fecha_ideal_entrega', hora_entrega_ideal = '$hora_ideal_entrega', fecha_salida = '$fecha_salida[$i]', hora_salida = '$hora_salida[$i]', almacen_central_salida = $id_almacen_central[$i] WHERE id_lote = $id_lote";
                            mysqli_query($conexion, $instruccion);
                        }
                    }
                }
                echo "<br>";
            }

            // $origen = "FelipeSanguinetti2474,DepartamentodeMontevideo";
            // $direccionDestino = "FelipeSanguinetti2474,DepartamentodeMontevideo";

            // $tiempoEsperaSegundos = 600;

            // $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';

            // $horaEstimadaLlegadaTimestamp = strtotime("$fecha_salida[$i] $hora_salida[$i]");

            // foreach ($id_almacenes_cliente as $key => $id_almacen_cliente) {
            //     $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
            //     $resultado = mysqli_query($conexion, $instruccion);
            //     $fila =  mysqli_fetch_assoc($resultado);
            //     $puntoIntermedio = $fila["direccion"];


            //     $puntoIntermedio = str_replace(' ', '', $puntoIntermedio);
            //     $puntoIntermedio = "$puntoIntermedio,DepartamentodeMontevideo";
            //     echo $puntoIntermedio . "<br>";


            //     $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$puntoIntermedio&key=$api_key&region=uy&language=es";

            //     $response = file_get_contents($apiURL);
            //     $data = json_decode($response);

            //     if ($data->status === "OK") {
            //         $duracionEnSegundos = $data->routes[0]->legs[0]->duration->value;

            //         $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

            //         // if ($key > 0) {
            //         //     $horaEstimadaLlegadaTimestamp += $tiempoEsperaSegundos;
            //         // }

            //         $fechaEstimadaLlegada = date("Y-m-d", $horaEstimadaLlegadaTimestamp);
            //         $horaEstimadaLlegada = date("H:i:s", $horaEstimadaLlegadaTimestamp);

            //         echo "Fecha estimada de llegada: $fechaEstimadaLlegada<br>";
            //         echo "Hora estimada de llegada: $horaEstimadaLlegada<br>";

            //         $origen = $puntoIntermedio;

            //         $instruccion = "insert into recoge(id_camioneta, id_almacen_cliente, fecha_recogida_ideal, hora_recogida_ideal, fecha_salida, hora_salida, almacen_central_salida) value ('$id_camioneta[$i]', '$id_almacen_cliente', '$fechaEstimadaLlegada', '$horaEstimadaLlegada', '$fecha_salida[$i]', '$hora_salida[$i]', '$id_almacen_central[$i]')";
            //         $conexion->query($instruccion);
            //     } else {
            //         echo "Error al calcular la ruta: " . $data->status;
            //         break;
            //     }
            // }

            // $apiURL = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$direccionDestino&key=$api_key&region=uy&language=es";
            // $response = file_get_contents($apiURL);
            // $data = json_decode($response);

            // if ($data->status === "OK") {
            //     $duracionEnSegundos = $data->routes[0]->legs[0]->duration->value;

            //     // if (count($id_almacenes_cliente) > 0) {
            //     //     $horaEstimadaLlegadaTimestamp += $tiempoEsperaSegundos;
            //     //  }

            //     $horaEstimadaLlegadaTimestamp += $duracionEnSegundos;

            //     $fechaEstimadaLlegada = date("Y-m-d", $horaEstimadaLlegadaTimestamp);
            //     $horaEstimadaLlegada = date("H:i:s", $horaEstimadaLlegadaTimestamp);

            //     // Imprimir la fecha y la hora estimadas de llegada
            //     echo "Fecha estimada de llegada: $fechaEstimadaLlegada<br>";
            //     echo "Hora estimada de llegada: $horaEstimadaLlegada<br>";
            // } else {
            //     echo "Error al calcular la ruta al destino final: " . $data->status;
            // }
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    // header("Location: alta-horario-entrega.php?datos=" . urlencode($respuesta));
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