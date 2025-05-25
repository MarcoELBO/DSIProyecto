<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarjetas de Circulación</title>
    <link rel="stylesheet" href="./css/FACCESO.css"> </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_TC'])) {
            echo "Falta el ID_TC";
            exit;
        }

        $ID_TC = $_GET['ID_TC'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM tarjetas_circulacion WHERE ID_TC = '$ID_TC'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UTarjetasCirculacion.php">
            <h1 class="form__title">Editar Tarjetas de Circulación</h1>

            <div class="form__group">
                <label for="ID_TC" class="form__label">ID_TC</label>
                <input type="number" name="ID_TC" id="ID_TC" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_TC'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="Vehiculo" class="form__label">Vehículo</label>
                <input type="text" name="Vehiculo" id="Vehiculo" class="form__input" value="<?php echo htmlspecialchars($Row['Vehiculo'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Propietario" class="form__label">Propietario</label>
                <input type="text" name="Propietario" id="Propietario" class="form__input" value="<?php echo htmlspecialchars($Row['Propietario'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Tipo_Servicio" class="form__label">Tipo_Servicio</label>
                <input type="text" name="Tipo_Servicio" id="Tipo_Servicio" class="form__input" value="<?php echo htmlspecialchars($Row['Tipo_Servicio'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Domicilio" class="form__label">Domicilio</label>
                <input type="text" name="Domicilio" id="Domicilio" class="form__input" value="<?php echo htmlspecialchars($Row['Domicilio'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="VIGENCIA" class="form__label">VIGENCIA</label>
                <input type="text" name="VIGENCIA" id="VIGENCIA" class="form__input" value="<?php echo htmlspecialchars($Row['VIGENCIA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Fecha_expedicion" class="form__label">Fecha_expedicion</label>
                <input type="date" name="Fecha_expedicion" id="Fecha_expedicion" class="form__input" value="<?php echo htmlspecialchars($Row['Fecha_expedicion'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Tarjeta de Circulación</button>
        </form>
    </div>
</body>
</html>