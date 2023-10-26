<?php
header("Location: ../vistas/permisos.php");

class paqueteModelo
{

    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerPaquetePorCodigo($codigo)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete WHERE codigo_seguimiento='$codigo'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
    }
    public function obtenerPaquete($id_paquete)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
        $resultado = mysqli_query($this->db, $instruccion);    
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        if(count($paquete) < 1){
            $paquete = [
                'error' => "Éxito",
                'respuesta' => "Paquete guardado"
            ];
        }
         return $paquete;
        

       
    }
    public function obtenerPaquetePorEmpresa($empresa)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE nombre_de_empresa = '$empresa'";
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
        $instruccion = "SELECT * FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        return $paquetes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles, $codigo, $id_almacen_cliente, $id_destino)
    {


        $instruccion = "INSERT INTO paquete (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles,codigo_seguimiento,id_destino) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles','$codigo','$id_destino')";
        mysqli_query($this->db, $instruccion);

        $id_paquete = mysqli_insert_id($this->db);

        $instruccion = "INSERT INTO almacena (id_almacen_cliente,id_paquete) VALUES ('$id_almacen_cliente','$id_paquete')";
        mysqli_query($this->db, $instruccion);
        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete guardado"
        ];
        return $resultado;


    }
    public function modificarPaquete($id_paquete, $direccion, $peso, $volumen, $fragil, $estado, $empresa, $tipo_usu)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            if ($tipo_usu !== "empresa"){
            $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil', estado='$estado' WHERE id_paquete='$id_paquete'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete modificado"
            ];
            } else {
                $instruccion = "SELECT empresa_cliente.nombre_de_empresa, paquete.estado FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila =  mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["nombre_de_empresa"];
                $estado = $fila["estado"];
                if ($estado == "En almacén cliente"){
                    if ($empresa == $empresa1){
                    $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil' WHERE id_paquete='$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete modificado"
                    ];
                    } else {
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "Este paquete no es de tu pertenencia"
                    ];
                    }
                } else{
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "No tienes permiso para hacer esto"
                    ];
                }

 
            }

        }
        return $resultado;
    }

    public function modificarEstadoPaquete($id_paquete)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            $instruccion = "SELECT estado FROM paquete WHERE id_paquete='$id_paquete'";
            $resultado = mysqli_query($this->db, $instruccion);
            $fila =  mysqli_fetch_assoc($resultado);
            $estado = $fila["estado"];
            if ($estado == "En almacén cliente" || $estado == "En camión (central)"){
                if ($estado == "En almacén cliente"){
                    $instruccion = "UPDATE paquete SET estado='En camión (central)' WHERE id_paquete = '$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete recogido"
                    ];     
                } else {
                    $instruccion = "UPDATE paquete SET estado='En almacén cliente' WHERE id_paquete = '$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete desrecogido"
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
    public function eliminarPaquete($id_paquete, $empresa, $tipo_usu)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            if ($tipo_usu !== "empresa"){
                $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
                mysqli_query($this->db, $instruccion);
                $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete eliminado"
            ];
            } else {
                $instruccion = "SELECT empresa_cliente.nombre_de_empresa, paquete.estado FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila = mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["nombre_de_empresa"];
                $estado = $fila["estado"];
                if ($estado == "En almacén cliente"){
                    if ($empresa == $empresa1){
                        $instruccion = "DELETE FROM almacena WHERE id_paquete='$id_paquete'";
                        mysqli_query($this->db, $instruccion);

                        $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
                        mysqli_query($this->db, $instruccion);
                        $resultado = [
                            'error' => "Éxito",
                            'respuesta' => "Paquete eliminado"
                        ];
                    } else {
                        $resultado = [
                            'error' => "Error",
                            'respuesta' => "Este paquete no es de tu pertenencia"
                        ];
                    }
                } else{
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "No tienes permiso para hacer esto"
                    ];
                }  
                    
 
            }

        }

        return $resultado;
    }



}
?>