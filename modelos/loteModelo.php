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
        $instruccion = "SELECT * FROM lote" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lotes, $row);
        }
        return $lotes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles)
    {
        $instruccion = "INSERT INTO lote (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles')";
        mysqli_query($this->db, $instruccion);
        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete guardado"
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

    public function validatePackage($name, $description)
    {
        $packages = [];
        $query = "SELECT * FROM packages WHERE name='$name' AND description='$description'";
        $result = mysqli_query($this->db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($packages, $row);
        }
        return $packages;
    }



}
?>