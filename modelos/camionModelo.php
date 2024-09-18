<?php

class camionModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerCamiones($id_camion = null)
    {
        $where = ($id_camion == null) ? "" : " WHERE id_camion='$id_camion'";
        $camiones = [];
        $instruccion = "SELECT * FROM camion INNER JOIN vehiculo ON camion.id_camion = vehiculo.id_vehiculo WHERE estado = 'Disponible' OR estado = 'En transcurso'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($camiones, $row);
        }
        return $camiones;
    }

    public function modificarEstado($id_camion)
    {

        $instruccion = "UPDATE vehiculo SET estado = 'En transcurso' WHERE id_vehiculo = '$id_camion'";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Recorrido iniciado"
        ];

        return $resultado;

            
        
    }
}
?>