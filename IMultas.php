<?php
// Iniciar el buffering de salida para asegurar que los encabezados HTTP se envíen correctamente
ob_start();

// Establecer el tipo de contenido de la respuesta a JSON.
// Esto es CRÍTICO para que JavaScript interprete la respuesta correctamente.
header('Content-Type: application/json');

try {
    // Obteniendo los valores del front end
    // Usando $_REQUEST para compatibilidad con GET/POST, como en tu original
    $Folio = $_REQUEST['Folio'];
    $Fecha = $_REQUEST['Fecha'];
    $Hora = $_REQUEST['Hora'];
    $Motivo = $_REQUEST['Motivo'];
    $Licencia = $_REQUEST['Licencia'];
    $T_Verificacion = $_REQUEST['T_Verificacion'];
    $T_Circulacion = $_REQUEST['T_Circulacion'];
    $Policia = $_REQUEST['Policia'];
    $observaciones = $_REQUEST['Observaciones'];
    $Lugar = $_REQUEST['Lugar'];


    // Crear la instrucción SQL para un INSERT explícito.
    // NOTA: Esta construcción de la consulta es VULNERABLE a inyección SQL.
    // Para proyectos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "INSERT INTO multas (Folio, Fecha, Hora, Motivo, Licencia, T_Verificacion, T_Circulacion, Policia, Observaciones, Lugar) VALUES ('$Folio', '$Fecha', '$Hora', '$Motivo', '$Licencia', '$T_Verificacion', '$T_Circulacion', '$Policia', '$observaciones', '$Lugar')";

    // Incluir el controlador de la base de datos y establecer la conexión
    include("Controlador.php");
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // Ejecutar la instrucción SQL
    // Asumo que la función ejecutar() devuelve 1 para éxito y 0/false para fallo.
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Desconectar la base de datos
    Desconectar($Conexion);

    // Procesa el resultado de la operación
    if ($ResultSet == 1) {
        // Operación exitosa: Envía código 200 OK
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Registro de multa guardado correctamente.']);
    } else {
        // Operación fallida por alguna razón
        // Incluye el mensaje de error de MySQL si está disponible para depuración
        $errorMessage = "Error al guardar el registro de la multa";
        if ($Conexion->error) {
            $errorMessage .= ": " . $Conexion->error;
        }
        http_response_code(400); // 400 Bad Request para indicar un problema con los datos o la operación
        echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    }

} catch (Exception $e) {
    // Captura cualquier excepción que pueda ocurrir (ej. error en la conexión, error de PHP, etc.)
    http_response_code(500); // 500 Internal Server Error para problemas del servidor
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al guardar la multa: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    // error_log("Error en IMultas.php: " . $e->getMessage() . " en línea " . $e->getLine());
}

// Finaliza el buffering de salida y envía la respuesta al cliente
ob_end_flush();
exit;
?>