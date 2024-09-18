<?php

class entregarLotesModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerRecogerPaquete($id_camion)
    {
        $plataformas = [];
        $instruccion = "SELECT *, lleva.fecha_entrega_ideal AS fecha_entrega_ideal1, vehiculo.estado AS estado_vehiculo FROM lleva JOIN ( SELECT * FROM lleva WHERE lleva.fecha_llegada IS NULL AND lleva.id_camion = '$id_camion' ORDER BY ABS(TIMESTAMPDIFF(SECOND, fecha_salida, NOW())) ASC LIMIT 1 ) closest ON lleva.id_camion = closest.id_camion AND lleva.fecha_salida = closest.fecha_salida INNER JOIN plataforma ON lleva.id_plataforma = plataforma.id_plataforma INNER JOIN destino ON plataforma.ubicacion = destino.id_destino INNER JOIN vehiculo ON vehiculo.id_vehiculo = lleva.id_camion";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($plataformas, $row);
        }
        return $plataformas;
    }

    public function modificarFecha($id_camion, $fecha_salida)
    {
        date_default_timezone_set('America/Montevideo');

        $fecha_llegada = time();
    
        $fecha_llegada = date('Y-m-d H:i:s', $fecha_llegada);

        $instruccion = "UPDATE lleva SET fecha_llegada = '$fecha_llegada' WHERE fecha_salida = '$fecha_salida' AND id_camion = '$id_camion'";
        mysqli_query($this->db, $instruccion);

        $instruccion = "UPDATE vehiculo SET estado = 'Disponible' WHERE id_vehiculo = '$id_camion'";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Recorrido finalizado"
        ];

        return $resultado;

            
        
    }
}