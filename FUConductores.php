<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conductores</title>
    <link rel="stylesheet" href="./css/FACCESO.css">  </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['CURP'])) {
            echo "Falta el CURP";
            exit;
        }

        $CURP = $_GET['CURP'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM conductores WHERE CURP = '$CURP'");
                if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UConductores.php">
            <h1 class="form__title">Editar Conductores</h1>

            <div class="form__group">
                <label for="CURP" class="form__label">CURP</label>
                <input type="text" name="CURP" id="CURP" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['CURP'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="NOMBRE" class="form__label">Nombre</label>
                <input type="text" name="NOMBRE" id="NOMBRE" class="form__input" value="<?php echo htmlspecialchars($Row['NOMBRE'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="DOMICILIO" class="form__label">Domicilio</label>
                <input type="text" name="DOMICILIO" id="DOMICILIO" class="form__input" value="<?php echo htmlspecialchars($Row['DOMICILIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FOLIO_TC" class="form__label">Folio Tarjeta de Circulación</label>
                <input type="text" name="FOLIO_TC" id="FOLIO_TC" class="form__input" value="<?php echo htmlspecialchars($Row['FOLIO_TC'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="NO_LICENCIA" class="form__label">No Licencia</label>
                <input type="text" name="NO_LICENCIA" id="NO_LICENCIA" class="form__input" value="<?php echo htmlspecialchars($Row['NO_LICENCIA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FECHA_NACIMIENTO" class="form__label">Fecha Nacimiento</label>
                <input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" class="form__input" value="<?php echo htmlspecialchars($Row['FECHA_NACIMIENTO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="TIPO_SANGRE" class="form__label">Tipo Sangre</label>
                <input type="text" name="TIPO_SANGRE" id="TIPO_SANGRE" class="form__input" value="<?php echo htmlspecialchars($Row['TIPO_SANGRE'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="DONADOR_ORG" class="form__label">Donador Órgano</label>
                <input type="text" name="DONADOR_ORG" id="DONADOR_ORG" class="form__input" value="<?php echo htmlspecialchars($Row['DONADOR_ORG'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="NUMERO_EMERGENCIA" class="form__label">Número Emergencia</label>
                <input type="text" name="NUMERO_EMERGENCIA" id="NUMERO_EMERGENCIA" class="form__input" value="<?php echo htmlspecialchars($Row['NUMERO_EMERGENCIA'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Conductor</button>
        </form>
    </div>
</body>
</html>