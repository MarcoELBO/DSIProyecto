<?php
    //Obtener datos del Frontend
    $Criterio = $_REQUEST['Criterio'];
    $Atributo = $_REQUEST['Atributo'];

    //Crear instrucción SQL
    $SQL = "SELECT * FROM Oficiales WHERE $Atributo LIKE '%$Criterio%'";

    //Enviar la instruccion al SMBD
    include("../controlador.php");
    $Conexion = Conectar();
    $ResultSet = Ejecutar($Conexion, $SQL);

    $N = mysqli_num_rows($ResultSet);
    $Columnas = mysqli_num_fields($ResultSet);

    if (isset($_GET['generar_csv'])) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Oficiales.csv"');
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, ['IdOficial', 'Cargo', 'Nombre', 'Apellido']);
        
        while ($Fila = $ResultSet->fetch_assoc()) {
            fputcsv($output, $Fila);
        }
        
        fputcsv($output, ['Total de registros:', $N]);
        
        fputcsv($output, ['']);
        fputcsv($output, ['Informacion del Sistema', '']);
        fputcsv($output, ['Servidor BD:', 'localhost']);
        fputcsv($output, ['Usuario BD:', 'root']);
        fputcsv($output, ['Nombre BD:', 'controlvehicular31']);
        fclose($output);
        exit();
    }

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Resultados de Búsqueda</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h2>Resultados de Búsqueda</h2>
        <table>
            <tr>
                <th>IdOficial</th>
                <th>Cargo</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>";

    while ($Fila = $ResultSet->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($Fila['IdOficial']) . "</td>
                <td>" . htmlspecialchars($Fila['Cargo']) . "</td>
                <td>" . htmlspecialchars($Fila['Nombre']) . "</td>
                <td>" . htmlspecialchars($Fila['Apellido']) . "</td>
            </tr>";
    }

    echo "</table>";
    echo "<p>Registros Encontrados: " . $N . "</p>";

    echo "<a href='?Criterio=" . urlencode($Criterio) . "&Atributo=" . urlencode($Atributo) . "&generar_csv=1'>
            <button>Generar Archivo CSV</button>
          </a>";

    Desconectar($Conexion);

    echo "</body>
    </html>";
?>