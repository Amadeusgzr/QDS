<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
   exit();
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<!DOCTYPE html>

<main class="main-aplicacion">
    <a href="op-paquetes-cliente.php" class="opcion-aplicacion" id="op1">
        <h2>Paquetes en almacén</h2>
        <p>Gestión de paquetes dentro del almacén</p>
        <div class="div-img-icono"><img src="../img/iconos/paquete.png" alt=""></div>
    </a>
    <a href="op-paquetes-transcurso.php" class="opcion-aplicacion" id="op2">
        <h2>Paquetes en transcurso</h2>
        <p>Consulta de paquetes</p>
        <div class="div-img-icono"><img src="../img/iconos/lote.png" alt=""></div>
    </a>
    <a href="op-paquetes-entregados.php" class="opcion-aplicacion" id="op3">
        <h2>Paquetes entregados</h2>
        <p>Consulta de paquetes entregados</p>
        <div class="div-img-icono2"><img src="../img/iconos/paquete-lote.png" alt=""></div>
    </a>
</main>





</body>

</html>