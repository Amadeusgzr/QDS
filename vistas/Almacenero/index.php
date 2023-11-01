<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
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
    <a href="op-paquetes.php" class="opcion-aplicacion" id="op1">
        <h2>Paquetes</h2>
        <p>Gestión de paquetes</p>
        <div class="div-img-icono"><img src="../img/iconos/paquete.png" alt=""></div>
    </a>
    <a href="op-lotes.php" class="opcion-aplicacion" id="op2">
        <h2>Lotes</h2>
        <p>Gestión de lotes</p>
        <div class="div-img-icono"><img src="../img/iconos/lote.png" alt=""></div>
    </a>
    <a href="asignar-paquetes-lote-menu.php" class="opcion-aplicacion" id="op3">
        <h2>Asignar Paquetes a Lote</h2>
        <p>Asigne paquetes a los diferentes lotes</p>
        <div class="div-img-icono2"><img src="../img/iconos/paquete-lote.png" alt=""></div>
    </a>
    <a href="asignar-lotes-camion-1.php" class="opcion-aplicacion" id="op4">
        <h2>Asignar Lotes a Camión</h2>
        <p>Asigne lotes a los diferentes camiones</p>
        <div class="div-img-icono2"><img src="../img/iconos/lote-camion.png" alt=""></div>
    </a>

</main>





</body>

</html>