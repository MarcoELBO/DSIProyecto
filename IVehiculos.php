<?php
$Placa = $_REQUEST['Placa'];
$Marca = $_REQUEST['Marca'];
$Color = $_REQUEST['Color'];
$Modelo = $_REQUEST['Modelo'];
$Puertas = $_REQUEST['Puertas'];
$Asientos = $_REQUEST['Asientos'];
$Cilindraje = $_REQUEST['Cilindraje'];
$Combustible = $_REQUEST['Combustible'];

/*
print ("Placa = " . $Placa . "<br>");
print ("Marca = " . $Marca . "<br>");
print ("Color = " . $Color . "<br>");
print ("Modelo = " . $Modelo . "<br>");
print ("Puertas = " . $Puertas . "<br>");
print ("Asientos = " . $Asientos . "<br>");
print ("Cilindraje = " . $Cilindraje . "<br>");
print ("Combustible = " . $Combustible . "<br>");
*/

$SQL = "INSERT INTO vehiculos VALUES ('$Placa', '$Marca', '$Color', '$Modelo', '$Puertas', '$Asientos', '$Cilindraje', '$Combustible')";

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