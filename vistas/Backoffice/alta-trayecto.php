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
    <form action="alta-trayecto.php" method="post" id="form-alta-tray">
        <legend>Agregar Trayecto</legend>
        <select name="destino" class="estilo-select">
            <option disabled selected>Dirección Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento'];

                echo "<option value='$direccion, Departamento de $departamento'>$direccion, $departamento</option>";
            }
            ?>
        </select>
        <p>Plataformas Intermedias</p>
        <select name="intermedio[]" class="estilo-select">
            <option disabled selected>Dirección Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento'];

                echo "<option value='$direccion, Departamento de $departamento'>$direccion, $departamento</option>";
            }
            ?>
        </select>
        <select name="intermedio[]" class="estilo-select">
            <option disabled selected>Dirección Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento'];

                echo "<option value='$direccion, Departamento de $departamento'>$direccion, $departamento</option>";
            }
            ?>
        </select>

        <a href="" id="btn-alta-tray"><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-trayecto.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>


<?php


if ($_POST) {
    $origen = "Felipe Sanguinetti 2474";
    $destino = $_POST['destino'];
    $intermedios = $_POST['intermedio'];
    $intermedios1 = [];

    
    foreach($intermedios as $intermedio){
        if(!isset($intermedio) || is_null($intermedio) || empty(trim($intermedio))){
        } else {
            array_push($intermedios1, $intermedio);
        }
    }
        $origen1 = str_replace(' ', '', $origen);
        $destino1 = str_replace(' ', '', $destino);
        $intermedios2 = str_replace(' ', '', $intermedios1);

        $waypointsJson = json_encode($intermedios2);

        $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';
        $intermedios1_string = implode('|', $intermedios1);
        $intermedios_string = implode('|', $intermedios2);


// ...

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen1&destination=$destino1&waypoints=optimize:true|$intermedios_string&key=$api_key&region=uy&language=es";

        $response = file_get_contents($url);

        if ($response) {
            $datos = json_decode($response, true);

    
            if ($datos['status'] == 'OK') {
                $distanciaTotal = 0;
                $duracionTotal = 0;

                foreach ($datos['routes'][0]['legs'] as $leg) {
                    foreach ($leg['steps'] as $step) {

                        $distanciaTotal += $step['distance']['value'];
                        $duracionTotal += $step['duration']['value'];

                    }
                }
                $distanciaTotal = number_format($distanciaTotal / 1000 , 2);
                $duracionTotal = round($duracionTotal / 60);

            } else {
                echo 'No se pudo obtener una respuesta de la API de Google Maps Directions.';
            }
        }
}

include("../../modelos/db.php");
$instruccion = "insert into trayecto(destino, destinos_intermedios, distancia_recorrida, duracion_total) value ('$destino','$intermedios1_string','$distanciaTotal','$duracionTotal')";
$conexion->query($instruccion);


?>