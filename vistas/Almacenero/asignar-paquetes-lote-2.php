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

<div id="div-tabla-lote">
    <h1 id="h1-lote">Asignar paquetes a lote</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID del paquete</th>
                <th>Destino</th>
                <th>Empresa remitente</th>
                <th>Riesgo</th>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion" id="fila-1">
                <td>1001</td>
                <td>Gral. Rivera 1798</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1002</td>
                <td>Av. Italia 1492</td>
                <td>CRECOM</td>
                <td>Si</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
            <tr class="fila-ingreso-lote fila-opcion">
                <td>1003</td>
                <td>18 de Julio esq. Río Negro 1295</td>
                <td>CRECOM</td>
                <td>No</td>
            </tr>
        </table>
    </div>
    <div id="mov-lote">
        <button class="btn-limpiar estilo-boton btns-as-lote">Borrar</button>
        <div id="btns-mov-lote">
            <a href="asignar-paquetes-lote.php">
                <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
            </a>
            <!--a-->
            <button class="boton-siguiente estilo-boton btns-as-lote" id="submit-as-lote-2">Siguiente</button>
            <!--a-->
        </div>
    </div>
</div>

<script src="../js/asignar-paquetes-lote-2.js"></script>

</body>

</html>