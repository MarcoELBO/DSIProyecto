<?php
// Iniciar el buffering de salida. Esto captura toda la salida del script
// para que podamos enviar encabezados HTTP (como el código de estado)
// antes de que se envíe cualquier contenido (HTML o PDF).
ob_start();

// Incluir la librería FPDF
require('fpdf.php');

// Incluir el controlador de la base de datos
include("Controlador.php");

// --- 1. Obtención y Validación de Parámetros ---
$id_multa = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de la multa no se proporciona o está vacío, es un error del cliente.
if (empty($id_multa)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de multa no proporcionado.']);
    ob_end_clean(); // Limpia el búfer y no envía nada antes del JSON
    exit; // Termina la ejecución del script
}

// --- 2. Conexión a la Base de Datos ---
$Conexion = null; // Inicializar a null
$ResultSet = null; // Inicializar a null
$Datos = null; // Inicializar a null

try {
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        // Si Conectar() no lanza excepción pero retorna false/null, lanzamos una
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 3. Preparación y Ejecución de la Consulta ---
    // NOTA DE SEGURIDAD: Esta consulta es VULNERABLE a inyección SQL.
    // Para entornos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "SELECT * FROM multas1 WHERE Folio = '$id_multa';";
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Comprobar si la ejecución de la consulta fue exitosa
    if (!$ResultSet) {
        throw new Exception("Error en la consulta SQL: " . mysqli_error($Conexion));
    }

    // Comprobar si se encontró algún registro
    if (mysqli_num_rows($ResultSet) === 0) {
        http_response_code(404); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Multa no encontrada para el ID/Folio proporcionado.']);
        ob_end_clean();
        exit;
    }

    $Datos = mysqli_fetch_assoc($ResultSet);

    // Liberar el resultado de la consulta
    mysqli_free_result($ResultSet);

    // --- 4. Generación del PDF (Si todo fue exitoso hasta aquí) ---

    // Limpiar el búfer antes de que FPDF envíe sus propios encabezados
    ob_end_clean();

    // Crear el objeto FPDF
    $pdf = new FPDF('P', 'mm', array(180, 250));
    $pdf->SetMargins(10, 10);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Fundamento
    $pdf->MultiCell(0, 5, "Con fundamento en los artículos 31 fraccion XV de la Ley de Transito para el Estado de Queretaro y fraccion XVI del Reglamento de la misma ley, se emite la presente boleta de infraccion.", 0, 'J');
    $pdf->Ln(3);

    // Datos básicos
    // Asegúrate de que $Datos['Folio'] existe y no es nulo
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Boleta de Infraccion No. B-' . ($Datos['Folio'] ?? 'N/A'), 0, 1, 'R');

    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['Fecha'] y $Datos['Hora'] existan
    $pdf->Cell(95, 8, 'Fecha: ' . ($Datos['Fecha'] ?? 'N/A'), 1);
    $pdf->Cell(65, 8, 'Hora: ' . ($Datos['Hora'] ?? 'N/A'), 1, 1);

    // Lugar
    // Asegúrate de que $Datos['Lugar'] existe
    $pdf->MultiCell(0, 8, "Lugar de la infraccion: " . ($Datos['Lugar'] ?? 'N/A'), 1);
    $pdf->Ln(2);

    // Datos del infractor
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Datos del Infractor', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['NOMBRE'], $Datos['NO_LICENCIA'], $Datos['DOMICILIO'] existan
    $pdf->Cell(95, 8, 'Nombre: ' . ($Datos['NOMBRE'] ?? 'N/A'), 1);
    $pdf->Cell(65, 8, 'Licencia: ' . ($Datos['NO_LICENCIA'] ?? 'N/A'), 1, 1);
    $pdf->Cell(0, 8, 'Direccion: ' . ($Datos['DOMICILIO'] ?? 'N/A'), 1, 1);
    $pdf->Ln(2);

    // Vehículo
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Datos del Vehiculo', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['Placa'], $Datos['Marca'], $Datos['Modelo'], $Datos['Color'] existan
    $pdf->Cell(50, 8, 'Placa: ' . ($Datos['Placa'] ?? 'N/A'), 1);
    $pdf->Cell(70, 8, 'Marca: ' . ($Datos['Marca'] ?? 'N/A'), 1);
    $pdf->Cell(40, 8, 'Modelo: ' . ($Datos['Modelo'] ?? 'N/A'), 1, 1);
    $pdf->Cell(160, 8, 'Color: ' . ($Datos['Color'] ?? 'N/A'), 1, 1);
    $pdf->Ln(2);

    // Motivo
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Motivo de la infraccion', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['Motivo'] existe
    $pdf->MultiCell(0, 8, ($Datos['Motivo'] ?? 'N/A'), 1);
    $pdf->Ln(2);

    // Oficial
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Datos del Oficial', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['NombreO'] y $Datos['ID_Oficial'] existan
    $pdf->Cell(95, 8, 'Nombre: ' . ($Datos['NombreO'] ?? 'N/A'), 1);
    $pdf->Cell(65, 8, 'Placa: ' . ($Datos['ID_Oficial'] ?? 'N/A'), 1, 1);
    $pdf->Ln(2);

    // Centro de pago
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Centro de Pago', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 8, 'Recaudanet', 1); // Valor fijo
    $pdf->Ln(2);

    // Observaciones
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Observaciones del Conductor', 1, 1);
    $pdf->SetFont('Arial', '', 10);
    // Asegúrate de que $Datos['Observaciones'] existe
    $pdf->MultiCell(0, 8, ($Datos['Observaciones'] ?? 'N/A'), 1);
    $pdf->Ln(2);

    // Fundamento legal
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 4, "Para el pago de la presente infracción y devolución de las garantías retenidas, es aplicable lo dispuesto en el artículo 179 del Reglamento de la Ley de Tránsito del Estado de Querétaro. El infractor podrá pagar en oficinas recaudadoras o centros autorizados. Tiene un plazo de 90 días naturales para pagar, con descuento del 50% si lo hace en los primeros 10 días hábiles, salvo excepciones.", 1);

    // Imagen opcional (si la ruta es correcta y la imagen existe)
    // $pdf->Image("escudo.png", 10, 420, 30); // Asegúrate de que esta imagen exista y la posición sea válida

    // Finalmente, envía el PDF al navegador
    $pdf->Output();

} catch (Exception $e) {
    // Si ocurre cualquier error (conexión, consulta, FPDF si no se limpió el búfer a tiempo),
    // se captura aquí y se envía una respuesta de error JSON.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el PDF de la multa: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_multa_pdf.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>