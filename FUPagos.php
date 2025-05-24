<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pagos</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Pago'])) {
            echo "Falta el ID_Pago";
            exit;
        }

        $ID_Pago = $_GET['ID_Pago'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Pagos WHERE ID_Pago = '$ID_Pago'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UPagos.php">
        <label><strong>Editar Pagos</strong></label>
        <br><br>

        <label>ID_Pago</label>
        <br>
        <input type="number" name="ID_Pago" id="ID_Pago" value="<?php echo $Row['ID_Pago']; ?>" readonly>
        <br>

        <label>Servicio</label>
        <br>
        <input type="text" name="Servicio" id="Servicio" value="<?php echo $Row['Servicio']; ?>" required>
        <br>

        <label>Monto</label>
        <br>
        <input type="number" name="Monto" id="Monto" value="<?php echo $Row['Monto']; ?>" required>
        <br>

        <label>Fecha</label>
        <br>
        <input type="date" name="Fecha" id="Fecha" value="<?php echo $Row['Fecha']; ?>" required>
        <br>

        <label>Hora</label>
        <br>
        <input type="time" name="Hora" id="Hora" value="<?php echo $Row['Hora']; ?>" required>
        <br>
        <label>Tarjeta Asociada</label>
        <br>
        <input type="text" name="Tarjeta_Asociada" id="Tarjeta_Asociada" value="<?php echo $Row['Tarjeta_Asociada']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Pago">
        <br>
    </form>
    </body>
</html>