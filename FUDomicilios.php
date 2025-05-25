<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Domicilio</title>
    <link rel="stylesheet" href="./css/FACCESO.css"></head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_DOMICILIO'])) {
            echo "Falta el Id_Domicilio";
            exit;
        }

        $ID_DOMICILIO = $_GET['ID_DOMICILIO'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM domicilios WHERE ID_DOMICILIO = '$ID_DOMICILIO'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UDomicilios.php">
            <h1 class="form__title">Editar Domicilio</h1>

            <div class="form__group">
                <label for="ID_Domicilio" class="form__label">Id_Domicilio</label>
                <input type="number" name="ID_Domicilio" id="ID_Domicilio" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_DOMICILIO'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="CALLE" class="form__label">Calle</label>
                <input type="text" name="CALLE" id="CALLE" class="form__input" value="<?php echo htmlspecialchars($Row['CALLE'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="CP" class="form__label">CP</label>
                <input type="text" name="CP" id="CP" class="form__input" value="<?php echo htmlspecialchars($Row['CP'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="COLONIA" class="form__label">Colonia</label>
                <input type="text" name="COLONIA" id="COLONIA" class="form__input" value="<?php echo htmlspecialchars($Row['COLONIA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="NUM_INT" class="form__label">Número Interior</label>
                <input type="text" name="NUM_INT" id="NUM_INT" class="form__input" value="<?php echo htmlspecialchars($Row['NUM_INT'] ?? ''); ?>">
            </div>

            <div class="form__group">
                <label for="NUM_EXT" class="form__label">Número Exterior</label>
                <input type="text" name="NUM_EXT" id="NUM_EXT" class="form__input" value="<?php echo htmlspecialchars($Row['NUM_EXT'] ?? ''); ?>">
            </div>

            <div class="form__group">
                <label for="ESTADO" class="form__label">Estado</label>
                <input type="text" name="ESTADO" id="ESTADO" class="form__input" value="<?php echo htmlspecialchars($Row['ESTADO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="MUNICIPIO" class="form__label">Municipio</label>
                <input type="text" name="MUNICIPIO" id="MUNICIPIO" class="form__input" value="<?php echo htmlspecialchars($Row['MUNICIPIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="REFERENCIAS" class="form__label">Referencias</label>
                <textarea name="REFERENCIAS" id="REFERENCIAS" class="form__input"><?php echo htmlspecialchars($Row['REFERENCIAS'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="form__button">Actualizar Domicilio</button>
        </form>
    </div>
</body>
</html>