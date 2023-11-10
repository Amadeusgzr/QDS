<?php

class solicitudModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerSolicitud($id_camioneta, $id_almacen_cliente, $fecha_recogida_ideal, $hora_recogida_ideal, $usuario)
    {
        $solicitud = [];
        $instruccion = "SELECT * FROM solicitud WHERE id_almacen_cliente = $id_almacen_cliente AND usuario = '$usuario' AND fecha_recogida_ideal = '$fecha_recogida_ideal' AND hora_recogida_ideal = '$hora_recogida_ideal'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($solicitud, $row);
        }
        return $solicitud;
    }
}