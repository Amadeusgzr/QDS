<?php

class camionModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerCamiones($id_camion = null)
    {
        $where = ($id_camion == null) ? "" : " WHERE id_camion='$id_camion'";
        $camiones = [];
        $instruccion = "SELECT * FROM camion" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($camiones, $row);
        }
        return $camiones;
    }
}
?>