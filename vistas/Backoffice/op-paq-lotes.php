<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<h1 id="h1-camioneros">Paquetes y Lotes</h1>

<main id="main-doble">
    <div class="opcion-doble">
    <h2 class="h2-doble">Paquetes</h2>
        <a href="" class="opcion-aplicacion-2" id="op1">
            <h2>Alta</h2>
            <p>Ingresar un nuevo Paquete al sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op2">
            <h2>Baja</h2>
            <p>Eliminar un Paquete del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op3">
            <h2>Modificación</h2>
            <p>Modificar un Paquete del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op4">
            <h2>Consulta</h2>
            <p>Consultar los datos de uno o varios Paquetes</p>
        </a>
    </div>
    
    <div class="opcion-doble">
    <h2 class="h2-doble">Lotes</h2>
        <a href="" class="opcion-aplicacion-2" id="op1">
            <h2>Alta</h2>
            <p>Ingresar un nuevo Lote al sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op2">
            <h2>Baja</h2>
            <p>Eliminar un Lote del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op3">
            <h2>Modificación</h2>
            <p>Modificar un Lote del sistema</p>
        </a>
        <a href="" class="opcion-aplicacion-2" id="op4">
            <h2>Consulta</h2>
            <p>Consultar los datos de uno o varios Lotes</p>
        </a>
    </div>
</main>