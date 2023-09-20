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
    if (isset($_GET['id_camionero'])) {
    $id_camionero = $_GET['id_camionero'];

    $instruccion = "select * from camionero where id_camionero=$id_camionero";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $cedula = $fila["cedula"];
        $nombre_completo = $fila["nombre_completo"];
        $telefono = $fila["telefono"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Consultar Camionero</legend>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b>ID: </b>$id_camionero</p>
        <p><b>Cédula: </b>$cedula</p>
        <p><b>Nombre: </b>$nombre_completo</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-camioneros.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 
} else if(isset($_GET['id_almacen_cliente'])){
    $id_almacen_cliente = $_GET['id_almacen_cliente'];

    
    $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
    $filas = $conexion->query($instruccion); 

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];

        echo "<div class='form-crud'>
        <legend>Consultar Almacen Cliente</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_cliente</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <a href='op-almacen-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 

}else if(isset($_GET['id_almacen_central'])){
    $id_almacen_central = $_GET['id_almacen_central'];

    
    $instruccion = "select * from almacen_central where id_almacen_central=$id_almacen_central";
    $filas = $conexion->query($instruccion); 

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_central = $fila["id_almacen_central"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];

        echo "<div class='form-crud'>
        <legend>Consultar Almacen Central</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_central</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <a href='op-almacen-central.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 

}else if(isset($_GET['id_plataforma'])){
    $id_plataforma = $_GET['id_plataforma'];

    
    $instruccion = "select * from plataforma where id_plataforma=$id_plataforma";
    $filas = $conexion->query($instruccion); 

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_plataforma = $fila["id_plataforma"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];
        $departamento = $fila["departamento"];
        $volumen = $fila["volumen_maximo"];

        echo "<div class='form-crud'>
        <legend>Consultar Plataforma</legend>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b>ID: </b>$id_plataforma</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <p><b>Departamento: </b>$departamento</p>
        <p><b>Volumen máx.: </b>$volumen</p>
        <a href='op-plataforma.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 

}

?>
