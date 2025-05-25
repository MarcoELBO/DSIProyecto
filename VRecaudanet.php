<?php
// Iniciar el buffering de salida. Esto captura toda la salida del script
// para que podamos enviar encabezados HTTP (como el código de estado)
// antes de que se envíe cualquier contenido (HTML o PDF).
    include_once("proteccion.php");
    validar_token('T', true);
ob_start();

// Incluir el controlador de la base de datos
include("Controlador.php");

// --- 1. Obtención y Validación de Parámetros ---
$id_pago = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de pago no se proporciona o está vacío, es un error del cliente.
if (empty($id_pago)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de pago no proporcionado.']);
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
    $SQL = "SELECT * FROM vehiculotcp WHERE ID_Pago = '$id_pago';";
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Comprobar si la ejecución de la consulta fue exitosa
    if (!$ResultSet) {
        throw new Exception("Error en la consulta SQL: " . mysqli_error($Conexion));
    }

    // Comprobar si se encontró algún registro
    if (mysqli_num_rows($ResultSet) === 0) {
        http_response_code(404); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Ficha de pago no encontrada para el ID proporcionado.']);
        ob_end_clean();
        exit;
    }

    $Fila = mysqli_fetch_assoc($ResultSet);

    // Liberar el resultado de la consulta
    mysqli_free_result($ResultSet);

    // --- 4. Generación del PDF (Si todo fue exitoso hasta aquí) ---

    // Limpiar el búfer antes de que FPDF envíe sus propios encabezados
    ob_end_clean();

    // Incluir la librería FPDF (se movió aquí para asegurar que no se cargue si hay error temprano)
    require('fpdf.php');

    $pdf = new FPDF('P', 'mm', array(215.9, 279.4)); // Tamaño Carta (Letter)
    $pdf->AddPage();
    $pdf->SetMargins(20, 15, 20); // Márgenes
    $pdf->SetFont('Arial', 'B', 40);

    // Encabezado
    $pdf->Rect(20, 10, 20, 25, 'F');
    // Asegúrate de que 'Imagenes/LQueretaro.png' exista y sea accesible
    if (file_exists('Imagenes/LQueretaro.png')) {
        $pdf->Image('Imagenes/LQueretaro.png', 45, 12, 25, 20); // Imagen pequeña
    } else {
        // error_log("Advertencia: Imagen LQueretaro.png no encontrada.");
    }
    $pdf->Cell(0, 15, 'RECAUDANET', 0, 1, 'R');

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetXY(20, 35);
    $pdf->Cell(0, 10, 'Poder Ejecutivo del Estado de Queretaro', 0, 1);
    $pdf->Rect(20, 45, 175, 10, 'F');
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 10, 'Gracias por usar recaudanet', 0, 1);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Ln(2);

    // Datos del vehículo y pago
    // Usar el operador de fusión de null (?? 'N/A') para datos potencialmente faltantes
    $pdf->Cell(0, 8, 'Placa: ' . ($Fila['Placa'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, 'MODELO ' . ($Fila['Modelo'] ?? 'N/A') . ' COLOR: ' . ($Fila['Color'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, ($Fila['Marca'] ?? 'N/A') . ' ' . ($Fila['SUBMARCA'] ?? 'N/A') . ' ' . ($Fila['capacidad'] ?? 'N/A') . ' PH, GASOLINA', 0, 1);
    $pdf->Cell(0, 8, 'Transaccion: ' . ($Fila['ID_Pago'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, 'Fecha limite para el pago: ' . ($Fila['Fecha'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, 'Importe: $' . ($Fila['Monto'] ?? 'N/A'), 0, 1);
    $pdf->SetXY(108, 81); // Esta posición podría necesitar ajuste según el contenido superior
    $pdf->Cell(0, 8, 'Tipo de instrumento de pago: Pago referendado', 0, 1); // Valor fijo
    $pdf->SetX(108);
    $pdf->Cell(0, 8, 'Fecha actual: ' . ($Fila['Fecha'] ?? 'N/A'), 0, 1);
    $pdf->SetX(108);
    $pdf->Cell(0, 8, 'Hora: ' . ($Fila['Hora'] ?? 'N/A'), 0, 1);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(0, 6, 'Nota: El nombre y/o razón social que saldrá en el recibo de pago y/o CFDI será el registrado en el padrón vehicular, el cual una vez pagado no podrá ser modificado.');

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 8, 'BANCOS Y ESTABLECIMIENTOS DONDE PUEDES EFECTUAR TUS PAGOS', 0, 1, 'C');
    // Asegúrate de que 'Imagenes/CB.png' exista y sea accesible
    if (file_exists('Imagenes/CB.png')) {
        $pdf->Image('Imagenes/CB.png', 43, 145, 130, 30);
    } else {
        // error_log("Advertencia: Imagen CB.png no encontrada.");
    }


    $pdf->Rect(20, 135, 175, 100, '');
    $pdf->Rect(20, 135, 175, 5, 'F'); // Este parece ser un rectángulo de relleno superior

    // Salida del archivo PDF
    $pdf->Output('I', 'recaudanet_ficha_pago_' . ($Fila['ID_Pago'] ?? 'N/A') . '.pdf');

} catch (Exception $e) {
    // Si ocurre cualquier error (conexión, consulta, FPDF si no se limpió el búfer a tiempo),
    // se captura aquí y se envía una respuesta de error JSON.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar la ficha de pago: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_pago_pdf.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>