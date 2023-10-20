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



<main class="main-aplicacion">
    <a href="op-camioneros.php" class="opcion-aplicacion" id="op1">
        <h2>Camioneros</h2>
        <p>Gestión de Camioneros</p>
        <div class="div-img-icono"><img src="../img/iconos/icono-usuario.png" alt=""></div>
    </a>
    <a href="op-camiones.php" class="opcion-aplicacion" id="op2">
        <h2>Camiones</h2>
        <p>Gestión de Camiones</p>
        <div class="div-img-icono"><img src="../img/iconos/camion.png" alt=""></div>
    </a>
    <a href="../Almacenero/op-paq-lotes.php" class="opcion-aplicacion" id="op3">
        <h2>Paquetes y Lotes</h2>
        <p>Gestión de Paquetes y Lotes</p>
        <div class="div-img-icono"><img src="../img/iconos/paquete.png" alt=""></div>
    </a>
    <a href="op-almacenes.php" class="opcion-aplicacion" id="op4">
        <h2>Almacenes</h2>
        <p>Gestión de Almacenes</p>
        <div class="div-img-icono"><img src="../img/iconos/almacen.png" alt=""></div>
    </a>
    <a href="op-empresas.php" class="opcion-aplicacion" id="op5">
        <h2>Empresas Cliente</h2>
        <p>Gestión de Empresas Clientes</p>
        <div class="div-img-icono"><img src="../img/iconos/empresa.png" alt=""></div>
    </a>
    <a href="op-rutas-tray.php" class="opcion-aplicacion" id="op6">
        <h2>Rutas y Trayectos</h2>
        <p>Gestión de Rutas y Trayectos</p>
        <div class="div-img-icono"><img src="../img/iconos/ruta.png" alt=""></div>
    </a>
    <a href="op-rutas-trayectos" class="opcion-aplicacion" id="op7">
        <h2>Asignar Rutas a Trayectos</h2>
        <p>Asignación de Rutas a Trayectos</p>
        <div class="div-img-icono"><img src="../img/iconos/ruta-trayecto.png" alt=""></div>
    </a>
    <a href="op-usuarios.php" class="opcion-aplicacion" id="op8">
        <h2>Usuarios</h2>
        <p>Gestión de Usuarios</p>
        <div class="div-img-icono"><img src="../img/iconos/icono-usuario.png" alt=""></div>
    </a>
    <a href="op-empresas-cliente.php" class="opcion-aplicacion" id="op8">
        <h2>Empresas-Cliente</h2>
        <p>Gestión de Empresas-Cliente</p>
        <div class="div-img-icono"><img src="../img/iconos/icono-usuario.png" alt=""></div>
    </a>
</main>

</body>

</html>