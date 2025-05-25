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
    // Usando $_REQUEST para compatibilidad con GET/POST, como en tu original.
    // Asegúrate de que tu formulario HTML envíe TODOS estos campos.
    $Placa = $_REQUEST['Placa'];
    $Marca = $_REQUEST['Marca'];
    $SUBMARCA = $_REQUEST['Submarca']; // Añadido según la estructura de la tabla
    $LINEA = $_REQUEST['Linea'];       // Añadido según la estructura de la tabla
    $Color = $_REQUEST['Color'];
    $Modelo = $_REQUEST['Modelo'];
    $Numero_Serie = $_REQUEST['Numeroserie']; // Añadido según la estructura de la tabla
    $Puertas = $_REQUEST['Puertas'];
    $Asientos = $_REQUEST['Asientos'];
    $Cilindraje = $_REQUEST['Cilindraje'];
    $Combustible = $_REQUEST['Combustible'];
    $capacidad = $_REQUEST['capacidad'];     // Añadido según la estructura de la tabla
    $TRASMISION = $_REQUEST['transmision'];   // Añadido según la estructura de la tabla
    $ORIGEN = $_REQUEST['origen'];           // Añadido según la estructura de la tabla

    // Crear la instrucción SQL para un INSERT implícito.
    // Los valores deben estar en el mismo ORDEN EXACTO que las columnas en tu tabla 'vehiculos'.
    // NOTA: Esta construcción de la consulta es VULNERABLE a inyección SQL.
    // Para proyectos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "INSERT INTO vehiculos VALUES (
        '$Placa',
        '$Marca',
        '$SUBMARCA',
        '$LINEA',
        '$Color',
        '$Modelo',
        '$Numero_Serie',
        '$Puertas',
        '$Asientos',
        '$Cilindraje',
        '$Combustible',
        '$capacidad',
        '$TRASMISION',
        '$ORIGEN'
    )";

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
        echo json_encode(['status' => 'success', 'message' => 'Registro de vehículo guardado correctamente.']);
    } else {
        // Operación fallida por alguna razón
        // Incluye el mensaje de error de MySQL si está disponible para depuración
        $errorMessage = "Error al guardar el registro del vehículo";
        if (isset($Conexion->error) && $Conexion->error) {
            $errorMessage .= ": " . $Conexion->error;
        }
        http_response_code(400); // 400 Bad Request para indicar un problema con los datos o la operación
        echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    }

} catch (Exception $e) {
    // Captura cualquier excepción que pueda ocurrir (ej. error en la conexión, error de PHP, etc.)
    http_response_code(500); // 500 Internal Server Error para problemas del servidor
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al guardar el vehículo: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    // error_log("Error en IVehiculos.php: " . $e->getMessage() . " en línea " . $e->getLine());
}

// Finaliza el buffering de salida y envía la respuesta al cliente
ob_end_flush();
exit;
?>