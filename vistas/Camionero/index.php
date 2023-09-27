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

<h1 id="h1-camionero">Lotes dentro del camión</h1>

<table id="tabla-camionero">
    <tr class="fila-lote-camionero fila-opcion">
        <th>ID del lote</th>
        <th>Destino</th>
        <th>Empresa remitente</th>
        <th>Riesgo</th>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1001</td>
        <td>Gral. Rivera 1798</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1002</td>
        <td>Av. Italia 1492</td>
        <td>CRECOM</td>
        <td>Si</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
    <tr class="fila-lote-camionero fila-opcion">
        <td>1003</td>
        <td>18 de Julio esq. Río Negro 1295</td>
        <td>CRECOM</td>
        <td>No</td>
    </tr>
</table>

<form action="" method="post">
    <select name="matricula" id="">
        <option value="" selected>Camion</option>
        <?php
        require("../../controladores/api/camion/obtenerDato.php");
        echo $decode;
        foreach ($decode as $camion) {
            $id_camion = $camion["id_camion"];
            $matricula = $camion["matricula"];
            echo "<option value='$id_camion'>$matricula</option>";
        }
        ?>
    </select>
    <input type="submit" value="Ver">
</form>

<script src="../js/aplicacion-camionero.js"></script>

</body>

</html>