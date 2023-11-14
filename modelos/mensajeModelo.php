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

    public function obtenerCantidadMensaje()
    {
        $mensajes = [];
        $instruccion = "SELECT * FROM mensaje WHERE estado = 'Sin responder'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($mensajes, $row);
        }
        $cantidad = count($mensajes);
        $respuesta = [
            "cantidad" => $cantidad
        ];
        return $respuesta;
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