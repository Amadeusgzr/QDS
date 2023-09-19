<?php

class paqueteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerPaquetes($id_paquete = null)
    {
        $where = ($id_paquete == null) ? "" : " WHERE id_paquete='$id_paquete'";
        $paquetes = [];
        $instruccion = "SELECT * FROM paquete" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        return $paquetes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles)
    {
            $instruccion = "INSERT INTO paquete (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles')";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Exito",
                'respuesta' => "Paquete guardado"
            ];
        return $resultado;
    }
    public function updatePackage($id, $name, $description)
    {
        $exist = $this->obtenerPaquetes($id);
        $result = ['Error', 'No existe el paquete con la ID ' . $id];
        if (count($exist) > 0) {
            $validate = $this->validatePackage($name, $description);
            $result = ['Error', 'Ya existe un paquete con esas mismas características'];
            if (count($validate) == 0) {
                $query = "UPDATE packages SET name='$name', description='$description' WHERE id='$id'";
                mysqli_query($this->db, $query);
                $result = ['Success', 'Paquete actualizado'];
            }
        }
        return $result;
    }

    public function deletePackage($id)
    {
        $validate = $this->obtenerPaquetes($id);
        $result = [
            'error' => "Error",
            'resultado' => "No existe el paquete con la ID " . $id];
        if (count($validate) > 0) {
            $query = "DELETE FROM packages WHERE id='$id'";
            mysqli_query($this->db, $query);
            $result = [
                'error' => "Success",
                'resultado' => "Paquete eliminado"
            ];
        }

        return $result;
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