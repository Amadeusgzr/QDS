<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../../controladores/funciones.php';
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="alta-usuario.php" method="post">
        <legend>Agregar Usuario</legend>
        <input type="text" placeholder="Usuario" class="txt-crud" name="nom_usu[]" required>
        <select name="tipo_usu[]" class="txt-crud">
            <option type="text" value="" class="txt-crud" name="tipo_usu[]" required>Tipos de usuario</option>
            <option type="text" value="camionero" class="txt-crud" name="tipo_usu[]" required>Camionero</option>
            <option type="text" value="almacenero" class="txt-crud" name="tipo_usu[]" required>Almacenero</option>
            <option type="text" value="empresa" class="txt-crud" name="tipo_usu[]" required>Empresa</option>
            <option type="text" value="admin" class="txt-crud" name="tipo_usu[]" required>Administrador</option>
        </select>
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail[]" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-usuarios.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php
if ($_POST) {
    $nom_usu = $_POST["nom_usu"];
    $tipo_usu = $_POST["tipo_usu"];
    $mails = $_POST["mail"];

    $numArrays = count($nom_usu);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('login', 'nom_usu', $nom_usu[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el usuario $nom_usu[$i]"
            ];
            break;
        }
        $respuesta = existencia('login', 'mail', $mails[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe un usuario con mail $mails[$i]"
            ];
            break;
        }

        if (!filter_var($mails[$i], FILTER_VALIDATE_EMAIL)) {
            $respuesta = [
                'error' => 'Error',
                'respuesta' => "La dirección de correo electrónico no es válida $mails[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($nom_usu);
        $respuesta1 = atributosVacio($tipo_usu);
        $respuesta2 = atributosVacio($mails);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Usuario guardado"
            ];

            $bytes = random_bytes(6); // 6 bytes (48 bits) para un código de 12 caracteres hexadecimales
            $codigo = bin2hex($bytes);

            $codigo_hasheado = password_hash($codigo, PASSWORD_DEFAULT);

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'qdservice.uy@gmail.com';
            $mail->Password = 'ggxvfmtelslnluko';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('qdservice.uy@gmail.com', 'Quick Distribution Service');
            $mail->addAddress($mails[$i]);

            $mail->AddEmbeddedImage('../../vistas/img/logo.jpg', 'emailimg', 'attachment', 'base64', 'image/jpg');

            $mail->isHTML(true);
            $mail->Subject = 'Quick Distribution Service';
            $mail->Body = '<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Remito de Quick Distribution Service</title>
                    </head>
                    <body>
                        <img src="cid:emailimg" alt="Logo de Quick Distribution Service">
                        <h1>Te damos la bienvenida a QDS</h1>
                        <p>Tu contraseña de acceso es: ' . $codigo . '</p>
                        <!-- Aquí puedes agregar más detalles sobre el paquete -->
                    </body>
                    </html>
                    ';
            $mail->send();
            $instruccion = "insert into login(nom_usu, tipo_usu, mail, contrasenia) value ('$nom_usu[$i]', '$tipo_usu[$i]', '$mails[$i]', '$codigo_hasheado')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-usuario.php?datos=' . urlencode($respuesta));
}

?>
<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>