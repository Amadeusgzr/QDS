<?php

class recogerPaquetesModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerRecogerPaquete($id_camioneta)
    {
        $almacenes_cliente = [];
        $instruccion = "SELECT *, recoge.fecha_recogida_ideal AS fecha_recogida_ideal1, recoge.hora_recogida_ideal AS hora_recogida_ideal1 FROM recoge JOIN ( SELECT * FROM recoge WHERE recoge.fecha_recogida IS NULL AND recoge.hora_recogida IS NULL AND recoge.id_camioneta = '$id_camioneta' ORDER BY ABS(TIMESTAMPDIFF(SECOND, CONCAT(fecha_salida, ' ', hora_salida), NOW())) ASC LIMIT 1 ) closest ON recoge.id_camioneta = closest.id_camioneta AND recoge.fecha_salida = closest.fecha_salida AND recoge.hora_salida = closest.hora_salida INNER JOIN almacen_cliente ON recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacenes_cliente, $row);
        }
        return $almacenes_cliente;
    }
}