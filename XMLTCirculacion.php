<?php
// Iniciar el buffering de salida para controlar los encabezados HTTP.
ob_start();

// --- 1. Inclusión de la librería de protección y validación del token ---
// Asegúrate de que 'proteccion.php' contiene las funciones generador_token y validar_token
// adaptadas para usar cookies.
include_once("proteccion.php");
 validar_token('T', true);


$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';
// --- 2. Configuración de la Carpeta de Destino para XML ---
// Ruta relativa donde se almacenarán los XML. Asegúrate que esta ruta es accesible por el navegador.
// Usamos un nombre de carpeta diferente para tarjetas de circulación
const XML_STORAGE_DIR_CIRCULACION = 'xml_files/'; 

// En este script, no hay un 'id' de entrada, así que siempre generará todos los datos de circulacionvehiculo.

// --- 3. Conexión a la Base de Datos ---
// Asegúrate de que 'Controlador.php' contenga las funciones Conectar(), Ejecutar(), Desconectar().
include("Controlador.php"); 

$Conexion = null;
$ResultSetCirculacion = null;

try {
    $Conexion = Conectar();

    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 4. Creación del Objeto DOMDocument para XML ---
    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->formatOutput = true; 

    // El nodo raíz según tu script original es "Conductores"
    $root = $xml->createElement("Conductores"); 
    $xml->appendChild($root);

    // --- 5. Preparación de la Consulta SQL ---
    // ¡¡¡ADVERTENCIA DE SEGURIDAD CRÍTICA!!!
    // Esta consulta es VULNERABLE a inyección SQL si las entradas del usuario se usaran en ella.
    // Aunque actualmente no usas un input 'id' para filtrar, es una buena práctica estar al tanto.
    // Para producción, DEBES USAR SENTENCIAS PREPARADAS (prepared statements).
    $SQL_Circulacion = "SELECT * FROM tar_cir WHERE ID = '$id'"; // Cambiado a 'ID' según tu script
    $ResultSetCirculacion = Ejecutar($Conexion, $SQL_Circulacion);

    if (!$ResultSetCirculacion) {
        throw new Exception("Error en la consulta SQL para tarjeta de circulación: " . mysqli_error($Conexion));
    }

    if (mysqli_num_rows($ResultSetCirculacion) === 0) {
        // 404 Not Found si no se encuentran datos de circulación
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron datos de tarjeta de circulación en la base de datos.']);
        ob_end_clean();
        exit;
    }

    while ($fila = mysqli_fetch_assoc($ResultSetCirculacion)) {
        // El nodo para cada entrada según tu script original es "Conductor"
        $conductorNode = $xml->createElement("Conductor"); 
        foreach ($fila as $clave => $valor) {
            // Reemplazar caracteres no válidos en nombres de nodos XML si es necesario
            $valid_clave = preg_replace('/[^a-zA-Z0-9_]/', '', $clave);
            $elemento = $xml->createElement($valid_clave, htmlspecialchars($valor));
            $conductorNode->appendChild($elemento);
        }
        $root->appendChild($conductorNode);
    }
    mysqli_free_result($ResultSetCirculacion);

    // --- 6. Verificar y Crear la Carpeta de Almacenamiento ---
    if (!is_dir(XML_STORAGE_DIR_CIRCULACION)) {
        if (!mkdir(XML_STORAGE_DIR_CIRCULACION, 0755, true)) {
            throw new Exception("Error al crear la carpeta de almacenamiento de XML para tarjeta de circulación: " . XML_STORAGE_DIR_CIRCULACION);
        }
    }

    // --- 7. Generar Nombre de Archivo Único y Guardar el XML ---
    // El nombre base según tu script original es "TarjetaCirculacion"
    $uniqueFileName = 'TarjetaCirculacion_' . uniqid() . '.xml';
    $filePath = XML_STORAGE_DIR_CIRCULACION . $uniqueFileName;

    if (!$xml->save($filePath)) {
        throw new Exception("Error al guardar el archivo XML de tarjeta de circulación en: " . $filePath);
    }

    // --- 8. Respuesta Exitosa ---
    ob_end_clean(); // Limpia el búfer antes de enviar la respuesta JSON final.
    http_response_code(200); // 200 OK
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Archivo XML de tarjeta de circulación generado y almacenado correctamente.',
        'file_name' => $uniqueFileName,
        // Devuelve la ruta completa y accesible para el navegador
        'file_path' => XML_STORAGE_DIR_CIRCULACION . $uniqueFileName 
    ]);

} catch (Exception $e) {
    ob_end_clean(); // Asegurarse de limpiar el búfer en caso de error.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el XML de tarjeta de circulación: ' . $e->getMessage()]);

    error_log("Error en la_ruta_de_este_script.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>