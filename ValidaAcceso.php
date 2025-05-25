<?php
$Username = $_POST['Username'];
$Password = $_POST['Password'];

$SQL = "SELECT * FROM usuario WHERE Username = '$Username';";

include("Controlador.php");
include("proteccion.php");

$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $SQL);
$Fila = mysqli_fetch_row($ResultSet);
$N = mysqli_num_rows($ResultSet);


if ($N == 0) {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Usuario no existe']);
    exit();
} else {
    // Usuario existe
    
    if ($Fila[1] == $Password) {
        // Contraseña correcta
         $jwt = generador_token($Fila[2], $Fila[0]);
    setcookie(
            'auth_token',
            $jwt,
            [
                'expires' => time() + 3600, // Expira en 1 hora
                'path' => '/',
                'domain' => '', // Deja vacío para el dominio actual
                'secure' => true, // ¡Siempre true en producción con HTTPS!
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );

        // Redirigir al usuario a la página protegida
        
        $ResetIntentosSQL = "UPDATE usuario SET Intentos = 0 WHERE Username = '$Username';";
        Ejecutar($Conexion, $ResetIntentosSQL);
        Desconectar($Conexion);
        if ($Fila[2] == "A") {
           http_response_code(response_code: 200);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Usuario bloqueado por demasiados intentos fallidos']);
        } else {
           http_response_code(response_code: 201);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Usuario bloqueado por demasiados intentos fallidos']);
        }
        // Información adicional sobre estado del usuario (no se envía por HTTP, solo para debug)
        /*
        if ($Fila[3] == 1) {
            // Usuario activo
        } else {
            // Usuario inactivo
        }
        if ($Fila[4] == 0) {
            // No bloqueado
        } else {
            // Bloqueado
        }
        */
    } else {
        // Contraseña incorrecta
        $Intentos = $Fila[5] + 1;
        if ($Intentos >= 3) {
            $BloquearSQL = "UPDATE usuario SET Intentos = $Intentos, Bloqueo = 1 WHERE Username = '$Username';";
            Ejecutar($Conexion, $BloquearSQL);
            http_response_code(response_code: 403);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Usuario bloqueado por demasiados intentos fallidos']);
            Desconectar($Conexion);
            exit();
        } else {
            $ActualizarIntentosSQL = "UPDATE usuario SET Intentos = $Intentos WHERE Username = '$Username';";
            Ejecutar($Conexion, $ActualizarIntentosSQL);
            http_response_code(response_code: 401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Contraseña incorrecta', 'intentos' => $Intentos]);
            Desconectar($Conexion);
            exit();
        }
    }
    
}
?>