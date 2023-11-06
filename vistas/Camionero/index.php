<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'camionero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<!DOCTYPE html>
<?php
    if ($_SESSION['tipo_usu'] == 'admin') {
        echo "<div class='div-btn-uno'><a href='../Backoffice/index.php'><button class='boton-volver estilo-boton'>Volver</button></a></div>";
    }
?>
<main class="main-aplicacion">
    <a href="recoger-paquetes-1.php" class="opcion-aplicacion" id="op1">
        <h2>Recogida de paquetes</h2>
        <p>Gestión de paquetes a recoger</p>
        <div class="div-img-icono"><img src="../img/iconos/paquete.png" alt=""></div>
    </a>
    <a href="entregar-lotes-1.php" class="opcion-aplicacion" id="op2">
        <h2>Entrega de lotes</h2>
        <p>Gestión de lotes a entregar</p>
        <div class="div-img-icono"><img src="../img/iconos/lote.png" alt=""></div>
    </a>
</main>

</body>

</html>