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
    // Asegúrate de que el orden de estas variables POST coincida con el orden de las columnas en tu tabla 'conductores'
    // en la base de datos para un INSERT implícito.
    $curp = $_POST['CURP'];
    $nombre = $_POST['Nombre'];
    $domicilio = $_POST['Domicilio'];
    $folio_tc =  1; //esta dato no importa pero para no modificar la base de datos se deja como 1;
    $no_licencia = '1'; //esta dato no importa pero para no modificar la base de datos se deja como 1
    $fecha_nacimiento = $_POST['FechaNacimiento'];
    $tipo_sangre = $_POST['TipoSangre'];
    $donador_org = $_POST['DonadorOrg'];
    $numero_emergencia = $_POST['NumeroEmergencia'];

    // Crear la instrucción SQL para un INSERT implícito.
    // Los valores deben estar en el mismo orden que las columnas en la tabla 'conductores'.
    // NOTA: Esta construcción de la consulta es VULNERABLE a inyección SQL.
    // Para proyectos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "INSERT INTO conductores VALUES (
        '$curp',
        '$nombre',
        '$domicilio',
        '$folio_tc',
        '$no_licencia',
        '$fecha_nacimiento',
        '$tipo_sangre',
        '$donador_org',
        '$numero_emergencia'
    )";

    // Incluir el controlador de la base de datos y establecer la conexión
    include("Controlador.php");
    $Conexion = Conectar();

    // Ejecutar la instrucción SQL
    // Si la función ejecutar() devuelve 1 para éxito y 0/false para fallo,
    // tu lógica original de if ($ResultSet == 1) funcionará.
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Desconectar la base de datos
    Desconectar($Conexion);

    // Procesa el resultado de la operación
    if ($ResultSet == 1) {
        // Operación exitosa: Envía código 200 OK
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Registro guardado correctamente.']);
    } else {
        // Operación fallida por alguna razón (ej. restricción de BD, datos inválidos a nivel DB)
        http_response_code(400); // 400 Bad Request para indicar un problema con los datos o la operación
        echo json_encode(['status' => 'error', 'message' => 'Datos incorrectos o problema al guardar el registro.']);
    }

} catch (Exception $e) {
    // Captura cualquier excepción que pueda ocurrir (ej. error en la conexión, error de PHP, etc.)
    http_response_code(500); // 500 Internal Server Error para problemas del servidor
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    // error_log("Error en IConductores.php: " . $e->getMessage() . " en línea " . $e->getLine());
}

// Finaliza el buffering de salida y envía la respuesta al cliente
ob_end_flush();
exit;
?>