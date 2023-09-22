<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'ruta/a/PHPMailer/src/PHPMailer.php';
require 'ruta/a/PHPMailer/src/SMTP.php';
require 'ruta/a/PHPMailer/src/Exception.php';

try {
    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    // Configurar el servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'datavisionuy@gmail.com'; // Reemplaza con tu correo Gmail
    $mail->Password   = 'DVeul000'; // Reemplaza con tu contraseña de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cambia a 'ssl' si prefieres SSL
    $mail->Port       = 465; // Cambia a 465 si prefieres SSL

    // Configurar remitente y destinatario
    $mail->setFrom('datavisionuy@gmail.com', 'Data Vision');
    $mail->addAddress('gastongolero@gmail.com', 'Gaston');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = 'Este es el cuerpo del correo.';

    // Enviar el correo
    $mail->send();
    echo 'El correo se ha enviado correctamente.';
} catch (Exception $e) {
    echo 'Hubo un error al enviar el correo: ', $e->getMessage();
}
?>
