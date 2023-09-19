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

<div class="form-crud">
    <form action="">
        <legend>Eliminar Almacén cliente</legend>
        <p class="adv">¿Seguro que quiere eliminar el siguiente almacén? Los cambios serán irreversibles</p>
        <p><b>ID: </b>"147"</p>
        <p><b>Teléfono: </b>"2525 2525"</p>
        <p><b>Dirección: </b>"narnia"</p>
        <a href=""><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if($_POST){
    $cedula = $_POST["cedula"];
    $nombre_completo = $_POST["nombre_completo"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];



    $conexion = new mysqli("127.0.0.1","root","","logistic");
    $instruccion = "insert into camionero(cedula, nombre_completo, mail, telefono) value ('$cedula', '$nombre_completo', '$mail', '$telefono')";
    $conexion->query($instruccion);
}

?>
