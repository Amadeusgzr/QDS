<?php

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu'])) {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="vistas/img/logoRojo.png">
    <link href="https://fonts.googleapis.com/css2?family=Geologica&display=swap" rel="stylesheet">
    <title>QDS</title>
</head>

<body>

    <header id="header-ingresado">
        <div id="contenido-header">
            <div id="div-logo">
                <a href="index.php"><img src="vistas/img/logoBlanco.png" alt="Logo"></a>
            </div>
            <div class='div-der-header'>
                <?php if($_SESSION['tipo_usu'] == "admin"){ ?>
                    <div class='div-mensajes'>
                        <a href="vistas/Backoffice/ver-mensajes.php"><img src="vistas/img/iconos/escribiendo.png" alt="" class='img-mensajes'></a>
                        <script>
                        function hacerSolicitud() {
                            var xhr = new XMLHttpRequest();

                            xhr.open('GET', 'controladores/api/mensaje/obtenerCantidadMensaje.php', true);

                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var respuesta = xhr.responseText;
                                    document.getElementById('resultado').innerHTML = respuesta;
                                }
                            };

                            xhr.send();
                        }

                        hacerSolicitud();

                        setInterval(hacerSolicitud, 1000);
                        </script>
                        <div id="resultado">
                        </div>
                    </div>
                <?php } ?>
                <div id="div-cuenta">
                    <img id="img-cuenta" src="vistas/img/iconos/icono-usuario-blanco.png" alt="">
                    <p id="p-nombre">
                    <?= $_SESSION['nom_usu'] ?>
                    </p>
                </div>
            </div>
        </div>
    </header>