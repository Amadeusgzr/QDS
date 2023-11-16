<?php

class manejaModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerManeja($id_maneja = null)
    {
        $maneja = [];
        $instruccion = "SELECT * FROM maneja INNER JOIN vehiculo ON maneja.id_vehiculo = vehiculo.id_vehiculo INNER JOIN camionero ON camionero.id_camionero = camionero.id_camionero";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($maneja, $row);
        }
        return $maneja;
    }
}
?>