<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("Controlador.php");
    $conexion = conectar();

    // Obtener la consulta SQL desde el formulario
    $sql = $_POST['sql'];
    $ResultSet = ejecutar($conexion, $sql);

    // Configurar encabezados para la descarga del archivo CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="exported_data.csv"');

    $output = fopen('php://output', 'w');

    // Escribir los encabezados de las columnas
    $campos = mysqli_fetch_fields($ResultSet);
    $headers = [];
    foreach ($campos as $campo) {
        $headers[] = $campo->name;
    }
    fputcsv($output, $headers);

    // Escribir los datos de las filas
    while ($row = mysqli_fetch_assoc($ResultSet)) {
        fputcsv($output, $row);
    }

    fclose($output);
    Desconectar($conexion);
    exit;
}
?>