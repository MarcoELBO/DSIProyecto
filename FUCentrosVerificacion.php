<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Centros de Verificacion</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['NO_CENTRO'])) {
            echo "Falta el NO_CENTRO";
            exit;
        }

        $NO_CENTRO = $_GET['NO_CENTRO'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Centros_Verificacion WHERE NO_CENTRO = '$NO_CENTRO'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UCentrosVerificacion.php">
        <label><strong>Editar Centros de Verificacion</strong></label>
        <br><br>

        <label>NO_CENTRO</label>
        <br>
        <input type="number" name="NO_CENTRO" id="NO_CENTRO" value="<?php echo $Row['NO_CENTRO']; ?>" readonly>
        <br>

        <label>NO_LINEA</label>
        <br>
        <input type="text" name="NO_LINEA" id="NO_LINEA" value="<?php echo $Row['NO_LINEA']; ?>" required>
        <br>

        <label>VERIFICACION</label>
        <br>
        <input type="text" name="VERIFICACION" id="VERIFICACION" value="<?php echo $Row['VERIFICACION']; ?>" required>
        <br>

        <label>NOMBRE</label>
        <br>
        <input type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $Row['NOMBRE']; ?>" required>
        <br>
        <label>DOMICILIO</label>
        <br>
        <input type="text" name="DOMICILIO" id="DOMICILIO" value="<?php echo $Row['DOMICILIO']; ?>" required>
        <br>
        <label>TIPO_CENTRO</label>
        <br>
        <input type="text" name="TIPO_CENTRO" id="TIPO_CENTRO" value="<?php echo $Row['TIPO_CENTRO']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Centro de Verificacion">
        <br>
    </form>
</body>
</html>