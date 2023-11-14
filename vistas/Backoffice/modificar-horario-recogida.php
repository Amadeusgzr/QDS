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
        <legend class="legend-m-camionero">Modificar Camionero</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <input type="text" value="<?= $matricula?>">
        <input type="text" value="<?= $almacen_central_salida?>">

        <input type="date" value="<?= $fecha0?>">
        <input type="time" value="<?= $hora0?>">

        <?php
        $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta inner join almacen_cliente on recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join tiene on tiene.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' ORDER BY fecha_recogida_ideal ASC;";
        $filas = $conexion->query($instruccion);


        foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
            echo "<hr>";
            $id_almacen_cliente = $fila["id_almacen_cliente"];
            $fecha_recogida_ideal = $fila["fecha_recogida_ideal"];
            $direccion_almacen = $fila["direccion"];
            $empresa = $fila["nombre_de_empresa"];

            $fecha_recogida_ideal = new DateTime($fecha_recogida_ideal);

            $fecha = $fecha_recogida_ideal->format('Y-m-d'); 
            $hora = $fecha_recogida_ideal->format('H:i:s'); 
            
        
            echo "<p><b>Almacén:</b> $direccion_almacen - $empresa</p>
                    <input value='$fecha' type='date'>
                    <input value='$hora' type='time'>
            
            ";

        }
        ?>
    </form>
    <a href="op-gestion-paquete-recogida.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>
<?php
echo "<a href='detalles-horarios-recogida.php?icth=$id_camioneta&fs=$fecha_salida&acs=$almacen_central_salida'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>";

echo "<a href='op-gestion-paquete-recogida.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";


?>