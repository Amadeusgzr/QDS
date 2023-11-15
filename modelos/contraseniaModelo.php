<?php

class contraseniaModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function modificarContrasenia($contrasenia_actual, $contrasenia_cambiar, $contrasenia_repetir, $usuario)
    {

        $instruccion = "SELECT * FROM login WHERE nom_usu='$usuario'";
        $resultado = mysqli_query($this->db, $instruccion);
        $fila = mysqli_fetch_assoc($resultado);

        $contrasenia_real = $fila["contrasenia"];
        
        $contrasenia_actual1 = hash ('sha256', $contrasenia_actual);
	 if (!isset($contrasenia_actual) || is_null($contrasenia_actual) || empty(trim($contrasenia_actual)) || !isset($contrasenia_cambiar) || is_null($contrasenia_cambiar) || empty(trim($contrasenia_cambiar)) || !isset($contrasenia_repetir) || is_null($contrasenia_repetir) || empty(trim($contrasenia_repetir))){        
        $resultado = [
                    'error' => "Error",
                    'respuesta' => "Campos sin completar"
                ];   
    } else {
        if ($contrasenia_actual1 == $contrasenia_real) {
            if ($contrasenia_cambiar == $contrasenia_repetir){
                if (hash('sha256', $contrasenia_cambiar) !== $contrasenia_actual1) {
                    if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/', $contrasenia_repetir)) {
                        $resultado = [
                            'error' => "Éxito",
                            'respuesta' => "Inicia sesión con tu contraseña nueva"
                        ];                    
                        $contrasenia_repetir = password_hash($contrasenia_repetir, PASSWORD_DEFAULT);
                        $instruccion =  "UPDATE login SET contrasenia='$contrasenia_repetir' WHERE nom_usu='$usuario'";
                        mysqli_query($this->db, $instruccion);
                    } else {
                        $resultado = [
                            'error' => "Error",
                            'respuesta' => "Formato incorrecto"
                        ];    
                    }
                } else {
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "La contraseña a cambiar es la misma que la actual"
                    ];   
                }
            } else {                        
                $resultado = [
                    'error' => "Error",
                    'respuesta' => "Las contraseñas no coinciden"
                ];    
            }
        } else {
            if (password_verify($contrasenia_actual, $contrasenia_real)) {
                if ($contrasenia_cambiar == $contrasenia_repetir) {
                    if (!password_verify($contrasenia_cambiar, $contrasenia_real)) {
                        if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/', $contrasenia_repetir)) {
    
                            $resultado = [
                                'error' => "Éxito",
                                'respuesta' => "Inicia sesión con tu contraseña nueva"
                            ];                    
                            $contrasenia_repetir = password_hash($contrasenia_repetir, PASSWORD_DEFAULT);
                            $instruccion =  "UPDATE login SET contrasenia='$contrasenia_repetir' WHERE nom_usu='$usuario'";
                            mysqli_query($this->db, $instruccion);
                        } else {
                            $resultado = [
                                'error' => "Error",
                                'respuesta' => "Formato incorrecto"
                            ];    
                        }
                    } else {
                        $resultado = [
                            'error' => "Error",
                            'respuesta' => "La contraseña a cambiar es la misma que la actual"
                        ];   
                    }
                } else {                        
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "Las contraseñas no coinciden"
                    ];    
                }
            } else {
                $resultado = [
                    'error' => "Error",
                    'respuesta' => "Contraseña incorrecta"
                ];    
            }
        }
                
    }   
        return $resultado;
    }
}