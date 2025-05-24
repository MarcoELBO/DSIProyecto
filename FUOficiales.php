<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oficiales</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Oficial'])) {
            echo "Falta el IdOficial";
            exit;
        }

        $ID_Oficial = $_GET['ID_Oficial'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Oficiales WHERE ID_Oficial = '$ID_Oficial'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>

    <form method="get" action="UOficiales.php">
        <label><strong>Editar Oficiales</strong></label>
        <br><br>

        <label>IdOficial</label>
        <br>
        <input type="number" name="ID_Oficial" id="ID_Oficial" value="<?php echo $Row['ID_Oficial']; ?>" readonly>
        <br>

        <label>Nombre</label>
        <br>
        <input type="text" name="Nombre" id="NombreO" value="<?php echo $Row['NombreO']; ?>" required>
        <br>

        <label>Cargo</label>
        <br>
        <input type="text" name="Cargo" id="Cargo" value="<?php echo $Row['Cargo']; ?>" required>
        <br>

        <input type="submit" value="Actualizar Oficial">
        <br>
    </form>
</body>

</html>