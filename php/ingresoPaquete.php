<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estiloAppAlmacenero.css">
    <link rel="icon" href="../img/logoRojo.png">
    <link href="https://fonts.googleapis.com/css2?family=Geologica&display=swap" rel="stylesheet">
    <title>QDS</title>
</head>
<body>

    <header>
        <div id="div-logo">
            <a href="index.html"><img src="../img/logoBlanco.png" alt="Logo"></a>
        </div>
        <nav>
            <a href="../index.html">Inicio</a>
            <a href="">Envíos</a>
            <a href="">Ingresar paquete</a>
            <a href="">Ver Paq. y Lotes</a>
        </nav>
        <div id="div-cuenta">
            <img id="img-cuenta" src="../img/iconos/icono-sobreNosotros.png" alt="">
            <a href="">Nombre Apellido</a>
        </div>
    </header>

    <form action="ingresoPaquete.php" id="form-paquete" method="post">

        <div class="div-datos-paq">
            <legend>Ingreso de Paquete</legend>
            <select name="select-remitente-paq" id="select-remitente-paq">
                <option value="Remitente" selected>Remitente</option>
                <option value="CRECOM">CRECOM</option>
                <option value="DAC">DAC</option>
                <option value="DHL">DHL</option>
            </select>
            <p>Sobre el destino</p>
            <input type="text" name="nombre-destinatario-paq" id="nombre-destinatario-paq" class="destino-paq" placeholder="Nombre destinatario">
            <input type="email" name="mail-destinatario-paq" id="mail-destinatario-paq" class="destino-paq" placeholder="Correo destinatario">
            <input type="text" name="calle-destino-paq" id="calle-destino-paq" class="destino-paq" placeholder="Calle">
            <input type="text" name="puerta-destino-paq" id="puerta-destino-paq" class="destino-paq" placeholder="N° de puerta">
            <p>Características del paquete</p>
            <input type="number" name="peso-paq" id="peso-paq" class="destino-paq" placeholder="Peso (Kg)">
            <input type="number" name="volumen-paq" id="volumen-paq" class="destino-paq" placeholder="Volumen (cm∧3)">
        </div>

        <div class="div-datos-paq">
            <p id="p-fragil">Contenido frágil</p>
            <div id="div-radios">
                <label for="radio-paq-si">Sí</label>
                <input type="radio" name="contenido-fragil" id="radio-paq-si" value="true">
                <label for="radio-paq-no">No</label>
                <input type="radio" name="contenido-fragil" id="radio-paq-no" value="false">
                <select name="select-fragil-paq" id="select-fragil-paq">
                    <option value="" selected disabled>Contenido frágil</option>
                    <option value="Líquido">Líquido</option>
                    <option value="Vidrio">Vidrio</option>
                </select>
                <p>Detalles</p>
                <textarea name="detalles-paq" id="detalles-paq" cols="30" rows="8" maxlength="150" placeholder="Detalles adicionales (opcional)" form="form-paquete"></textarea>
                <p>Categoría del paquete</p>
                <select name="select-categoria-paq" id="select-categoria-paq">
                    <option value="" selected disabled>Categoría</option>
                    <option value="Líquido">Comida</option>
                    <option value="Vidrio">Limpieza</option>
                <input type="submit" id="submit-paquete" value="Ingresar paquete">
            </div>
        </div>

    </form>

</body>
</html>

<?php

if($_POST){
    $remitente = $_POST["select-remitente-paq"];
    $nombre_destinatario = $_POST["nombre-destinatario-paq"];
    $correo_destinatario = $_POST["mail-destinatario-paq"];
    $calle_destino = $_POST["calle-destino-paq"];
    $num_puerta_destino = $_POST["puerta-destino-paq"];
    $peso = $_POST["peso-paq"];
    $volumen = $_POST["volumen-paq"];
    $fragil = $_POST["contenido-fragil"];
    $contenido_fragil = $_POST["select-fragil-paq"];
    $detalles = $_POST["detalles-paq"];

    $conexion = new mysqli("127.0.0.1","root","","bdprueba");
    $instruccion = "insert into paquete(remitente, nom_destinatario, correo_destinatario, calle_destino, num_puerta_destino, peso, volumen, fragil, contenido_fragil, detalles) value ('$remitente', '$nombre_destinatario', '$correo_destinatario', '$calle_destino', '$num_puerta_destino', $peso, $volumen, $fragil, '$contenido_fragil', '$detalles')";
    $conexion->query($instruccion);
}

?>