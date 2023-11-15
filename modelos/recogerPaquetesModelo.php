<?php

class recogerPaquetesModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerRecogerPaquete($id_camioneta)
    {
        $almacenes_cliente = [];
        $instruccion = "SELECT *, recoge.fecha_recogida_ideal AS fecha_recogida_ideal1 FROM recoge JOIN ( SELECT * FROM recoge WHERE recoge.fecha_recogida IS NULL OR recoge.fecha_vuelta IS NULL AND recoge.id_camioneta = '$id_camioneta' ORDER BY ABS(TIMESTAMPDIFF(SECOND, fecha_salida, NOW())) ASC LIMIT 1 ) closest ON recoge.id_camioneta = closest.id_camioneta AND recoge.fecha_salida = closest.fecha_salida INNER JOIN almacen_cliente ON recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacenes_cliente, $row);
        }
        return $almacenes_cliente;
    }

    public function modificarFecha($id_camioneta, $fecha_salida)
    {
        date_default_timezone_set('America/Montevideo');

        $fecha_vuelta = time();
    
        $fecha_vuelta = date('Y-m-d H:i:s', $fecha_vuelta);

        $instruccion = "UPDATE recoge SET fecha_vuelta = '$fecha_vuelta' WHERE fecha_salida = '$fecha_salida' AND id_camioneta = '$id_camioneta'";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Recorrido finalizado"
        ];

        return $resultado;

            
        
    }
}