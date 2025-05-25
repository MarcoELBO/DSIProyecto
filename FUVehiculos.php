<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículos</title>
    <link rel="stylesheet" href="./css/FACCESO.css">  </head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['Placa'])) {
            echo "Falta numero de Placa";
            exit;
        }

        $Placa = $_GET['Placa'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM vehiculos WHERE Placa = '$Placa'");
        if (mysqli_num_rows($ResultSet) == 0) {
            echo "Error en la consulta: " . mysqli_error($Conexion);
            exit;
        }
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <div class="container">
        <form class="form" method="get" action="UVehiculos.php">
            <h1 class="form__title">Editar Vehículos</h1>

            <div class="form__group">
                <label for="Placa" class="form__label">Placa</label>
                <input type="text" name="Placa" id="Placa" class="form__input form__input--readonly" value="<?php echo htmlspecialchars($Row['Placa'] ?? ''); ?>" readonly>
            </div>

            <div class="form__group">
                <label for="Marca" class="form__label">Marca</label>
                <input type="text" name="Marca" id="Marca" class="form__input" value="<?php echo htmlspecialchars($Row['Marca'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="SUBMARCA" class="form__label">SUBMARCA</label>
                <input type="text" name="SUBMARCA" id="SUBMARCA" class="form__input" value="<?php echo htmlspecialchars($Row['SUBMARCA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="LINEA" class="form__label">LÍNEA</label>
                <input type="text" name="LINEA" id="LINEA" class="form__input" value="<?php echo htmlspecialchars($Row['LINEA'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Color" class="form__label">Color</label>
                <input type="text" name="Color" id="Color" class="form__input" value="<?php echo htmlspecialchars($Row['Color'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Modelo" class="form__label">Modelo</label>
                <input type="text" name="Modelo" id="Modelo" class="form__input" value="<?php echo htmlspecialchars($Row['Modelo'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Numero_Serie" class="form__label">Número de Serie</label>
                <input type="text" name="Numero_Serie" id="Numero_Serie" class="form__input" value="<?php echo htmlspecialchars($Row['Numero_Serie'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Puertas" class="form__label">Puertas</label>
                <input type="text" name="Puertas" id="Puertas" class="form__input" value="<?php echo htmlspecialchars($Row['Puertas'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Asientos" class="form__label">Asientos</label>
                <input type="text" name="Asientos" id="Asientos" class="form__input" value="<?php echo htmlspecialchars($Row['Asientos'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Cilindraje" class="form__label">Cilindraje</label>
                <input type="text" name="Cilindraje" id="Cilindraje" class="form__input" value="<?php echo htmlspecialchars($Row['Cilindraje'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="Combustible" class="form__label">Combustible</label>
                <input type="text" name="Combustible" id="Combustible" class="form__input" value="<?php echo htmlspecialchars($Row['Combustible'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="capacidad" class="form__label">Capacidad</label>
                <input type="text" name="capacidad" id="capacidad" class="form__input" value="<?php echo htmlspecialchars($Row['capacidad'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="TRASMISION" class="form__label">TRANSMISIÓN</label>
                <input type="text" name="TRASMISION" id="TRASMISION" class="form__input" value="<?php echo htmlspecialchars($Row['TRASMISION'] ?? ''); ?>" required>
            </div>

            <div class="form__group">
                <label for="ORIGEN" class="form__label">ORIGEN</label>
                <input type="text" name="ORIGEN" id="ORIGEN" class="form__input" value="<?php echo htmlspecialchars($Row['ORIGEN'] ?? ''); ?>" required>
            </div>

            <button type="submit" class="form__button">Actualizar Vehículo</button>
        </form>
    </div>
</body>
</html>