<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conductores</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['CURP'])) {
            echo "Falta el CURP";
            exit;
        }

        $CURP = $_GET['CURP'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Conductores WHERE CURP = '$CURP'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UConductores.php">
        <label><strong>Editar Conductores</strong></label>
        <br><br>

        <label>CURP</label>
        <br>
        <input type="text" name="CURP" id="CURP" value="<?php echo $Row['CURP']; ?>" readonly>
        <br>

        <label>Nombre</label>
        <br>
        <input type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $Row['NOMBRE']; ?>" required>
        <br>

        <label>Domicilio</label>
        <br>
        <input type="text" name="DOMICILIO" id="DOMICILIO" value="<?php echo $Row['DOMICILIO']; ?>" required>
        <br>

        <label>Folio Tarjeta de Circulacion</label>
        <br>
        <input type="text" name="FOLIO_TC" id="FOLIO_TC" value="<?php echo $Row['FOLIO_TC']; ?>" required>
        <br>
        <label>No Licencia</label>
        <br>
        <input type="text" name="NO_LICENCIA" id="NO_LICENCIA" value="<?php echo $Row['NO_LICENCIA']; ?>" required>
        <br>
        <label>Fecha Nacimiento</label>
        <br>
        <input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" value="<?php echo $Row['FECHA_NACIMIENTO']; ?>" required>
        <br>
        <label>Tipo Sangre</label>
        <br>
        <input type="text" name="TIPO_SANGRE" id="TIPO_SANGRE" value="<?php echo $Row['TIPO_SANGRE']; ?>" required>
        <br>
        <label>Donador Organo</label>
        <br>
        <input type="text" name="DONADOR_ORG" id="DONADOR_ORG" value="<?php echo $Row['DONADOR_ORG']; ?>" required>
        <br>
        <label>Numero Emergencia</label>
        <br>
        <input type="text" name="NUMERO_EMERGENCIA" id="NUMERO_EMERGENCIA" value="<?php echo $Row['NUMERO_EMERGENCIA']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Conductor">
        <br>
    </form>
</body>
</html>