<?php

class mensajeModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');


    }
    public function guardarMensaje($nombre_remitente, $mail_remitente, $mensaje, $fecha_mensaje)
    {   


        $instruccion= "INSERT INTO mensaje (nombre_remitente,mail_remitente,mensaje,fecha_mensaje,estado) VALUES ('$nombre_remitente','$mail_remitente','$mensaje','$fecha_mensaje','Sin responder')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Mensaje enviado"
        ];        
        return $resultado;
    }
}