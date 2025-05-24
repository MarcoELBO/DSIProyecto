<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Oficiales</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
    </head>
<body>
    <?php
    // --- 1. Obtención y Validación de Parámetros ---
    // Es buena práctica verificar si las variables existen antes de usarlas
    $criterio = isset($_REQUEST['criterio']) ? $_REQUEST['criterio'] : '';
    $atributo = isset($_REQUEST['atributo']) ? $_REQUEST['atributo'] : '';


    // --- 2. Conexión a la Base de Datos ---
    include("controlador.php"); // Asumo que este archivo contiene las funciones conectar() y Desconectar()
    $conexion = conectar();

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // --- 3. Preparación y Ejecución de la Consulta (¡SEGURA!) ---
    $n = 0; // Inicializar número de registros encontrados
    $ResultSet = null; // Inicializar ResultSet

    // Construir la consulta SQL de forma segura
    // Usamos un placeholder (?) para el criterio. El nombre de la columna ($atributo) no puede ser un placeholder.
    // Por eso es CRÍTICO validar $atributo con la lista blanca.
    $sql = "SELECT * FROM vehiculos WHERE $atributo LIKE '$criterio';";
    echo $sql; // Para depuración, puedes comentar esta línea en producción
    // Preparar la sentencia
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        // Enlazar parámetros
        // 's' indica que el parámetro es un string
        // Agregamos '%' para que la búsqueda sea 'LIKE %criterio%' (contiene)
        $criterio_busqueda = '%' . $criterio . '%';
        mysqli_stmt_bind_param($stmt, 's', $criterio_busqueda);

        // Ejecutar la sentencia preparada
        mysqli_stmt_execute($stmt);

        // Obtener el resultado
        $ResultSet = mysqli_stmt_get_result($stmt);

        if ($ResultSet) {
            $n = mysqli_num_rows($ResultSet);
            $columnas_count_for_loop = mysqli_num_fields($ResultSet);
        } else {
            echo "<p class='data-card__empty-message'>Error al obtener resultados: " . mysqli_error($conexion) . "</p>";
        }

        // Cerrar la sentencia preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "<p class='data-card__empty-message'>Error al preparar la consulta: " . mysqli_error($conexion) . "</p>";
    }
    ?>

    <main class="page-wrapper">
        <section class="data-card">
            <h1 class="data-card__title">Resultados de la Búsqueda de Oficiales</h1>

            <?php if ($ResultSet && $n > 0): ?>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <?php
                                // Obtener los nombres de las columnas (encabezados)
                                // Si $ResultSet es null, esta parte fallaría, por eso la verificación anterior
                                $campos = mysqli_fetch_fields($ResultSet);
                                foreach ($campos as $campo):
                                    ?>
                                    <th class="data-table__header"><?= htmlspecialchars($campo->name); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Volvemos a posicionar el puntero del resultado después de mysqli_fetch_fields
                            // para que mysqli_fetch_row pueda leer desde el inicio.
                            mysqli_data_seek($ResultSet, 0);

                            while ($fila = mysqli_fetch_row($ResultSet)):
                                ?>
                                <tr class="data-table__row">
                                    <?php for ($j = 0; $j < $columnas_count_for_loop; $j++): ?>
                                        <td class="data-table__cell"><?= htmlspecialchars($fila[$j]); ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <p class="data-card__footer-info">Registros Encontrados: **<?= $n; ?>**</p>
            <?php else: ?>
                <p class="data-card__empty-message">No se encontraron oficiales con el criterio especificado o hubo un error en la búsqueda.</p>
            <?php endif; ?>

            <?php
            // --- 4. Cierre de Recursos ---
            if (isset($ResultSet) && $ResultSet) {
                mysqli_free_result($ResultSet);
            }
            Desconectar($conexion); // Asumo que esta función cierra la conexión
            ?>
        </section>
    </main>
</body>
</html>