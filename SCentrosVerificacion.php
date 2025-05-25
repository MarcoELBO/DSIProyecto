<?php
    include_once("proteccion.php");
    validar_token('T', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Consulta</title>
    <link rel="stylesheet" href="./css/FACCESO.css">
    </head>
<body>
    <?php

    $criterio = $_REQUEST['criterio'];
    $atributo = $_REQUEST['atributo'];


    $SQL = "SELECT * FROM centros_verificacion WHERE $atributo LIKE '$criterio';";
    include("Controlador.php");

    $conexion = Conectar();

    $ResultSet = Ejecutar($conexion, $SQL);

    $n = mysqli_num_rows($ResultSet);
    $columnas = mysqli_field_count($conexion);

    Desconectar($conexion);
    ?>

    <main class="page-wrapper">
        <section class="data-card">
            <h1 class="data-card__title">Resultados de la Consulta</h1>

            <?php if (isset($ResultSet) && mysqli_num_rows($ResultSet) > 0): ?>
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
                            // Llenar la tabla con los registros
                            // Volvemos a posicionar el puntero para asegurar que se lean desde el inicio si es necesario
                            mysqli_data_seek($ResultSet, 0);

                            while ($fila = mysqli_fetch_row($ResultSet)):
                                ?>
                                <tr class="data-table__row">
                                    <?php
                                    // Asegúrate de que $columnas esté definido (puede ser mysqli_num_fields($ResultSet);)
                                    // o puedes usar count($fila) si mysqli_fetch_row ya te da el array completo.
                                    $num_columnas_fila = count($fila);
                                    for ($j = 0; $j < $num_columnas_fila; $j++): ?>
                                        <td class="data-table__cell"><?= htmlspecialchars($fila[$j]); ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="data-card__empty-message">No se encontraron resultados para su consulta.</p>
            <?php endif; ?>

            <?php
            // Liberar el resultado de la consulta y cerrar la conexión a la base de datos
            if (isset($ResultSet)) {
                mysqli_free_result($ResultSet);
            }
            // if (isset($conexion)) {
            //     mysqli_close($conexion);
            // }
            ?>
        </section>
    </main>
</body>
</html>