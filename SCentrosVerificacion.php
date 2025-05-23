<?php
$criterio = $_REQUEST['criterio'];
$atributo = $_REQUEST['atributo'];

$SQL = "SELECT * FROM centros_verificacion WHERE $atributo LIKE '%$criterio%';";

include("Controlador.php");

$conexion = conectar();

$ResultSet = ejecutar($conexion, $SQL);

$n = mysqli_num_rows($ResultSet);
$columnas = mysqli_field_count($conexion);
?>
<table border="1">
    <tr>
        <?php
        // Obtener los nombres de las columnas (encabezados)
        $campos = mysqli_fetch_fields($ResultSet);
        foreach ($campos as $campo):
            ?>
            <th><?= $campo->name; ?></th>
        <?php endforeach; ?>
    </tr>

    <?php
    // Llenar la tabla con los registros
    for ($i = 0; $i < $n; $i++):
        $fila = mysqli_fetch_row($ResultSet);
        ?>
        <tr>
            <?php for ($j = 0; $j < $columnas; $j++): ?>
                <td><?= $fila[$j]; ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

<p>Registros Encontrados: <?= $n; ?></p>

<?php
Desconectar($conexion);
?>