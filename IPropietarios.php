<?php
$RFC = $_POST['RFC'];
$Nombre = $_POST['Nombre'];
$Fecha_nacimiento = $_POST['Fecha_nacimiento'];

$SQL = "INSERT INTO propietarios VALUES (NULL, '$RFC', '$Nombre', '$Fecha_nacimiento')";

include("controlador.php");

$Conexion = conectar();

$ResultSet = ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>