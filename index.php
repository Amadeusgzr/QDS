<?php
session_start();
echo "<link rel='stylesheet' href='vistas/css/estilos.css'>";
// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    require 'vistas/plantillas/headerIndex.php';
} else {
    require 'vistas/plantillas/headerIndexIngresado.php';
    require 'vistas/plantillas/menu-cuentaIndex.php';
}


?>


<h1 id="h1-index">quick distribution service</h1>

<form action="vistas/aplicacion-seguimiento.php" id="form-rastreo" method="get">
    <legend id="sub-rastreo">Rastrear envío</legend>
    <p id="p-rastreo">Ingresa el código del envío para poder rastrearlo</p>
    <div id="div-datos-rastreo">
        <input id="codigo-rastreo" type="text" placeholder="xxxx-xxxx-xxxx" maxlength="14" autocomplete="off" required size="13" name="codigo_seguimiento" spellcheck="false">
        <input id="submit-rastreo" type="submit" value="Rastrear">
    </div>
</form>

<script src="vistas/js/index.js"></script>
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="40f54e80-c222-466b-92aa-d3e1f9c64995";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>



<?php require 'vistas/plantillas/footer.php'; ?>


