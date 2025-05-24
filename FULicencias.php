<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Licencias</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_LICENCIA'])) {
            echo "Falta el ID_LICENCIA";
            exit;
        }

        $ID_LICENCIA = $_GET['ID_LICENCIA'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Licencias WHERE ID_LICENCIA = '$ID_LICENCIA'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="ULicencias.php">
        <label><strong>Editar Licencias</strong></label>
        <br><br>

        <label>ID_LICENCIA</label>
        <br>
        <input type="number" name="ID_LICENCIA" id="ID_LICENCIA" value="<?php echo $Row['ID_LICENCIA']; ?>" readonly>
        <br>

        <label>CONDUCTOR</label>
        <br>
        <input type="text" name="CONDUCTOR" id="CONDUCTOR" value="<?php echo $Row['CONDUCTOR']; ?>" required>
        <br>

        <label>FECHA_EXPEDICION</label>
        <br>
        <input type="date" name="FECHA_EXPEDICION" id="FECHA_EXPEDICION" value="<?php echo $Row['FECHA_EXPEDICION']; ?>" required>
        <br>

        <label>FECHA_VALIDACION</label>
        <br>
        <input type="date" name="FECHA_VALIDACION" id="FECHA_VALIDACION" value="<?php echo $Row['FECHA_VALIDACION']; ?>" required>
        <br>
        <label>ANTIGUEDAD</label>
        <br>
        <input type="text" name="ANTIGUEDAD" id="ANTIGUEDAD" value="<?php echo $Row['ANTIGUEDAD']; ?>" required>
        <br>
        <label>OBSERVACIONES</label>
        <br>
        <input type="text" name="OBSERVACIONES" id="OBSERVACIONES" value="<?php echo $Row['OBSERVACIONES']; ?>" required>
        <br>
        <label>FIRMA</label>
        <br>
        <input type="text" name="FIRMA" id="FIRMA" value="<?php echo $Row['FIRMA']; ?>" required>
        <br>
        <label>DOMICILIO</label>
        <br>
        <input type="text" name="DOMICILIO" id="DOMICILIO" value="<?php echo $Row['DOMICILIO']; ?>" required>
        <br>
        <label>FUNDAMENTO_LEGAL</label>
        <br>
        <input type="text" name="FUNDAMENTO_LEGAL" id="FUNDAMENTO_LEGAL" value="<?php echo $Row['FUNDAMENTO_LEGAL']; ?>" required>
        <br>
        <label>FOTO</label>
        <br>
        <input type="text" name="FOTO" id="FOTO" value="<?php echo $Row['FOTO']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Licencia">
        <br>
    </form>
</body>
</html>
