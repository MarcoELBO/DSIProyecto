<?php
$IdOficial = $_REQUEST['IdOficial'];
$Nombre = $_REQUEST['Nombre'];
$Cargo = $_REQUEST['Cargo'];

/*
print("ID_Oficial = " .$IdOficial. "<br>");
print("Nombre = " .$Nombre. "<br>");
print("Cargo = ".$Cargo."<br>");
*/

$SQL = "INSERT INTO Oficiales VALUES('$IdOficial','$Nombre','$Cargo')";

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