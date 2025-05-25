<?php
// Iniciar el buffering de salida.
ob_start();

// Incluir el controlador de la base de datos
include("Controlador.php");

// --- 1. Obtención y Validación de Parámetros ---
$id_tc = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de la tarjeta de circulación no se proporciona o está vacío.
if (empty($id_tc)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de tarjeta de circulación no proporcionado.']);
    ob_end_clean(); // Limpia el búfer y no envía nada antes del JSON
    exit; // Termina la ejecución del script
}

// --- 2. Conexión a la Base de Datos ---
$Conexion = null; // Inicializar a null
$ResultSet = null; // Inicializar a null
$Fila = null; // Inicializar a null

try {
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 3. Preparación y Ejecución de la Consulta ---
    // NOTA DE SEGURIDAD: Esta consulta es VULNERABLE a inyección SQL.
    // Para entornos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "SELECT * FROM tar_cir WHERE ID = '$id_tc';";
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Comprobar si la ejecución de la consulta fue exitosa
    if (!$ResultSet) {
        throw new Exception("Error en la consulta SQL: " . mysqli_error($Conexion));
    }

    // Comprobar si se encontró algún registro
    if (mysqli_num_rows($ResultSet) === 0) {
        http_response_code(404); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Tarjeta de circulación no encontrada para el ID proporcionado.']);
        ob_end_clean();
        exit;
    }

    $Fila = mysqli_fetch_assoc($ResultSet);

    // Liberar el resultado de la consulta
    mysqli_free_result($ResultSet);

    // --- 4. Generación del PDF (Si todo fue exitoso hasta aquí) ---

    // Limpiar el búfer antes de que FPDF envíe sus propios encabezados
    ob_end_clean();

    // Incluir la librería FPDF
    require('fpdf.php');

    $pdf = new FPDF('L', 'mm', [85.60, 54]); // Tamaño de tarjeta de crédito (ISO/IEC 7810 ID-1)
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 0); // No auto-salto de página

    //PARTE 1 - Datos de la tarjeta
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 4);
    $pdf->Cell(18, 1, 'TIPO DE SERVICIO', 0);
    $pdf->Cell(18, 1, 'HOLOGRAMA', 0);
    $pdf->Cell(12, 1, 'FOLIO', 0); // El original no usa un campo para folio, lo dejé así
    $pdf->Cell(12, 1, 'VIGENCIA', 0);
    $pdf->Cell(12, 1, 'PLACA', 0, 1);

    $pdf->SetFont('Arial', '', 4);
    $pdf->SetXY(3, 6);
    $pdf->Cell(18, 1, ($Fila['tipo_servicio'] ?? 'N/A'), 0); // Ajuste de ancho
    $pdf->Cell(18, 1, ($Fila['numero_serie'] ?? 'N/A'), 0); // Usado como holograma
    $pdf->Cell(12, 1, ($Fila['ID'] ?? 'N/A'), 0); // Asumo que ID de TC es el folio
    $pdf->Cell(12, 1, ($Fila['vigencia'] ?? 'N/A'), 0);
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(15, 1, ($Fila['placa'] ?? 'N/A'), 0, 1);

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 8);
    $pdf->Cell(12, 1, 'PROPIETARIO', 0);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(12, 1, $Fila['nombre'], 0); // Valor fijo

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 12);
    $pdf->Cell(25, 1, 'RFC', 0);
    $pdf->Cell(25, 1, 'NUMERO DE SERIE', 0);
    $pdf->Cell(25, 1, 'MODELO', 0, 1);
    $pdf->SetFont('Arial', '', 4);
    $pdf->SetXY(3, 14);
    $pdf->Cell(25, 1, ($Fila['rfc'] ?? 'N/A'), 0);
    $pdf->Cell(25, 1, ($Fila['numero_serie'] ?? 'N/A'), 0);
    $pdf->Cell(25, 1, ($Fila['modelo'] ?? 'N/A'), 0);

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 16);
    $pdf->Cell(25, 1, 'LOCALIDAD', 0);
    $pdf->Cell(25, 1, 'MARCA/LINEA/SUBLINEA', 0);
    $pdf->Cell(25, 1, 'OPERACION', 0);
    $pdf->SetFont('Arial', '', 4);
    $pdf->SetXY(3, 18);
    $pdf->Cell(25, 1, ($Fila['domicilio'] ?? 'N/A'), 0);
    $pdf->Cell(25, 1, ($Fila['marca'] ?? 'N/A') . '/' . ($Fila['linea'] ?? 'N/A') . '/' . ($Fila['submarca'] ?? 'N/A'), 0);
    $pdf->Cell(25, 1, '2018/1058773', 0); // Valor fijo

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 22);
    $pdf->Cell(25, 1, 'MUNICIPIO', 0);
    $pdf->SetFont('Arial', '', 4);
    $pdf->SetXY(3, 24);
    $pdf->Cell(25, 1, 'QUERETARO', 0); // Valor fijo

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(3, 26);
    $pdf->Cell(20, 1, 'NUMERO DE CONSTANCIAS', 0);
    $pdf->Cell(10, 1, 'CILINDRAJE', 0);
    $pdf->Cell(5, 1, ($Fila['cilindraje'] ?? 'N/A'), 0);
    $pdf->Cell(15, 1, 'CVE VEHICULAR', 0); // No veo campo para esto en la vista
    $pdf->Cell(15, 1, 'FECHA DE EXPEDICION', 0, 1);
    $pdf->SetXY(3, 27);
    $pdf->Cell(20, 1, 'DE INSCRIPCION', 0); // Parte de "NUMERO DE CONSTANCIAS DE INSCRIPCION"
    $pdf->Cell(10, 1, 'CAPACIDAD', 0);
    $pdf->Cell(20, 1, ($Fila['capacidad'] ?? 'N/A'), 0);
    $pdf->Cell(20, 1, ($Fila['fecha_expedicion'] ?? 'N/A'), 0);
    $pdf->SetXY(23, 28);
    $pdf->Cell(10, 1, 'PUERTAS', 0);
    $pdf->Cell(5, 1, ($Fila['puertas'] ?? 'N/A'), 0);
    $pdf->Cell(10, 1, 'CLASE', 0);
    $pdf->Cell(5, 1, '2', 0); // Valor fijo
    $pdf->Cell(15, 1, 'OFICINA EXPEDIDORA', 0);
    $pdf->Cell(1, 1, '1', 0); // Valor fijo
    $pdf->SetXY(23, 29);
    $pdf->Cell(10, 1, 'ASIENTOS', 0);
    $pdf->Cell(5, 1, ($Fila['asientos'] ?? 'N/A'), 0);
    $pdf->Cell(10, 1, 'TIPO', 0);
    $pdf->Cell(5, 1, '9', 0); // Valor fijo
    $pdf->Cell(10, 1, 'MOVIMIENTO', 0); // No veo campo para esto en la vista
    $pdf->SetXY(3, 30);
    $pdf->Cell(20, 1, 'ORIGEN', 0);
    $pdf->Cell(10, 1, 'COMBUSTIBLE', 0);
    $pdf->Cell(5, 1, ($Fila['combustible'] ?? 'N/A'), 0); // Corregido: antes era '1' fijo
    $pdf->Cell(10, 1, 'USO', 0);
    $pdf->Cell(5, 1, '36', 0); // Valor fijo
    $pdf->Cell(10, 1, 'ALTA DE PLACA', 0); // No veo campo para esto en la vista
    $pdf->SetXY(3, 32);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(20, 1, ($Fila['origen'] ?? 'N/A'), 0);
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(15, 1, 'TRANSMISION', 0);
    $pdf->Cell(15, 1, 'RPA', 0); // El original usaba $Fila['origen'] para este
    $pdf->Cell(10, 1, 'NUMERO DE MOTOR', 0); // No veo campo para esto en la vista
    $pdf->SetXY(3, 34);
    $pdf->Cell(20, 1, 'COLOR', 0);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(30, 1, ($Fila['transmision'] ?? 'N/A'), 0);
    $pdf->Cell(20, 1, ($Fila['origen'] ?? 'N/A'), 0); // Usando origen para RPA, como en el original
    $pdf->SetXY(3, 36);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(30, 1, ($Fila['color'] ?? 'N/A'), 0);

    // Imágenes y Textos inferiores
    if (file_exists('Imagenes/Q1.png')) {
        $pdf->Image('Imagenes/Q1.png', 15, 37, 20, 10);
    }
    $pdf->SetXY(38, 40);
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(30, 2, 'PODER EJECUTIVO DEL', 0, 1);
    $pdf->SetX(38);
    $pdf->Cell(30, 2, 'ESTADO DE QUERETARO', 0, 1);
    $pdf->SetFont('Arial', '', 3);
    $pdf->SetX(38);
    $pdf->Cell(30, 2, 'SECRETARIA DE SEGURIDAD CIUDADANA', 0, 1);

    if (file_exists('Imagenes/rectangulo.png')) {
        // Asegúrate de que esta imagen sea transparente o se ajuste bien al fondo
        $pdf->Image('Imagenes/rectangulo.png', 16.8, 44, 52, 30);
    }
    $pdf->SetXY(0, 50.5);
    $pdf->SetFont('Arial', '', 6);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(85.60, 2, 'TARJETA DE CIRCULACION VEHICULAR', 0, 1, 'C');

    // Vertical
    $pdf->SetXY(80, 15);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->MultiCell(1, 2.5, 'A1679305', 0, 'C'); // Valor fijo

    if (file_exists('Imagenes/QR.png')) {
        $pdf->Image('Imagenes/QR.png', 68, 38, 15, 15);
    }

    if (file_exists('Imagenes/LQ.png')) {
        $pdf->Image('Imagenes/LQ.png', 4, 40, 10, 10);
    }

    // Salida del archivo PDF
    $pdf->Output('I', 'tarjeta_circulacion_' . ($id_tc ?? 'N/A') . '.pdf');

} catch (Exception $e) {
    // Si ocurre cualquier error, se captura aquí y se envía una respuesta de error JSON.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el PDF de tarjeta de circulación: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_tarjeta_circulacion_pdf.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>  