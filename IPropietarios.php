<?php
$ID_Propietario = $_GET['ID_Propietario'];
$RFC = $_GET['RFC'];
$Nombre = $_GET['Nombre'];
$Fecha_nacimiento = $_GET['Fecha_nacimiento'];

/*
print ("ID Propietario = " . $ID_Propietario . "<br>");
print ("RFC = " . $RFC . "<br>");
print ("Nombre = " . $Nombre . "<br>");
print ("Fecha de nacimiento = " . $Fecha_nacimiento . "<br>");
*/

$SQL = "INSERT INTO propietarios VALUES ('$ID_Propietario', '$RFC', '$Nombre', '$Fecha_nacimiento')";

include("Controlador.php");

$Conexion = Conectar();

$ResultSet = Ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>