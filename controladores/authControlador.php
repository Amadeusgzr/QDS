<?php
header('content-type: application/json; charset=utf-8');
require_once('../modelos/authModelo.php');

$authModelo = new authModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Recibe las credenciales del usuario (correo y contraseÃ±a) desde la solicitud POST
        $nom_usu = $_POST['nom_usu'];
        $contrasenia = $_POST['contrasenia'];
        // Verifica las credenciales en el modelo
        $usuario = $authModelo->getUserByUsername($nom_usu);
        if ($usuario !== null) {
            $contrasenia1 = hash('sha256', $contrasenia);
            if ($contrasenia1 == $usuario['contrasenia']){
                    session_start();
                    // Almacena informaciÃ³n del usuario en la sesiÃ³n
                    $_SESSION['nom_usu'] = $usuario['nom_usu'];
                    $_SESSION['tipo_usu'] = $usuario['tipo_usu'];

                    if($_SESSION['tipo_usu'] == 'empresa'){
                        header("Location: ../vistas/Empresa/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'camionero'){
                        header("Location: ../vistas/Camionero/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'almacenero') {
                        header("Location: ../vistas/Almacenero/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'admin') {
                        header("Location: ../vistas/Backoffice/index.php");
                        exit();
                    } 
            } else {
                if (password_verify($contrasenia, $usuario['contrasenia'])) {
                    // Las credenciales son vÃ¡lidas, inicia una sesiÃ³n
                    session_start();
                    // Almacena informaciÃ³n del usuario en la sesiÃ³n
                    $_SESSION['nom_usu'] = $usuario['nom_usu'];
                    $_SESSION['tipo_usu'] = $usuario['tipo_usu'];

                    if($_SESSION['tipo_usu'] == 'empresa'){
                        header("Location: ../vistas/Empresa/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'camionero'){
                        header("Location: ../vistas/Camionero/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'almacenero') {
                        header("Location: ../vistas/Almacenero/index.php");
                        exit();
                    } else if ($_SESSION['tipo_usu'] == 'admin') {
                        header("Location: ../vistas/Backoffice/index.php");
                        exit();
                    }

                } else {
                    // Las credenciales son invÃ¡lidas, devuelve un mensaje de error
                    $response = [
                        'error' => "Error",
                        'respuesta' => "Credenciales Inválidas"
                    ];
                    $response = json_encode($response);
                    header('Location: ../vistas/login.php?datos=' . urlencode($response));
                    echo json_encode($response);
                }
            }

        } else {
            // Las credenciales son invÃ¡lidas, devuelve un mensaje de error
            $response = [
                'error' => "Error",
                'respuesta' => "Credenciales Inválidas"
            ];
            $response = json_encode($response);
            header('Location: ../vistas/login.php?datos=' . urlencode($response));
            echo json_encode($response);
        }
            break;
}

?>