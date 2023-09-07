<?php

require 'vistas/plantillas/headerIndex.php';

?>

    <h1 id="h1-index">quick distribution service</h1>

    <form action="vistas/aplicacion-seguimiento.php" id="form-rastreo">
        <legend>Rastrear envío</legend>
        <p id="p-rastreo">Ingresa el código del envío para poder rastrearlo</p>
        <div id="div-datos-rastreo">
            <input id="codigo-rastreo" type="text" placeholder="xxxx-xxxx-xxxx" maxlength="14" autocomplete="off" required size="13">
            <input id="submit-rastreo" type="submit" value="Rastrear">
        </div>
    </form>

    

<?php

require 'vistas/plantillas/footer.php';

?>