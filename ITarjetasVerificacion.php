<?php
// Iniciar el buffering de salida para asegurar que los encabezados HTTP se envíen correctamente

    include_once("proteccion.php");
    validar_token('A', true);
ob_start();

// Establecer el tipo de contenido de la respuesta a JSON.
// Esto es CRÍTICO para que JavaScript interprete la respuesta correctamente.
header('Content-Type: application/json');

try {
    // Obteniendo los valores del front end
    // CORREGIDO: Ahora usando $_POST para coincidir con la forma común de envío de formularios por AJAX
    $Folio_Verificacion = $_POST['Folio_Verificacion'];
    $Vehiculo = $_POST['Vehiculo'];
    $Domicilio = $_POST['Domicilio'];
    $TC = $_POST['TC'];
    $Centro_Verificacion = $_POST['Centro_Verificacion'];
    $TECNICO_VERIFICACION = $_POST['TECNICO_VERIFICACION'];
    $FECHA_EXPEDICION = $_POST['FECHA_EXPEDICION'];
    $HORA_ENTRADA = $_POST['HORA_ENTRADA'];
    $HORA_SALIDA = $_POST['HORA_SALIDA'];
    $MOTIVO_VERIFICACION = $_POST['MOTIVO_VERIFICACION'];
    $SEMESTRE = $_POST['SEMESTRE'];
    $FOLIO_PREVIO = $_POST['FOLIO_PREVIO'];
    $VIGENCIA = $_POST['VIGENCIA'];

    // Crear la instrucción SQL para un INSERT explícito.
    // NOTA: Esta construcción de la consulta es VULNERABLE a inyección SQL.
    // Para proyectos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "INSERT INTO tarjetas_verificacion  VALUES ('$Folio_Verificacion', '$Vehiculo', '$Domicilio', '$TC', '$Centro_Verificacion', '$TECNICO_VERIFICACION', '$FECHA_EXPEDICION', '$HORA_ENTRADA', '$HORA_SALIDA', '$MOTIVO_VERIFICACION', '$SEMESTRE', '$FOLIO_PREVIO', '$VIGENCIA')";

    // Incluir el controlador de la base de datos y establecer la conexión
    // Asegúrate de que el nombre del archivo 'Controlador.php' y las funciones
    // 'Conectar()', 'Ejecutar()', 'Desconectar()' coinciden con la capitalización real.
    include("Controlador.php");

    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // Ejecutar la instrucción SQL
    // Asumo que la función Ejecutar() devuelve 1 para éxito y 0/false para fallo.
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Desconectar la base de datos
    Desconectar($Conexion);

    // Procesa el resultado de la operación
    if ($ResultSet == 1) {
        // Operación exitosa: Envía código 200 OK
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Registro de tarjeta de verificación guardado correctamente.']);
    } else {
        // Operación fallida por alguna razón
        // Incluye el mensaje de error de MySQL si está disponible para depuración
        $errorMessage = "Error al guardar el registro de la tarjeta de verificación";
        if (isset($Conexion->error) && $Conexion->error) {
            $errorMessage .= ": " . $Conexion->error;
        }
        http_response_code(400); // 400 Bad Request para indicar un problema con los datos o la operación
        echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    }

} catch (Exception $e) {
    // Captura cualquier excepción que pueda ocurrir (ej. error en la conexión, error de PHP, etc.)
    http_response_code(500); // 500 Internal Server Error para problemas del servidor
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al guardar la tarjeta de verificación: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    // error_log("Error en ITarjetasVerificacion.php: " . $e->getMessage() . " en línea " . $e->getLine());
}

// Finaliza el buffering de salida y envía la respuesta al cliente
ob_end_flush();
exit;
?>