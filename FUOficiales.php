<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oficiales</title>
    <link rel="stylesheet" href="./css/FACCESO.css"></head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Oficial'])) {
            echo "Falta el IdOficial";
            exit;
        }

        $ID_Oficial = $_GET['ID_Oficial'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM oficiales WHERE ID_Oficial = '$ID_Oficial'");
                if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UOficiales.php">
            <h1 class="form__title">Editar Oficiales</h1>

            <div class="form__group">
                <label for="ID_Oficial" class="form__label">IdOficial</label>
                <input type="number" name="ID_Oficial" id="ID_Oficial" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_Oficial'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="NombreO" class="form__label">Nombre</label>
                <input type="text" name="Nombre" id="NombreO" class="form__input" value="<?php echo htmlspecialchars($Row['NombreO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Cargo" class="form__label">Cargo</label>
                <input type="text" name="Cargo" id="Cargo" class="form__input" value="<?php echo htmlspecialchars($Row['Cargo'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Oficial</button>
        </form>
    </div>
</body>
</html>