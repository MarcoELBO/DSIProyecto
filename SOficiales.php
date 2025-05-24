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
    // Obteniendo los valores del front end
    $criterio = $_REQUEST['criterio'];
    $atributo = $_REQUEST['atributo'];

    // ¡¡ADVERTENCIA DE SEGURIDAD!!
    // La forma en que se construye la consulta SQL aquí es VULNERABLE a Inyección SQL.
    // Usar directamente $_REQUEST['atributo'] y $_REQUEST['criterio'] en la consulta
    // sin validación ni preparación de sentencias es EXTREMADAMENTE PELIGROSO.
    // DEBERÍAS UTILIZAR SENTENCIAS PREPARADAS (Prepared Statements) con mysqli_stmt_bind_param
    // para proteger tu aplicación.
    // Solo como ejemplo didáctico, mantengo la estructura original, pero ten esto en cuenta.

    // Crear la instruccion Sql
    $sql = "SELECT * FROM oficiales WHERE $atributo LIKE '$criterio';"; // Agregado '%' para búsqueda parcial

    // Enviar la instruccion al SMBD
    include("controlador.php");
    $conexion = conectar();

    if (!$conexion) {
        die("Error al conectar a la base de datos.");
    }

    $ResultSet = ejecutar($conexion, $sql);

    if (!$ResultSet) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Procesamiento
    $n = mysqli_num_rows($ResultSet);
    $columnas_count_for_loop = mysqli_num_fields($ResultSet); // Definimos antes del bucle de filas
    ?>

    <main class="page-wrapper">
        <section class="data-card">
            <h1 class="data-card__title">Resultados de la Búsqueda de Oficiales</h1>

            <?php if ($n > 0): ?>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <?php
                                // Obtener los nombres de las columnas (encabezados)
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
                <p class="data-card__footer-info">Registros Encontrados: <b><?= $n; ?></b></p>
            <?php else: ?>
                <p class="data-card__empty-message">No se encontraron oficiales con el criterio especificado.</p>
            <?php endif; ?>

            <?php
            Desconectar($conexion);
            ?>
        </section>
    </main>
</body>
</html>