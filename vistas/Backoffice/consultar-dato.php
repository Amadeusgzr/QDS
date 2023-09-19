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
    $conexion = new mysqli("127.0.0.1", "root", "", "logistic");
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    $instruccion = "select * from camionero where cedula=$cedula";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $nombre_completo = $fila["nombre_completo"];
        $telefono = $fila["telefono"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Consultar Camionero</legend>
        <p class='subtitulo-crud'>Datos del camionero</p>
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
        <legend>Eliminar Almacen Cliente</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_cliente</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <a href='op-almacen-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 

}

?>
