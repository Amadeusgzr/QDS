<?php

class camionetaModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerCamionetas($id_camioneta = null)
    {
        $camionetas = [];
        $instruccion = "SELECT * FROM camioneta INNER JOIN vehiculo ON camioneta.id_camioneta = vehiculo.id_vehiculo WHERE estado = 'Disponible' OR estado = 'En transcurso'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($camionetas, $row);
        }
        return $camionetas;
    }
}
?>