<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propietarios</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['ID_Propietario'])) {
            echo "Falta el IdPropietario.";
            exit;
        }

        $ID_Propietario = $_GET['ID_Propietario'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Propietarios WHERE ID_Propietario = '$ID_Propietario'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UPropietarios.php">
    <label>Editar Propietarios</label>
    <br>
    <label>IdPropietario</label>
    <br>
    <input type="number" name="ID_Propietario" id="ID_Propietario" value="<?php echo $Row['ID_Propietario']; ?>" readonly>
    <br>
    <label>RFC</label>
    <input type="text" name="RFC" value="<?php echo $Row['RFC']; ?>">
    <br>
    <label>Nombre</label>
    <input type="text" name="Nombre" value="<?php echo $Row['Nombre']; ?>">
    <br>
    <label>Fecha de nacimiento</label>
    <input type="date" name="Fecha_nacimiento" value="<?php echo $Row['Fecha_nacimiento']; ?>">
    <br>
    <input type="submit" value="Editar">
    <br>
</form>

</html>