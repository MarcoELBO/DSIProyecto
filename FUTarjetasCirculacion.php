<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarjetas de Circulacion</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_TC'])) {
            echo "Falta el ID_TC";
            exit;
        }

        $ID_TC = $_GET['ID_TC'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Tarjetas_Circulacion WHERE ID_TC = '$ID_TC'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UTarjetasCirculacion.php">
        <label><strong>Editar Tarjetas de Circulacion</strong></label>
        <br><br>

        <label>ID_TC</label>
        <br>
        <input type="number" name="ID_TC" id="ID_TC" value="<?php echo $Row['ID_TC']; ?>" readonly>
        <br>

        <label>Vehiculo</label>
        <br>
        <input type="text" name="Vehiculo" id="Vehiculo" value="<?php echo $Row['Vehiculo']; ?>" required>
        <br>

        <label>Propietario</label>
        <br>
        <input type="text" name="Propietario" id="Propietario" value="<?php echo $Row['Propietario']; ?>" required>
        <br>

        <label>Tipo_Servicio</label>
        <br>
        <input type="text" name="Tipo_Servicio" id="Tipo_Servicio" value="<?php echo $Row['Tipo_Servicio']; ?>" required>
        <br>

        <label>Domicilio</label>
        <br>
        <input type="text" name="Domicilio" id="Domicilio" value="<?php echo $Row['Domicilio']; ?>" required>
        <br>
        <label>VIGENCIA</label>
        <br>
        <input type="text" name="VIGENCIA" id="VIGENCIA" value="<?php echo $Row['VIGENCIA']; ?>" required>
        <br>
        <label>Fecha_expedicion</label>
        <br>
        <input type="date" name="Fecha_expedicion" id="Fecha_expedicion" value="<?php echo $Row['Fecha_expedicion']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Tarjeta de Circulacion">
        <br>
    </form>
</body>
</html>