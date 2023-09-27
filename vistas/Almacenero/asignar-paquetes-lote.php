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

<div id="div-elegir-lote">
    <h1 id="h1-lote">Asignar paquetes a lote</h1>
    <p class="adv">El lote al cual se le quiera asignar los paquetes ya debe estar creado</p>
    <select name="" id="select-lote">
        <option value="" selected disabled>Seleccionar lote</option>
        <option value="">Lote 1</option>
        <option value="">Lote 2</option>
        <option value="">Lote 3</option>
    </select>
    <div id="mov-lote-lote">
        <a href="asignar-paquetes-lote-2.php">
            <button class="boton-siguiente estilo-boton">Siguiente</button>
        </a>
        <a href="index.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
</div>

</body>

</html>