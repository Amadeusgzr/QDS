<?php
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

    <div id="div-tabla-lote">
        <h1 id="h1-lote">Camioneros</h1>
        <div class="contenedor-tabla">
            <table id="tabla-admin-camioneros">
                <tr class="fila-ingreso-lote">
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th class="th-op">OP</th>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion" id="fila-1">
                    <td>Lionel Messi</td>
                    <td>Repartiendo</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Marcelo Tinelli</td>
                    <td>No disponible</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">        
                    <td>Pampita</td>
                    <td>Repartiendo</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Orlando Petinatti</td>
                    <td>No disponible</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion" id="fila-1">
                    <td>Lionel Messi</td>
                    <td>Repartiendo</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Marcelo Tinelli</td>
                    <td>No disponible</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Pampita</td>
                    <td>Repartiendo</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Orlando Petinatti</td>
                    <td>No disponible</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Marcelo Tinelli</td>
                    <td>No disponible</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
                <tr class="fila-ingreso-lote fila-opcion">
                    <td>Pampita</td>
                    <td>Repartiendo</td>
                    <td class="td-op">
                        <a href="baja-camionero.php"><button>B</button></a>
                        <a href="modificar-camionero.php"><button>M</button></a>
                        <a href="consultar-camionero.php"><button>C</button></a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="mov-lote">
            <button class="btn-limpiar estilo-boton btns-as-lote">Reiniciar</button>
            <div id="btns-mov-lote">
                <a href="aplicacion-administrador.php">
                    <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
                </a>
                <!--a-->
                    <button class="boton-siguiente estilo-boton btns-as-lote" id="submit-as-lote-2">Siguiente</button>
                <!--a-->
            </div>
        </div>
        <div id="mov-lote2">
            <div class="div-mov-lote">
                <a href="alta-camionero.php"><button class="estilo-boton btns-as-lote" id="op-alta">Agregar</button></a>
                <button class="estilo-boton btns-as-lote" id="op-baja">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="../js/asignar-paquetes-lote-2.js"></script>

</body>
</html>