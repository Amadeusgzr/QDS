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
$id_camioneta = $_GET['icth'];
$fecha_salida = $_GET["fs"];
$almacen_central_salida = $_GET["acs"];

$instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida'";
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
        <legend class="legend-m-horario-recogida">Modificar horario recogida</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p class="p-paquete p-camioneta">Camioneta</p>
            <?php
            $instruccion = "select * from mostrar_camionetas where id_camioneta = $id_camioneta";
            $camionetas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($camionetas, $row);
            }
            foreach ($camionetas as $camioneta) {
                $id_camioneta1 = $camioneta['id_camioneta'];
                $matricula = $camioneta['matricula'];
                $estado = $camioneta['estado'];
                if ($id_camioneta == $id_camioneta1){
                    echo "<input value='$id_camioneta1' name='icth[]' hidden>";
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
        $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta inner join almacen_cliente on recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join tiene on tiene.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' ORDER BY fecha_recogida_ideal ASC;";
        $filas = $conexion->query($instruccion);

        foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
            echo "<hr>";
            echo "<p><b>Almacén</b></p>";
            $id_almacen_cliente = $fila["id_almacen_cliente"];
            $fecha_recogida_ideal = $fila["fecha_recogida_ideal"];
            $direccion_almacen = $fila["direccion"];
            $empresa = $fila["nombre_de_empresa"];

            $fecha_recogida_ideal = new DateTime($fecha_recogida_ideal);

            $fecha = $fecha_recogida_ideal->format('Y-m-d'); 
            $hora = $fecha_recogida_ideal->format('H:i:s'); 
            echo "<select name='iacl[]' class='estilo-select'>
            <option value='' selected>Almacén Cliente</option>";
            $instruccion = "select * from almacen_cliente inner join tiene on almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente";
            $almacenes_cliente = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($almacenes_cliente, $row);
            }
            foreach ($almacenes_cliente as $almacen_cliente) {
                $id_almacen_cliente1 = $almacen_cliente['id_almacen_cliente'];
                $direccion = $almacen_cliente['direccion'];
                $empresa = $almacen_cliente['nombre_de_empresa'];
                if ($id_almacen_cliente == $id_almacen_cliente1){
                    echo "<option value='$id_almacen_cliente1' selected>$direccion - $empresa</option>";
                } else{
                    echo "<option value='$id_almacen_cliente1'>$direccion - $empresa</option>";

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
    <a href="op-gestion-paquete-recogida.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>