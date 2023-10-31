<?php

class camionetaModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerCamionetas($id_camioneta = null)
    {
        $where = ($id_camioneta == null) ? "" : " WHERE id_camioneta='$id_camioneta'";
        $camionetas = [];
        $instruccion = "SELECT * FROM camioneta INNER JOIN vehiculo ON camioneta.id_camioneta = vehiculo.id_vehiculo" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($camionetas, $row);
        }
        return $camionetas;
    }
}
?>