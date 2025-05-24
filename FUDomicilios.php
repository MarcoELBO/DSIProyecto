<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Domicilio</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_DOMICILIO'])) {
            echo "Falta el Id_Domicilio";
            exit;
        }

        $ID_DOMICILIO = $_GET['ID_DOMICILIO'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Domicilios WHERE ID_DOMICILIO = '$ID_DOMICILIO'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UDomicilios.php">
        <label><strong>Editar Domicilio</strong></label>
        <br><br>

        <label>Id_Domicilio</label>
        <br>
        <input type="number" name="ID_Domicilio" id="ID_Domicilio" value="<?php echo $Row['ID_DOMICILIO']; ?>" readonly>
        <br>

        <label>Calle</label>
        <br>
        <input type="text" name="CALLE" id="CALLE" value="<?php echo $Row['CALLE']; ?>" required>
        <br>

        <label>CP</label>
        <br>
        <input type="text" name="CP" id="CP" value="<?php echo $Row['CP']; ?>" required>
        <br>

        <label>Colonia</label>
        <br>
        <input type="text" name="COLONIA" id="COLONIA" value="<?php echo $Row['COLONIA']; ?>" required>
        <br>

        <label>Número Interior</label>
        <br>
        <input type="text" name="NUM_INT" id="NUM_INT" value="<?php echo $Row['NUM_INT']; ?>">
        <br>

        <label>Número Exterior</label>
        <br>
        <input type="text" name="NUM_EXT" id="NUM_EXT" value="<?php echo $Row['NUM_EXT']; ?>">
        <br>

        <label>Estado</label>
        <br>
        <input type="text" name="ESTADO" id="ESTADO" value="<?php echo $Row['ESTADO']; ?>" required>
        <br>

        <label>Municipio</label>
        <br>
        <input type="text" name="MUNICIPIO" id="MUNICIPIO" value="<?php echo $Row['MUNICIPIO']; ?>" required>
        <br>

        <label>Referencias</label>
        <br>
        <textarea name="REFERENCIAS" id="REFERENCIAS"><?php echo $Row['REFERENCIAS']; ?></textarea>
        <br>

        <input type="submit" value="Actualizar Domicilio">
        <br>
    </form>
</body>
</html>
