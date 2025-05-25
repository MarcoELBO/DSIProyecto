<?php
    include_once("proteccion.php");
    validar_token('A', true);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pagos</title>
    <link rel="stylesheet" href="./css/FACCESO.css"> </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Pago'])) {
            echo "Falta el ID_Pago";
            exit;
        }

        $ID_Pago = $_GET['ID_Pago'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM pagos WHERE ID_Pago = '$ID_Pago'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UPagos.php">
            <h1 class="form__title">Editar Pagos</h1>

            <div class="form__group">
                <label for="ID_Pago" class="form__label">ID_Pago</label>
                <input type="number" name="ID_Pago" id="ID_Pago" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['ID_Pago'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="Servicio" class="form__label">Servicio</label>
                <input type="text" name="Servicio" id="Servicio" class="form__input" value="<?php echo htmlspecialchars($Row['Servicio'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Monto" class="form__label">Monto</label>
                <input type="number" name="Monto" id="Monto" class="form__input" value="<?php echo htmlspecialchars($Row['Monto'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Fecha" class="form__label">Fecha</label>
                <input type="date" name="Fecha" id="Fecha" class="form__input" value="<?php echo htmlspecialchars($Row['Fecha'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Hora" class="form__label">Hora</label>
                <input type="time" name="Hora" id="Hora" class="form__input" value="<?php echo htmlspecialchars($Row['Hora'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Tarjeta_Asociada" class="form__label">Tarjeta Asociada</label>
                <input type="text" name="Tarjeta_Asociada" id="Tarjeta_Asociada" class="form__input" value="<?php echo htmlspecialchars($Row['Tarjeta_Asociada'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Pago</button>
        </form>
    </div>
</body>
</html>