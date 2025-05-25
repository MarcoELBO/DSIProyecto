<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehiculos</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['Placa'])) {
            echo "Falta numero de Placa";
            exit;
        }

        $Placa = $_GET['Placa'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Vehiculos WHERE Placa = '$Placa'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UVehiculos.php">
        <label><strong>Editar Vehiculos</strong></label>
        <br><br>

        <label>Placa</label>
        <br>
        <input type="text" name="Placa" id="Placa" value="<?php echo $Row['Placa']; ?>" readonly>
        <br>

        <label>Marca</label>
        <br>
        <input type="text" name="Marca" id="Marca" value="<?php echo $Row['Marca']; ?>" required>
        <br>

        <label>SUBMARCA</label>
        <br>
        <input type="text" name="SUBMARCA" id="SUBMARCA" value="<?php echo $Row['SUBMARCA']; ?>" required>
        <br>

        <label>LINEA</label>
        <br>
        <input type="text" name="LINEA" id="LINEA" value="<?php echo $Row['LINEA']; ?>" required>
        <br>
        <label>Color</label>
        <br>
        <input type="text" name="Color" id="Color" value="<?php echo $Row['Color']; ?>" required>
        <br>
        <label>Modelo</label>
        <br>
        <input type="text" name="Modelo" id="Modelo" value="<?php echo $Row['Modelo']; ?>" required>
        <br>
        <label>Numero_Serie</label>
        <br>
        <input type="text" name="Numero_Serie" id="Numero_Serie" value="<?php echo $Row['Numero_Serie']; ?>" required>
        <br>
        <label>Puertas</label>
        <br>
        <input type="text" name="Puertas" id="Puertas" value="<?php echo $Row['Puertas']; ?>" required>
        <br>
        <label>Asientos</label>
        <br>
        <input type="text" name="Asientos" id="Asientos" value="<?php echo $Row['Asientos']; ?>" required>
        <br>
        <label>Cilindraje</label>
        <br>
        <input type="text" name="Cilindraje" id="Cilindraje" value="<?php echo $Row['Cilindraje']; ?>" required>
        <br>
        <label>Combustible</label>
        <br>
        <input type="text" name="Combustible" id="Combustible" value="<?php echo $Row['Combustible']; ?>" required>
        <br>
        <label>Capacidad</label>
        <br>
        <input type="text" name="capacidad" id="capacidad" value="<?php echo $Row['capacidad']; ?>" required>
        <br>
        <label>TRASMISION</label>
        <br>
        <input type="text" name="TRASMISION" id="TRASMISION" value="<?php echo $Row['TRASMISION']; ?>" required>
        <br>
        <label>ORIGEN</label>
        <br>
        <input type="text" name="ORIGEN" id="ORIGEN" value="<?php echo $Row['ORIGEN']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Vehiculo">
        <br>
    </form>
</body>
</html>
