<?php

class paqueteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerPaquete($id_paquete){
        $paquete = [];
        $instruccion = "SELECT * FROM paquete WHERE id_paquete='$id_paquete'" ;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
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

    public function eliminarPaquete($id_paquete)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete];
        if (count($validar) > 0) {
            $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete eliminado"
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