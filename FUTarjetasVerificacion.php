<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarjetas de Verificacion</title>
</head>

<body>
    <?php
        include("Controlador.php");

        if (!isset($_GET['FOLIO_VERIFICACION'])) {
            echo "Falta el Folio de Verificacion";
            exit;
        }

        $FOLIO_VERIFICACION = $_GET['FOLIO_VERIFICACION'];
        $Conexion = Conectar();
        $ResultSet = Ejecutar($Conexion, "SELECT * FROM Tarjetas_Verificacion WHERE FOLIO_VERIFICACION = '$FOLIO_VERIFICACION'");
        $Row = mysqli_fetch_assoc($ResultSet);
        Desconectar($Conexion);
    ?>
    <form method="get" action="UTarjetasVerificacion.php">
        <label><strong>Editar Tarjetas de Verificacion</strong></label>
        <br><br>

        <label>Folio de Verificacion</label>
        <br>
        <input type="text" name="FOLIO_VERIFICACION" id="FOLIO_VERIFICACION" value="<?php echo $Row['FOLIO_VERIFICACION']; ?>" readonly>
        <br>

        <label>Vehiculo</label>
        <br>
        <input type="text" name="VEHICULO" id="VEHICULO" value="<?php echo $Row['VEHICULO']; ?>" required>
        <br>

        <label>Domicilio</label>
        <br>
        <input type="text" name="DOMICILIO" id="DOMICILIO" value="<?php echo $Row['DOMICILIO']; ?>" required>
        <br>

        <label>Tarjeta de Circulacion</label>
        <br>
        <input type="text" name="TC" id="TC" value="<?php echo $Row['TC']; ?>" required>
        <br>
        <label>Centro de Verificacion</label>
        <br>
        <input type="text" name="CENTRO_VERIFICACION" id="CENTRO_VERIFICACION" value="<?php echo $Row['CENTRO_VERIFICACION']; ?>" required>
        <br>
        <label>Tecnico de Verificacion</label>
        <br>
        <input type="text" name="TECNICO_VERIFICACION" id="TECNICO_VERIFICACION" value="<?php echo $Row['TECNICO_VERIFICACION']; ?>" required>
        <br>
        <label>Fecha de Expedicion</label>
        <br>
        <input type="date" name="FECHA_EXPEDICION" id="FECHA_EXPEDICION" value="<?php echo $Row['FECHA_EXPEDICION']; ?>" required>
        <br>
        <label>Hora de Entrada</label>
        <br>
        <input type="time" name="HORA_ENTRADA" id="HORA_ENTRADA" value="<?php echo $Row['HORA_ENTRADA']; ?>" required>
        <br>
        <label>Hora de Salida</label>
        <br>
        <input type="time" name="HORA_SALIDA" id="HORA_SALIDA" value="<?php echo $Row['HORA_SALIDA']; ?>" required>
        <br>
        <label>Motivo de Verificacion</label>
        <br>
        <input type="text" name="MOTIVO_VERIFICACION" id="MOTIVO_VERIFICACION" value="<?php echo $Row['MOTIVO_VERIFICACION']; ?>" required>
        <br>
        <label>Semestre</label>
        <br>
        <input type="text" name="SEMESTRE" id="SEMESTRE" value="<?php echo $Row['SEMESTRE']; ?>" required>
        <br>
        <label>Folio Previo</label>
        <br>
        <input type="text" name="FOLIO_PREVIO" id="FOLIO_PREVIO" value="<?php echo $Row['FOLIO_PREVIO']; ?>" required>
        <br>
        <label>Vigencia</label>
        <br>
        <input type="text" name="VIGENCIA" id="VIGENCIA" value="<?php echo $Row['VIGENCIA']; ?>" required>
        <br>
        <input type="submit" value="Actualizar Tarjeta de Verificacion">
        <br>
    </form>
</body>
</html>