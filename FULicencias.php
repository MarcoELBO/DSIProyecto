<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Licencias</title>
    <link rel="stylesheet" href="./css/FACCESO.css"> </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_LICENCIA'])) {
            echo "Falta el ID_LICENCIA";
            exit;
        }

        $ID_LICENCIA = $_GET['ID_LICENCIA'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM licencias WHERE ID_LICENCIA = '$ID_LICENCIA'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="POST" action="ULicencias.php">
            <h1 class="form__title">Editar Licencias</h1>

            <div class="form__group">
                <label for="ID_LICENCIA" class="form__label">ID_LICENCIA</label>
                <input type="number" name="ID_LICENCIA" id="ID_LICENCIA" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_LICENCIA'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="CONDUCTOR" class="form__label">CONDUCTOR</label>
                <input type="text" name="CONDUCTOR" id="CONDUCTOR" class="form__input" value="<?php echo htmlspecialchars($Row['CONDUCTOR'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FECHA_EXPEDICION" class="form__label">FECHA_EXPEDICION</label>
                <input type="date" name="FECHA_EXPEDICION" id="FECHA_EXPEDICION" class="form__input" value="<?php echo htmlspecialchars($Row['FECHA_EXPEDICION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FECHA_VALIDACION" class="form__label">FECHA_VALIDACION</label>
                <input type="date" name="FECHA_VALIDACION" id="FECHA_VALIDACION" class="form__input" value="<?php echo htmlspecialchars($Row['FECHA_VALIDACION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="ANTIGUEDAD" class="form__label">ANTIGUEDAD</label>
                <input type="text" name="ANTIGUEDAD" id="ANTIGUEDAD" class="form__input" value="<?php echo htmlspecialchars($Row['ANTIGUEDAD'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="OBSERVACIONES" class="form__label">OBSERVACIONES</label>
                <input type="text" name="OBSERVACIONES" id="OBSERVACIONES" class="form__input" value="<?php echo htmlspecialchars($Row['OBSERVACIONES'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FIRMA" class="form__label">FIRMA</label>
                <input type="text" name="FIRMA" id="FIRMA" class="form__input" value="<?php echo htmlspecialchars($Row['FIRMA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="DOMICILIO" class="form__label">DOMICILIO</label>
                <input type="text" name="DOMICILIO" id="DOMICILIO" class="form__input" value="<?php echo htmlspecialchars($Row['DOMICILIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FUNDAMENTO_LEGAL" class="form__label">FUNDAMENTO_LEGAL</label>
                <input type="text" name="FUNDAMENTO_LEGAL" id="FUNDAMENTO_LEGAL" class="form__input" value="<?php echo htmlspecialchars($Row['FUNDAMENTO_LEGAL'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="FOTO" class="form__label">FOTO</label>
                <input type="text" name="FOTO" id="FOTO" class="form__input" value="<?php echo htmlspecialchars($Row['FOTO'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Licencia</button>
        </form>
    </div>
</body>
</html>