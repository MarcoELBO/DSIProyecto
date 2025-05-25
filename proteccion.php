<?php
// funciones_jwt.php (o el nombre que le des a este archivo)
require_once 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException; // Añadida para un manejo más específico de errores

// Define tu clave secreta de forma global o pásala como parámetro.
// ¡DEBE SER MUY FUERTE Y NO HARDCODEARSE EN PRODUCCIÓN!
// Lee de una variable de entorno: getenv('JWT_SECRET_KEY')
// O de un archivo de configuración seguro.
const JWT_SECRET_KEY = 'TU_CLAVE_SECRETA_MUY_FUERTE_Y_ALEATORIA_AQUI'; // ¡CAMBIA ESTO!

/**
 * Genera un JSON Web Token (JWT).
 *
 * @param string $tipo El rol o tipo de usuario (ej. 'admin', 'conductor').
 * @param mixed $identificador El ID único del usuario (ej. CURP, ID_Oficial).
 * @return string|null El JWT generado si es exitoso, o null en caso de error.
 */
function generador_token($tipo, $identificador): ?string
{
    $issuer = "tu_dominio.com";
    $audience = "tus_aplicaciones";
    $issuedAt = time();
    $expire = $issuedAt + 3600; // Token expira en 1 hora

    $payload = [
        'iss' => $issuer,
        'aud' => $audience,
        'iat' => $issuedAt,
        'exp' => $expire,
        'data' => [ // Datos específicos del usuario
            'userId' => $identificador,
            'userRole' => $tipo
        ]
    ];

    try {
        $jwt = JWT::encode($payload, JWT_SECRET_KEY, 'HS256');
        return $jwt;
    } catch (Exception $e) {
        // En un entorno de producción, loguea este error (no lo muestres al usuario)
        error_log("Error al generar el token: " . $e->getMessage());
        return null;
    }
}

/**
 * Envía una respuesta de error de no autorizado y termina la ejecución.
 * Puede enviar JSON o HTML dependiendo del tipo de solicitud esperada.
 *
 * @param string $message El mensaje de error.
 * @param bool $isHtmlRequest Si true, envía una respuesta HTML; de lo contrario, JSON.
 */
function sendUnauthorizedResponse(string $message, bool $isHtmlRequest = false): void
{
    http_response_code(401); // 401 Unauthorized

    if ($isHtmlRequest) {
        // Elimina la cookie de autenticación si el token es inválido/expirado
        setcookie(
            'auth_token',
            '',
            [
                'expires' => time() - 3600, // Hace que la cookie expire inmediatamente
                'path' => '/',
                'domain' => '', // Déjalo vacío o usa tu_dominio.com
                'secure' => true, // Siempre true en producción con HTTPS
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );

        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Acceso Denegado</title>
            <link rel="stylesheet" href="styles.css"> <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    margin: 0;
                    background-color: var(--background-light, #f0f2f5);
                    font-family: Arial, sans-serif;
                }
                .message {
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    max-width: 400px;
                    width: 90%;
                    background-color: var(--background-white, #ffffff);
                }
                .message--error {
                    background-color: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                }
                .message h2 {
                    margin-top: 0;
                    color: inherit;
                }
                .message p {
                    margin-bottom: 20px;
                }
                .form__button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }
                .form__button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="message message--error">
                <h2>Acceso Denegado</h2>
                <p>' . htmlspecialchars($message) . '</p>
                <a href="/final/index.html" class="form__button">Ir al Login</a>
            </div>
        </body>
        </html>';
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => $message]);
    }
    exit();
}


/**
 * Valida un token JWT obtenido de las cookies.
 * Si el token es inválido o no se encuentra, detiene la ejecución del script
 * y envía una respuesta de error.
 *
 * @param bool $isHtmlRequest Indica si la respuesta de error debe ser HTML.
 * @return object El payload decodificado del JWT si la validación es exitosa.
 */
function validar_token($tipo_usuario, bool $isHtmlRequest = false): object
{
    // 1. Obtener el token de la cookie 'auth_token'
    $jwt = $_COOKIE['auth_token'] ?? '';

    if (empty($jwt)) {
        sendUnauthorizedResponse('Token de autenticación no proporcionado en las cookies. Por favor, inicia sesión.', $isHtmlRequest);
    }

    // 2. Validar y decodificar el token
    try {
        // Para JWT v6.x+, Key es requerido
        $decoded = JWT::decode($jwt, new Key(JWT_SECRET_KEY, 'HS256'));
        if(!($decoded->data->userRole == $tipo_usuario)){
            sendUnauthorizedResponse('No tienes permiso para acceder a esta sección.', $isHtmlRequest);
        }
        return $decoded; // Retorna el payload decodificado
    } catch (ExpiredException $e) {
        sendUnauthorizedResponse('Tu sesión ha expirado. Por favor, inicia sesión de nuevo.', $isHtmlRequest);
    } catch (SignatureInvalidException $e) {
        sendUnauthorizedResponse('Firma de token inválida. Acceso no autorizado.', $isHtmlRequest);
    } catch (BeforeValidException $e) {
        sendUnauthorizedResponse('Token aún no válido. Intenta de nuevo.', $isHtmlRequest);
    } catch (Exception $e) {
        // Para cualquier otra excepción genérica en la validación
        sendUnauthorizedResponse('Token inválido: ' . $e->getMessage(), $isHtmlRequest);
    }
}

// Nota importante: Las constantes como JWT_SECRET_KEY NO deben estar hardcodeadas así en producción.
// Deben cargarse desde variables de entorno o un sistema de gestión de secretos.
?>