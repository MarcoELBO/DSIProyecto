<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarjetas de Verificación</title>
    <link rel="stylesheet" href="./css/FACCESO.css"></head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['FOLIO_VERIFICACION'])) {
            echo "Falta el Folio de Verificacion";
            exit;
        }

        $FOLIO_VERIFICACION = $_GET['FOLIO_VERIFICACION'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM tarjetas_verificacion WHERE FOLIO_VERIFICACION = '$FOLIO_VERIFICACION'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UTarjetasVerificacion.php">
            <h1 class="form__title">Editar Tarjetas de Verificación</h1>

            <div class="form__group">
                <label for="FOLIO_VERIFICACION" class="form__label">Folio de Verificación</label>
                <input type="text" name="FOLIO_VERIFICACION" id="FOLIO_VERIFICACION" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['FOLIO_VERIFICACION'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="VEHICULO" class="form__label">Vehículo</label>
                <input type="text" name="VEHICULO" id="VEHICULO" class="form__input" value="<?php echo htmlspecialchars($Row['VEHICULO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="DOMICILIO" class="form__label">Domicilio</label>
                <input type="text" name="DOMICILIO" id="DOMICILIO" class="form__input" value="<?php echo htmlspecialchars($Row['DOMICILIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="TC" class="form__label">Tarjeta de Circulación</label>
                <input type="text" name="TC" id="TC" class="form__input" value="<?php echo htmlspecialchars($Row['TC'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="CENTRO_VERIFICACION" class="form__label">Centro de Verificación</label>
                <input type="text" name="CENTRO_VERIFICACION" id="CENTRO_VERIFICACION" class="form__input" value="<?php echo htmlspecialchars($Row['CENTRO_VERIFICACION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="TECNICO_VERIFICACION" class="form__label">Técnico de Verificación</label>
                <input type="text" name="TECNICO_VERIFICACION" id="TECNICO_VERIFICACION" class="form__input" value="<?php echo htmlspecialchars($Row['TECNICO_VERIFICACION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FECHA_EXPEDICION" class="form__label">Fecha de Expedición</label>
                <input type="date" name="FECHA_EXPEDICION" id="FECHA_EXPEDICION" class="form__input" value="<?php echo htmlspecialchars($Row['FECHA_EXPEDICION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="HORA_ENTRADA" class="form__label">Hora de Entrada</label>
                <input type="time" name="HORA_ENTRADA" id="HORA_ENTRADA" class="form__input" value="<?php echo htmlspecialchars($Row['HORA_ENTRADA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="HORA_SALIDA" class="form__label">Hora de Salida</label>
                <input type="time" name="HORA_SALIDA" id="HORA_SALIDA" class="form__input" value="<?php echo htmlspecialchars($Row['HORA_SALIDA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="MOTIVO_VERIFICACION" class="form__label">Motivo de Verificación</label>
                <input type="text" name="MOTIVO_VERIFICACION" id="MOTIVO_VERIFICACION" class="form__input" value="<?php echo htmlspecialchars($Row['MOTIVO_VERIFICACION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="SEMESTRE" class="form__label">Semestre</label>
                <input type="text" name="SEMESTRE" id="SEMESTRE" class="form__input" value="<?php echo htmlspecialchars($Row['SEMESTRE'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FOLIO_PREVIO" class="form__label">Folio Previo</label>
                <input type="text" name="FOLIO_PREVIO" id="FOLIO_PREVIO" class="form__input" value="<?php echo htmlspecialchars($Row['FOLIO_PREVIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="VIGENCIA" class="form__label">Vigencia</label>
                <input type="date" name="VIGENCIA" id="VIGENCIA" class="form__input" value="<?php echo htmlspecialchars($Row['VIGENCIA'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Tarjeta de Verificación</button>
        </form>
    </div>
</body>
</html>