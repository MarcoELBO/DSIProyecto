<?php
// Iniciar el buffering de salida para controlar los encabezados HTTP.
ob_start();

// --- 1. Inclusión de la librería de protección y validación del token ---
// Asegúrate de que 'proteccion.php' contiene las funciones generador_token y validar_token
// adaptadas para usar cookies.
include_once("proteccion.php");
validar_token('T', true);

// --- 2. Configuración de la Carpeta de Destino para XML ---
// Ruta relativa donde se almacenarán los XML. Asegúrate que esta ruta es accesible por el navegador.
const XML_STORAGE_DIR_MULTAS = 'xml_files/'; // Usamos un nombre de carpeta diferente para multas

// --- 3. Obtención y Validación de Parámetros ---
// Usamos $_POST para formularios enviados con POST. $_REQUEST también funciona pero es menos específico.
$id_multa = isset($_REQUEST["id"]) ? $_REQUEST["id"] : ''; 

// No se valida como "required" aquí si quieres que sea opcional para obtener todas las multas.
// Si $id_multa es vacío, se asume que se piden TODAS las multas.
// Si no es vacío, se filtra por ese ID.

// --- 4. Conexión a la Base de Datos ---
// Asegúrate de que 'Controlador.php' contenga las funciones Conectar(), Ejecutar(), Desconectar().
include("Controlador.php"); 

$Conexion = null;
$ResultSetMultas = null;

try {
    $Conexion = Conectar();

    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 5. Creación del Objeto DOMDocument para XML ---
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->formatOutput = true; 

    $root = $xml->createElement("Multas"); // El nodo raíz ahora es "Multas"
    $xml->appendChild($root);

    // --- 6. Preparación de la Consulta SQL ---
    // ¡¡¡ADVERTENCIA DE SEGURIDAD CRÍTICA!!!
    // Esta consulta es ALTAMENTE VULNERABLE a inyección SQL si $id_multa no es un número.
    // Para producción, DEBES USAR SENTENCIAS PREPARADAS (prepared statements).
    // Ejemplo con sentencias preparadas (asumiendo MySQLi):
    /*
    $SQL_Multas = "SELECT * FROM multas1";
    if (!empty($id_multa)) {
        $SQL_Multas .= " WHERE Folio = ?"; // Cambiado a 'Folio' según tu script
    }

    $stmt = mysqli_prepare($Conexion, $SQL_Multas);
    if ($stmt === false) {
        throw new Exception("Error al preparar la consulta: " . mysqli_error($Conexion));
    }

    if (!empty($id_multa)) {
        mysqli_stmt_bind_param($stmt, "s", $id_multa); // Usar "i" si $id_multa es INT
    }
    mysqli_stmt_execute($stmt);
    $ResultSetMultas = mysqli_stmt_get_result($stmt);
    */

    // Versión original (VULNERABLE) adaptada con filtro por 'Folio'
    $SQL_Multas = "SELECT * FROM multas1 WHERE folio='$id_multa';"; // Usamos WHERE 1=1 para facilitar la concatenación de condiciones
    $ResultSetMultas = Ejecutar($Conexion, $SQL_Multas);

    if (!$ResultSetMultas) {
        throw new Exception("Error en la consulta SQL para multas: " . mysqli_error($Conexion));
    }

    if (mysqli_num_rows($ResultSetMultas) === 0) {
        // Cambiado a 404 Not Found si no se encuentran multas (especialmente si se filtró por ID)
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron multas con el ID proporcionado o no hay multas registradas.']);
        ob_end_clean();
        exit;
    }

    while ($fila = mysqli_fetch_assoc($ResultSetMultas)) {
        $multaNode = $xml->createElement("Multa"); // Nodo para cada multa
        foreach ($fila as $clave => $valor) {
            // Reemplazar caracteres no válidos en nombres de nodos XML si es necesario
            // Se usa el regex para limpiar nombres de nodos XML, como en el ejemplo anterior.
            $valid_clave = preg_replace('/[^a-zA-Z0-9_]/', '', $clave);
            $elemento = $xml->createElement($valid_clave, htmlspecialchars($valor));
            $multaNode->appendChild($elemento);
        }
        $root->appendChild($multaNode);
    }
    mysqli_free_result($ResultSetMultas);

    // --- 7. Verificar y Crear la Carpeta de Almacenamiento ---
    if (!is_dir(XML_STORAGE_DIR_MULTAS)) {
        if (!mkdir(XML_STORAGE_DIR_MULTAS, 0755, true)) {
            throw new Exception("Error al crear la carpeta de almacenamiento de XML para multas: " . XML_STORAGE_DIR_MULTAS);
        }
    }

    // --- 8. Generar Nombre de Archivo Único y Guardar el XML ---
    $uniqueFileName = 'multas';
    if (!empty($id_multa)) {
        $uniqueFileName .= '_' . $id_multa;
    }
    $uniqueFileName .= '_' . uniqid() . '.xml';
    $filePath = XML_STORAGE_DIR_MULTAS . $uniqueFileName;

    if (!$xml->save($filePath)) {
        throw new Exception("Error al guardar el archivo XML de multas en: " . $filePath);
    }

    // --- 9. Respuesta Exitosa ---
    ob_end_clean(); // Limpia el búfer antes de enviar la respuesta JSON final.
    http_response_code(200); // 200 OK
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Archivo XML de multas generado y almacenado correctamente.',
        'file_name' => $uniqueFileName,
        // Devuelve la ruta completa y accesible para el navegador
        // Asegúrate que XML_STORAGE_DIR_MULTAS es una ruta pública desde la raíz de tu dominio
        'file_path' => XML_STORAGE_DIR_MULTAS . $uniqueFileName 
    ]);

} catch (Exception $e) {
    ob_end_clean(); // Asegurarse de limpiar el búfer en caso de error.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el XML de multas: ' . $e->getMessage()]);

    error_log("Error en XMMultas.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>