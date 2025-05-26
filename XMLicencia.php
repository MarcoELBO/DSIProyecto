<?php
// Iniciar el buffering de salida para controlar los encabezados HTTP.
ob_start();

// --- 1. Inclusión de la librería de protección y validación del token ---
// Asegúrate de que 'proteccion.php' contiene las funciones generador_token y validar_token
// adaptadas para usar cookies, como lo preparamos anteriormente.
include_once("proteccion.php");
    validar_token('T', true);


// --- 2. Configuración de la Carpeta de Destino para XML ---
const XML_STORAGE_DIR = 'xml_files/'; // Ruta relativa donde se almacenarán los XML

// --- 3. Obtención y Validación de Parámetros ---
$id_licencia = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de la licencia no se proporciona o está vacío, es un error del cliente.
if (empty($id_licencia)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de licencia no proporcionado.']);
    ob_end_clean(); // Limpia el búfer y no envía nada antes del JSON
    exit; // Termina la ejecución del script
}

// --- 4. Conexión a la Base de Datos ---
include("Controlador.php"); // Asegúrate de que este archivo y sus funciones son correctos.

$Conexion = null;
$ResultSetLicencias = null;
$ResultSetConductores = null;

try {
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 5. Creación del Objeto DOMDocument para XML ---
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->formatOutput = true; // Formato legible para el XML

    $root = $xml->createElement("DatosVehiculares"); // Un nodo raíz más genérico
    $xml->appendChild($root);

    // --- 6. Consulta y Añadir datos de Licencias ---
    // NOTA DE SEGURIDAD: Esta consulta sigue siendo VULNERABLE a inyección SQL.
    // EN PRODUCCIÓN, USA SIEMPRE SENTENCIAS PREPARADAS (mysqli_prepare, PDO).
    $SQL_Licencias = "SELECT * FROM licenciasconducir3 WHERE no_licencia = '$id_licencia'";
    $ResultSetLicencias = Ejecutar($Conexion, $SQL_Licencias);

    if (!$ResultSetLicencias) {
        throw new Exception("Error en la consulta SQL para licencias: " . mysqli_error($Conexion));
    }

    if (mysqli_num_rows($ResultSetLicencias) === 0) {
        http_response_code(404); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Licencia no encontrada para el ID proporcionado.']);
        ob_end_clean();
        exit;
    }

    while ($fila = mysqli_fetch_assoc($ResultSetLicencias)) {
        $licenciaNode = $xml->createElement("Licencia");
        foreach ($fila as $clave => $valor) {
            $elemento = $xml->createElement($clave, htmlspecialchars($valor));
            $licenciaNode->appendChild($elemento);
        }
        $root->appendChild($licenciaNode);
    }
    mysqli_free_result($ResultSetLicencias); // Liberar el resultado

    // --- 7. Consulta y Añadir datos de Conductores (si conductordomicilio es una tabla relacionada) ---
    // NOTA DE SEGURIDAD: Asumiendo que conductordomicilio no necesita $id_licencia
    // Si necesita un join o WHERE basado en $id_licencia, modifícalo.
    $SQL_Conductores = "SELECT * FROM conductordomicilio";
    $ResultSetConductores = Ejecutar($Conexion, $SQL_Conductores);

    if (!$ResultSetConductores) {
        throw new Exception("Error en la consulta SQL para conductores: " . mysqli_error($Conexion));
    }

    while ($fila = mysqli_fetch_assoc($ResultSetConductores)) {
        $conductorNode = $xml->createElement("Conductor"); // Nodo más específico
        foreach ($fila as $clave => $valor) {
            $elemento = $xml->createElement($clave, htmlspecialchars($valor));
            $conductorNode->appendChild($elemento);
        }
        $root->appendChild($conductorNode);
    }
    mysqli_free_result($ResultSetConductores); // Liberar el resultado

    // --- 8. Verificar y Crear la Carpeta de Almacenamiento ---
    if (!is_dir(XML_STORAGE_DIR)) {
        if (!mkdir(XML_STORAGE_DIR, 0755, true)) { // 0755 permisos, true para recursivo
            throw new Exception("Error al crear la carpeta de almacenamiento de XML: " . XML_STORAGE_DIR);
        }
    }

    // --- 9. Generar Nombre de Archivo Único y Guardar el XML ---
    $uniqueFileName = 'licencia_' . $id_licencia . '_' . uniqid() . '.xml';
    $filePath = XML_STORAGE_DIR . $uniqueFileName;

    if (!$xml->save($filePath)) {
        throw new Exception("Error al guardar el archivo XML en: " . $filePath);
    }

    // --- 10. Respuesta Exitosa ---
    // Limpiar el búfer antes de enviar la respuesta JSON final.
    ob_end_clean();
    http_response_code(200); // 200 OK
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Archivo XML generado y almacenado correctamente.',
        'file_name' => $uniqueFileName,
        'file_path' => $filePath // Devuelve la ruta completa del archivo
    ]);

} catch (Exception $e) {
    // Si ocurre cualquier error, se captura aquí y se envía una respuesta de error JSON.
    ob_end_clean(); // Asegurarse de limpiar el búfer antes de enviar cualquier error.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el XML: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_licencia_xml.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>