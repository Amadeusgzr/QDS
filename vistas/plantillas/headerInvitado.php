<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" href="img/logoRojo.png">
    <link href="https://fonts.googleapis.com/css2?family=Geologica&display=swap" rel="stylesheet">
    <title>QDS</title>
</head>

<body>

    <header id="header-no-ingresado">
        <div id="div-logo">
            <a href="../index.php"><img src="img/logoBlanco.png" alt="Logo"></a>
        </div>
        <nav>
            <a href="../index.php" class="aop1-index">Inicio</a>
            <a href="nuestroServicio.php" class="aop2-index">Nuestro Servicio</a>
            <a href="../index.php #footer-principal" class="aop3-index">Contacto</a>
        </nav>
        <div class="div-der-header-invitado">
            <div class="div-toggle-idioma">
                <input type="checkbox" name="" id="btn-idioma">
                <label for="btn-idioma" class="lbl-idioma"></label>
            </div>
            <a href="login.php">
                <input id="boton-login" type="button" value="Iniciar Sesión" class="boton-header">
            </a>
        </div>
    </header>

    <script src="js/idiomaLogin.js"></script>