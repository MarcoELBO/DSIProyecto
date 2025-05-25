<?php
// Iniciar el buffering de salida. Esto captura toda la salida del script
// para que podamos enviar encabezados HTTP (como el código de estado)
// antes de que se envíe cualquier contenido (HTML o PDF).
    include_once("proteccion.php");
    validar_token('T', true);
ob_start();

// Incluir la librería FPDF
require('fpdf.php');

// --- 1. Obtención y Validación de Parámetros ---
$id_licencia = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';

// Si el ID de la licencia no se proporciona o está vacío, es un error del cliente.
if (empty($id_licencia)) {
    http_response_code(400); // 400 Bad Request
    header('Content-Type: application/json'); // Indicamos que la respuesta será JSON
    echo json_encode(['status' => 'error', 'message' => 'Error: ID de licencia no proporcionado.']);
    ob_end_clean(); // Limpia el búfer y no envía nada antes del JSON
    exit; // Termina la ejecución del script
}

// --- 2. Conexión a la Base de Datos ---
// Asegúrate de que el nombre del archivo 'Controlador.php' y las funciones
// 'Conectar()', 'Ejecutar()', 'Desconectar()' coinciden con la capitalización real.
include("Controlador.php");

$Conexion = null; // Inicializar a null
$ResultSet = null; // Inicializar a null

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
    $SQL = "SELECT * FROM licenciasconducir3 WHERE no_licencia = '$id_licencia';";
    $ResultSet = Ejecutar($Conexion, $SQL);

    // Comprobar si la ejecución de la consulta fue exitosa
    if (!$ResultSet) {
        throw new Exception("Error en la consulta SQL: " . mysqli_error($Conexion));
    }

    // Comprobar si se encontró algún registro
    if (mysqli_num_rows($ResultSet) === 0) {
        http_response_code(400); // 404 Not Found
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Licencia no encontrada para el ID proporcionado.']);
        ob_end_clean();
        exit;
    }

    $Fila = mysqli_fetch_assoc($ResultSet);

    // Liberar el resultado de la consulta
    mysqli_free_result($ResultSet);

    // --- 4. Generación del PDF (Si todo fue exitoso hasta aquí) ---

    // Limpiar el búfer antes de que FPDF envíe sus propios encabezados
    ob_end_clean();

    // Crear el objeto FPDF
    $pdf = new FPDF('P', 'mm', [30, 45]); // Tamaño pequeño
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 0);

    // --- PARTE 1 ---
    // Asegúrate de que las rutas de las imágenes son correctas y que las imágenes existen
    $pdf->Image('Imagenes/estadoQueretaro.png', 3, 2, 5, 5);
    $pdf->Image('Imagenes/LV.png', 10, 2, 1, 5);

    $pdf->SetFont('Arial', '', 2);
    $pdf->SetY(2); // Posiciona el cursor vertical debajo del logo
    $pdf->Cell(0, 1.3, 'Estados Unidos Mexicanos', 0, 1);
    $pdf->Cell(0, 1.3, 'Poder Ejecutivo del Estado de Queretaro', 0, 1);
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->Cell(0, 1.3, 'Secretaria de Seguridad Ciudadana', 0, 1);
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->Cell(0, 1.3, 'Licencia para Conducir', 0, 1);

    // --- PARTE 2 ---
    // Asegúrate de que $Fila['foto'] contenga una ruta de imagen válida y accesible
    if (!empty($Fila['foto']) && file_exists($Fila['foto'])) {
        $pdf->Image($Fila['foto'], 17, 9, 10, 12);
    } else {
        // Opcional: Si la foto no existe, puedes poner un placeholder o dejar el espacio en blanco
        // error_log("Advertencia: La imagen de la licencia no se encontró en la ruta: " . $Fila['foto']);
    }

    $pdf->SetXY(0, 17.5);
    $pdf->SetFont('Arial', '', 1.5);
    $pdf->Cell(17, 1.3, 'No. de licencia', 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetX(0);
    $pdf->Cell(17, 1.3, $Fila['no_licencia'], 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetX(0);
    $pdf->Cell(17, 1.3, 'AUTOMOVILISTA', 0, 1, 'R');

    // --- PARTE 3 ---
    $pdf->SetXY(18, 21.5);
    $pdf->Cell(10, 1, 'Nombre', 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 4);
    $pdf->SetXY(18, 23);
    $pdf->MultiCell(10, 1.2, $Fila['nombre'], 0, 'R');
    $pdf->SetFont('Arial', 'B', 1.5);
    $pdf->SetXY(18, 26.5);
    $pdf->Cell(10, 1, 'OBSERVACIONES', 0, 1, 'R');

    // --- PARTE 4 ---
    $pdf->SetXY(2, 30);
    $pdf->SetFont('Arial', 'B', 1.5);
    $pdf->Cell(0, 1, 'Fecha de nacimiento', 0, 1);
    $pdf->SetXY(2, 31);
    $pdf->SetFont('Arial', '', 3);
    $pdf->Cell(0, 1, $Fila['fecha_nacimiento'], 0, 1);
    $pdf->SetXY(2, 32);
    $pdf->SetFont('Arial', 'B', 1.5);
    $pdf->Cell(0, 1, 'Fecha de expedicion', 0, 1);
    $pdf->SetXY(2, 33);
    $pdf->SetFont('Arial', '', 3);
    $pdf->Cell(0, 1, $Fila['fecha_expedicion'], 0, 1);
    $pdf->SetXY(2, 34);
    $pdf->SetFont('Arial', 'B', 1.5);
    $pdf->Cell(0, 1, 'Valida hasta', 0, 1);
    $pdf->SetXY(2, 35);
    $pdf->SetFont('Arial', '', 3);
    $pdf->Cell(0, 1, $Fila['fecha_validacion'], 0, 1);
    $pdf->SetXY(2, 36);
    $pdf->SetFont('Arial', 'B', 1.5);
    $pdf->Cell(0, 1, 'Antiguedad', 0, 1);
    $pdf->SetXY(2, 37);
    $pdf->SetFont('Arial', '', 3);
    $pdf->Cell(0, 1, $Fila['antiguedad'], 0, 1);

    // --- PARTE 5 ---
    $pdf->Image('Imagenes/A.png', 3, 38.5, 4, 4);
    // Asegúrate de que $Fila['firma'] contenga una ruta de imagen válida y accesible
    if (!empty($Fila['firma']) && file_exists($Fila['firma'])) {
        $pdf->Image($Fila['firma'], 12, 33, 6, 6);
    } else {
        // error_log("Advertencia: La imagen de la firma no se encontró en la ruta: " . $Fila['firma']);
    }

    $pdf->SetXY(11, 41);
    $pdf->SetFont('Arial', '', 1.5);
    $pdf->Cell(0, 1, 'AUTORIZO PARA QUE LA PRESENTE SEA', 0, 1, 'C');
    $pdf->SetX(11);
    $pdf->Cell(0, 1, 'RECABADA COMO GARANTIA DE INFRACCION', 0, 1, 'C');
    $pdf->Image('Imagenes/Queretaro.png', 24, 38.5, 4, 4);


    // --- PAGINA 2 ---
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->Image('Imagenes/Emergencias.png', 2, 2, 6, 5);
    $pdf->SetFont('Arial', '', 5);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Image('Imagenes/Negro.png', 9, 2.5, 12, 4);
    $pdf->SetXY(10, 4.5);
    $pdf->Cell(0, 0, 'B211571223', 0, 1, 'C'); // Este es un valor fijo, no viene de $Fila
    $pdf->Image('Imagenes/089.png', 23.1, 2.5, 5, 4);

    // --- PARTE 2 (Página 2) ---
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->SetXY(0, 8);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(29, 1, 'Domicilio', 0, 1, 'R');
    $pdf->Cell(19, 1, $Fila['domicilio'], 0, 1, 'R'); // Asegúrate de que 'domicilio' exista en la vista
    // Las siguientes líneas están comentadas en tu original, las mantengo así
    //$pdf->Cell(34.9, 1, 'SN', 0, 1, 'C'); // No está en $Fila
    //$pdf->Cell(32, 1, $Fila['cp'], 0, 1, 'C'); // Asegúrate de que 'cp' exista en la vista
    //$pdf->Cell(32.7, 1, 'C.P.' . $Fila['cp'], 0, 1, 'C');
    //$pdf->Cell(31.5, 1, $Fila['estado'], 0, 1, 'C'); // Asegúrate de que 'estado' exista en la vista
    $pdf->Image('Imagenes/Coches.png', 2, 13, 27, 6);

    // --- PARTE 3 (Página 2) ---
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->SetXY(2, 19);
    $pdf->Cell(0, 0, 'Restricciones', 0);
    $pdf->Cell(0, 0, '      Grupo Sanguineo', 0, 1);
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->SetXY(2, 19);
    $pdf->Cell(0, 2, '9NINGUNA', 0); // Este es un valor fijo
    $pdf->Cell(9, 2, $Fila['tipo_sangre'], 0, 1, 'R'); // Asegúrate de que 'tipo_sangre' exista en la vista
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->Cell(19, 1, 'DonadordeOrganos', 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(19, 1, $Fila['donador_organos'], 0, 1, 'R'); // Asegúrate de que 'donador_organos' exista en la vista
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->Cell(19, 1, 'NumerodeEmergencias', 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(19, 2, $Fila['numero_emergencia'], 0, 1, 'R'); // Asegúrate de que 'numero_emergencia' exista en la vista

    $pdf->Image('Imagenes/Firma.png', 24, 26, 4, 4); // Esta firma parece ser genérica, no la de $Fila

    $pdf->SetXY(0, 31);
    $pdf->SetFont('Arial', 'B', 1.8);
    $pdf->Cell(29, 1, 'MTRO EN GPA MIGUEL ANGEL CONTRERAZ ALVAREZ', 0, 1, 'R'); // Valor fijo
    $pdf->Cell(19, 1, 'SECRETARIO DE SEGURIDAD CIUDADANA', 0, 1, 'R'); // Valor fijo
    $pdf->SetXY(2, 33);
    $pdf->Cell(0, 1, 'Fundamento Legal', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 1.5);
    $pdf->SetXY(2, 34);
    $pdf->MultiCell(27, 0.5, 'Ley de Transito y Transporte del Estado de Queretaro, Articulo 4, Fraccion I, II y III. Reglamento de la Ley de Transito y Transporte del Estado de Queretaro, Articulo 2, Fraccion I, II y III.', 0, 'L'); // Valor fijo
    $pdf->Image('Imagenes/PoderEjecutivo.png', 16, 38, 6, 6);
    $pdf->Image('Imagenes/LV.png', 21, 38.5, 1, 5);
    $pdf->SetXY(0, 39.5);
    $pdf->SetFont('Arial', 'B', 2);
    $pdf->Cell(27.5, 1, 'SECRETARIA', 0, 1, 'R'); // Valor fijo
    $pdf->Cell(18.3, 1, 'DE SEGURIDAD', 0, 1, 'R'); // Valor fijo
    $pdf->Cell(17.2, 1, 'CIUDADANA', 0, 1, 'R'); // Valor fijo

    // Finalmente, envía el PDF al navegador
    $pdf->Output();

} catch (Exception $e) {
    // Si ocurre cualquier error (conexión, consulta, FPDF si no se limpió el búfer a tiempo),
    // se captura aquí y se envía una respuesta de error JSON.
    http_response_code(500); // 500 Internal Server Error
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Fallo en el servidor al generar el PDF: ' . $e->getMessage()]);

    // Opcional: Loggear el error para depuración en el servidor
    error_log("Error en generar_licencia_pdf.php: " . $e->getMessage() . " en línea " . $e->getLine());

} finally {
    // Asegurarse de cerrar la conexión a la base de datos en cualquier caso
    if (isset($Conexion) && $Conexion) {
        Desconectar($Conexion);
    }
}
?>