<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<?php
include("../../modelos/db.php");
$id_camion = $_GET['id_camion_horario'];
$fecha_salida = $_GET["fs"];
$almacen_central_salida = $_GET["acs"];

$instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida'";
$filas = $conexion->query($instruccion);
$filas = $filas->fetch_all(MYSQLI_ASSOC);

if (count($filas) > 0) {
    foreach ($filas as $fila) {
        $matricula = $fila["matricula"];
        $fecha_salida = $fila["fecha_salida"];
        $almacen_central_salida = $fila["almacen_central_salida"];

        $fecha_salida = new DateTime($fecha_salida);

        $fecha0 = $fecha_salida->format('Y-m-d'); 
        $hora0 = $fecha_salida->format('H:i:s'); 

        $fecha_salida = $fila["fecha_salida"];

    }
}
?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-horario-recogida">Modificar horario entrega</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p class="p-paquete p-camioneta">Camión</p>
            <?php
            $instruccion = "select * from mostrar_camiones where id_camion = $id_camion";
            $camiones = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camiones, $row);
            }
            foreach ($camiones as $camion) {
                $id_camion1 = $camion['id_camion'];
                $matricula = $camion['matricula'];
                $estado = $camion['estado'];
                if ($id_camion == $id_camion1){
                    echo "<input value='$id_camion1' name='id_camion_horario[]' hidden>";
                    echo $matricula . " - " . $estado;
                }
            }

            ?>
        <p class="p-paquete p-sobre-salida">Sobre la salida</p>
            <?php
            $instruccion = "select * from almacen_central where id_almacen_central = $almacen_central_salida";
            $almacenes_centrales = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_centrales, $row);
            }
            foreach ($almacenes_centrales as $almacen_central) {
                $id_almacen_central = $almacen_central['id_almacen_central'];
                $numero_almacen = $almacen_central['numero_almacen'];
                if ($id_almacen_central == $almacen_central_salida){
                    echo "<input value='$id_almacen_central' name='iac[]' hidden>";
                    echo "Almacen " . $id_almacen_central ." - Puerta " . $numero_almacen;
                } else{
                    echo "<option value='$id_almacen_central'>Almacen $id_almacen_central - Puerta $numero_almacen</option>";
                }
            }
            ?>
        </select>
        <input type="date" placeholder="Fecha salida" class="txt-crud" name="fecha_salida[]" required value="<?=$fecha0?>" hidden>
        <input type="time" placeholder="Hora salida" class="txt-crud" name="hora_salida[]" required value="<?=$hora0?>" hidden>
        <p><?=$fecha0?></p>
        <p><?=$hora0?></p>

        <?php
        $instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion inner join plataforma on lleva.id_plataforma = plataforma.id_plataforma where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida' ORDER BY fecha_entrega_ideal ASC;";
        $filas = $conexion->query($instruccion);

        foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
            echo "<hr>";
            echo "<p><b>Almacén</b></p>";
            $id_plataforma = $fila["id_plataforma"];
            $fecha_entrega_ideal = $fila["fecha_entrega_ideal"];
            $direccion_plataforma = $fila["direccion"];

            $fecha_entrega_ideal = new DateTime($fecha_entrega_ideal);

            $fecha = $fecha_entrega_ideal->format('Y-m-d'); 
            $hora = $fecha_entrega_ideal->format('H:i:s'); 
            echo "<select name='ip[]' class='estilo-select'>
            <option value='' selected>Plataforma</option>";
            $instruccion = "select * from plataforma";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma1 = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];

                if ($id_plataforma == $id_plataforma1){
                    echo "<option value='$id_almacen_cliente1' selected>$direccion</option>";
                } else{
                    echo "<option value='$id_almacen_cliente1'>$direccion</option>";

                }
            }
            echo "</select>";
            echo"<input value='$fecha' type='date' required class='txt-crud' placeholder='Fecha recogida' name='fecha_recogida[]'>
            <input value='$hora' type='time' required class='txt-crud' placeholder='Hora recogida' name='hora_recogida[]'>
            ";
        }
        ?>
                <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>

    </form>
    <a href="op-gestion-lote-entrega.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>