<html>
<form action="UOficiales.php">
    <h4>Editar Oficiales</h4>
    <label>Id Oficiales</label>
    <input type="number" name="ID_Oficial" value="">
    <?php
    include("Controlador.php");
    $Con = Conectar();
    $ResultSet = Ejecutar($Con, "SELECT * FROM Oficiales WHERE ID_Oficial = '$ID_Oficial';");
    $Exit = Desconectar($Con)
        ?>
    <br>
    <label>Nombre</label>
    <input type="text" name="Nombre" value="">
    <br>
    <label>Cargo</label>
    <input type="text" name="Cargo" value="">
    <br>
    <input type="submit" value="Editar">
</form>

</html>