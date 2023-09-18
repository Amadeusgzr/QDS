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

    <div id="div-lote-3">
        <h2 id="h2-lote">Confirmar creación de Lote</h2>
        <div id="cabecera-lote">
            <div class="div-cabecera-lote">
                <p id="p-resumen-lote">
                Almacén destino:
                <br>Camión asignado:
                <br>Fecha traslado:
                <br>Hora traslado:
                <br>Contenido frágil:
                <br>Detalles:
                </p>
            </div>
        </div>
        <div id="mov-lote-3">
            <a href="ingreso-lote.php">
                <button class="boton-volver estilo-boton">Volver</button>
            </a>
            <a href="">
                <button class="boton-siguiente estilo-boton">Siguiente</button>
            </a>
        </div>
    </div>

</body>
</html>