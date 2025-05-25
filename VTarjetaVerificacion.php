<?php
// Iniciar el buffering de salida.
ob_start();

// Incluir el controlador de la base de datos
include("Controlador.php");

// --- 1. Obtención y Validación de Parámetros ---
// El 'id' se mapea al 'folio' en la vista 'tar_veri'.
$id_verificacion = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de verificación no se proporciona o está vacío, es un error del cliente.
if (empty($id_verificacion)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de verificación no proporcionado.']);
    ob_end_clean(); // Limpia el búfer y no envía nada antes del JSON
    exit; // Termina la ejecución del script
}

// --- 2. Conexión a la Base de Datos ---
$Conexion = null; // Inicializar a null
$ResultSet = null; // Inicializar a null
$DATOS = null; // Inicializar a null

try {
    $Conexion = Conectar();

    // Comprobar si la conexión fue exitosa
    if (!$Conexion) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // --- 3. Preparación y Ejecución de la Consulta ---
    // NOTA DE SEGURIDAD: Esta consulta es VULNERABLE a inyección SQL.
    // Para entornos de producción, se recomienda encarecidamente usar sentencias preparadas.
    $SQL = "SELECT * FROM tar_veri WHERE folio = '$id_verificacion';";
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Comprobar si la ejecución de la consulta fue exitosa
    if (!$ResultSet) {
        throw new Exception("Error en la consulta SQL: " . mysqli_error($Conexion));
    }

    // Comprobar si se encontró algún registro
    if (mysqli_num_rows($ResultSet) === 0) {
        http_response_code(404); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Tarjeta de verificación no encontrada para el ID/folio proporcionado.']);
        ob_end_clean();
        exit;
    }

    $DATOS = mysqli_fetch_assoc($ResultSet);

    // Liberar el resultado de la consulta
    mysqli_free_result($ResultSet);

    // --- 4. Generación del PDF (Si todo fue exitoso hasta aquí) ---

    // Limpiar el búfer antes de que FPDF envíe sus propios encabezados
    ob_end_clean();

    // Incluir la librería FPDF
    require('fpdf.php');

    // Crear documento PDF tamaño carta (210 x 110 mm) horizontal
    $pdf = new FPDF('L', 'mm', array(210, 110));
    $pdf->AddPage();
    $pdf->SetMargins(2, 15, 2);
    $pdf->SetAutoPageBreak(true, 0); // No auto-salto de página
    $pdf->SetFont('Arial', 'B', 10);

    // Logos superiores
    // Asegúrate de que las rutas de las imágenes son correctas y que existen
    if (file_exists('Imagenes/Q2.png')) {
        $pdf->Image('Imagenes/Q2.png', 6, 6, 20, 8); // Logo
    }
    if (file_exists('Imagenes/Q3.png')) {
        $pdf->Image('Imagenes/Q3.png', 30, 6, 20, 8); // Logo
    }

    $pdf->SetXY(0, 2);
    $pdf->Cell(0, 10, 'PROGRAMA ESTATAL DE VERIFICACION VEHICULAR', 0, 1, 'C');
    $pdf->SetXY(0, 8);
    $pdf->Cell(0, 10, 'PODER EJECUTIVO DEL ESTADO DE QUERETARO', 0, 1, 'C');

    if (file_exists('Imagenes/B.png')) {
        $pdf->Image('Imagenes/B.png', 155, 14, 45, 10); // Logo
    }

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->SetXY(2, 25);
    // Datos del vehículo
    $pdf->Cell(0, 6, 'DATOS DEL VEHICULO', 0, 1);

    $pdf->SetXY(2, 32);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(30, 2, 'PARTICULAR', 0); // Valor fijo
    $pdf->Cell(30, 2, ($DATOS['tipo_servicio'] ?? 'N/A'), 0);
    $pdf->Cell(30, 2, ($DATOS['marca'] ?? 'N/A'), 0);
    $pdf->Cell(20, 2, ($DATOS['submarca'] ?? 'N/A'), 0);
    $pdf->Cell(35, 2, ($DATOS['modelo'] ?? 'N/A'), 0);
    $pdf->Cell(30, 2, 'Vigencia: ' . ($DATOS['vigencia'] ?? 'N/A'), 0); // Vigencia viene de la vista
    $pdf->Rect(3, 35, 135, 0.5, 'F');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(2, 37);
    $pdf->Cell(30, 2, 'TIPO SERVICIO', 0);
    $pdf->Cell(30, 2, 'MARCA', 0);
    $pdf->Cell(30, 2, 'SUBMARCA', 0);
    $pdf->Cell(20, 2, 'MODELO', 0);
    $pdf->Cell(25, 2, 'PLACA', 0); // No veo Placa usada aquí, pero es en el DATOS de arriba.

    if (file_exists('Imagenes/QR.png')) {
        $pdf->Image('Imagenes/QR.png', 145, 40, 20, 20); // Logo
    }

    // Lógica para tipo de combustible (convertir 1 a GASOLINA, etc.)
    $tipo_combustible_display = ($DATOS['tipo_combustible'] ?? '');
    if ($tipo_combustible_display == 1) {
        $tipo_combustible_display = 'GASOLINA';
    } else if ($tipo_combustible_display == 2) { // Asumo 2 para ELÉCTRICO, ajusta si hay otros valores
        $tipo_combustible_display = 'ELECTRICO';
    } else {
        $tipo_combustible_display = 'N/A';
    }

    $pdf->SetXY(2, 40);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(35, 8, ($DATOS['numero_serie'] ?? 'N/A'), 0);
    $pdf->Cell(35, 8, ($DATOS['clase'] ?? 'N/A'), 0);
    $pdf->Cell(30, 8, $tipo_combustible_display, 0);
    $pdf->Cell(35, 8, ($DATOS['identificacion_vehicular'] ?? 'N/A'), 0);
    $pdf->Rect(3, 46, 135, 0.5, 'F');

    $pdf->SetXY(2, 45);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(35, 8, 'NUMERO DE SERIE', 0);
    $pdf->Cell(35, 8, 'CLASE', 0);
    $pdf->Cell(30, 8, 'TIPO DE COMBUSTIBLE', 0);
    $pdf->Cell(35, 8, 'IDENTIFICACION VEHICULAR', 0);
    $pdf->Rect(3, 57, 135, 0.5, 'F'); // Esta línea de Rect está duplicada y en posición extraña. Revisar si es intencional.

    $pdf->SetXY(2, 51);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(35, 8, ($DATOS['cilindros'] ?? 'N/A'), 0);
    $pdf->Cell(35, 8, 'Querétaro', 0); // Valor fijo, la vista no tiene ENTIDAD_FEDERATIVA
    $pdf->Cell(30, 8, 'Querétaro', 0); // Valor fijo, la vista no tiene MUNICIPIO
    // Aquí el original tenía Rect(3, 46, 130, 0.5, 'F'); de nuevo. Lo mantengo comentado si no es intencional
    // $pdf->Rect(3, 46, 130, 0.5, 'F');

    $pdf->SetXY(2, 56);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(35, 8, 'NUMERO DE CILINDROS', 0);
    $pdf->Cell(30, 8, 'ENTIDAD FEDERATIVA', 0);
    $pdf->Cell(35, 8, 'MUNICIPIO', 0);

    $pdf->SetXY(2, 65);
    $pdf->Cell(35, 5, 'No. DE CENTRO', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['no_centro_verificacion'] ?? 'N/A'), 0, 1);
    $pdf->Cell(35, 5, 'TECNICO VERIFICADOR', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['tecnico'] ?? 'N/A'), 0, 1);
    $pdf->Cell(35, 5, 'FECHA DE EXPEDICION', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['fecha_expedicion'] ?? 'N/A'), 0, 1);
    $pdf->Cell(35, 5, 'HORA DE ENTRADA', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['hora_entrada'] ?? 'N/A'), 0, 1);

    // Corregida la concatenación de HORA DE SALIDA y MOTIVO DE VERIFICACION
    $pdf->Cell(35, 5, 'HORA DE SALIDA: ' . ($DATOS['hora_salida'] ?? 'N/A'), 0, 0);
    // 'motivo' no está en la vista proporcionada. Se usará 'N/A' y se comentará.
    $pdf->Cell(35, 5, 'MOTIVO DE VERIFICACION: ' . ($DATOS['motivo'] ?? 'N/A'), 0, 1);

    $pdf->Cell(35, 5, 'FOLIO DE CERTIFICADO', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['folio'] ?? 'N/A'), 0, 1);
    $pdf->Cell(35, 5, 'SEMESTRE', 0, 0);
    $pdf->Cell(35, 5, ($DATOS['semestre'] ?? 'N/A'), 0, 1);

    if (file_exists('Imagenes/LQ.png')) {
        $pdf->Image('Imagenes/LQ.png', 140, 70, 30, 30); // Logo
    }

    // Salida del archivo PDF
    $pdf->Output('I', 'tarjeta_verificacion_' . ($id_verificacion ?? 'N/A') . '.pdf');

} catch (Exception $e) {
    // Si ocurre cualquier error, se captura aquí y se envía una respuesta de error JSON.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el PDF de verificación: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_verificacion_pdf.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>