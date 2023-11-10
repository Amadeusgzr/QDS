<?php

class loteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerLote($id_lote)
    {
        $lote = [];
        $instruccion = "SELECT * FROM lote WHERE id_lote='$id_lote'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lote, $row);
        }
        return $lote;
    }
    public function obtenerLotes($id_lote = null)
    {
        $where = ($id_lote == null) ? "" : " WHERE id_lote='$id_lote'";
        $lotes = [];
        $instruccion = "SELECT * FROM mostrar_lotes" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lotes, $row);
        }
        return $lotes;
    }


    public function guardarLote($fragil, $tipo, $detalles, $id_almacen_central)
    {
        $instruccion = "INSERT INTO lote (fragil,tipo,detalles) VALUES ('$fragil','$tipo','$detalles')";
        mysqli_query($this->db, $instruccion);

        $id_lote = mysqli_insert_id($this->db);

        $instruccion = "INSERT INTO almacena1 (id_lote,id_almacen_central) VALUES ('$id_lote','$id_almacen_central')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'id_lote' => "$id_lote",
            'error' => "Éxito",
            'respuesta' => "Lote guardado",
        ];
        return $resultado;
    }
    public function modificarLote($id_lote, $cant_paquetes, $peso, $volumen, $fragil)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "UPDATE lote SET cant_paquetes='$cant_paquetes', peso='$peso', volumen='$volumen', fragil='$fragil' WHERE id_lote='$id_lote'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Lote modificado"
            ];
        }
        return $resultado;
    }

    public function  modificarEstadoLote($id_lote)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "SELECT estado FROM lote WHERE id_lote='$id_lote'";
            $resultado = mysqli_query($this->db, $instruccion);
            $fila =  mysqli_fetch_assoc($resultado);
            $estado = $fila["estado"];
            if ($estado == "En almacén central (camión)" || $estado == "Entregado"){
                if ($estado == "En almacén central (camión)"){
                    $instruccion = "UPDATE lote SET estado='Entregado' WHERE id_lote = '$id_lote'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete entregado"
                    ];     
                } else {
                    $instruccion = "UPDATE lote SET estado='En almacén central (camión)' WHERE id_lote = '$id_lote'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete desentregado"
                    ];          
                }
            } else {
                $resultado = [
                    'error' => "Error",
                    'respuesta' => "No tienes permisos para hacer esto"
                ]; 
            }
        }
        return $resultado;
    }

    public function eliminarLote($id_lote)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "DELETE FROM lote WHERE id_lote='$id_lote'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Lote eliminado"
            ];
        }

        return $resultado;
    }



}
?>