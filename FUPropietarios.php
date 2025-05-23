<html>
<form action="UPropietarios.php">
    <h3>Editar Propietario</h3>
    <br>
    <label>Id Propietario</label>
    <input type="number" name="ID_Propietario" id="ID_Propietario">
    <?php
    include("Controlador.php");
    $conexion = conectar();
    $ID_Propietario = $_REQUEST["ID_Propietario"];
    $ResultSet = ejecutar($conexion, "SELECT * FROM Propietarios WHERE ID_Propietario = '$ID_Propietario';");
    $row = mysqli_fetch_row($ResultSet);
    $Cerrar = desconectar($conexion);
    ?>
    <br>
    <label>RFC</label>
    <input type="text" name="RFC" value="<?php print ($row[1]); ?>">
    <br>
    <label>Nombre</label>
    <input type="text" name="Nombre" value="<?php print ($row[1]); ?>">
    <br>
    <label>Fecha de nacimiento</label>
    <input type="date" name="Fecha_nacimiento" value="<?php print ($row[1]); ?>">
    <br>
    <input type="submit" value="Editar">
    <br>
</form>

</html>