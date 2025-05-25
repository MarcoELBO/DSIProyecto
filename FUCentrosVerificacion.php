<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Centros de Verificacion</title>
    <link rel="stylesheet" href="./css/FACCESO.css">  </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['NO_CENTRO'])) {
            echo "Falta el NO_CENTRO";
            exit;
        }

        $NO_CENTRO = $_GET['NO_CENTRO'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM centros_verificacion WHERE NO_CENTRO = '$NO_CENTRO'");
                if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UCentrosVerificacion.php">
            <h1 class="form__title">Editar Centros de Verificación</h1>


            <div class="form__group">
                <label for="NO_CENTRO" class="form__label">NO_CENTRO</label>
                <input type="number" name="NO_CENTRO" id="NO_CENTRO" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['NO_CENTRO'] ?? ''); ?>" readonly required>
            </div>

            <div class="form__group">
                <label for="NO_LINEA" class="form__label">NO_LINEA</label>
                <input type="text" name="NO_LINEA" id="NO_LINEA" class="form__input" value="<?php echo htmlspecialchars($Row['NO_LINEA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="VERIFICACION" class="form__label">VERIFICACION</label>
                <input type="text" name="VERIFICACION" id="VERIFICACION" class="form__input" value="<?php echo htmlspecialchars($Row['VERIFICACION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="NOMBRE" class="form__label">NOMBRE</label>
                <input type="text" name="NOMBRE" id="NOMBRE" class="form__input" value="<?php echo htmlspecialchars($Row['NOMBRE'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="DOMICILIO" class="form__label">DOMICILIO</label>
                <input type="text" name="DOMICILIO" id="DOMICILIO" class="form__input" value="<?php echo htmlspecialchars($Row['DOMICILIO'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="TIPO_CENTRO" class="form__label">TIPO_CENTRO</label>
                <input type="text" name="TIPO_CENTRO" id="TIPO_CENTRO" class="form__input" value="<?php echo htmlspecialchars($Row['TIPO_CENTRO'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Centro de Verificacion</button>
        </form>
    </div>
</body>
</html>