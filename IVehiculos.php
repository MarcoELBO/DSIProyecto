<?php
$Placa = $_REQUEST['Placa'];
$Marca = $_REQUEST['Marca'];
$SUBMARCA = $_REQUEST['SUBMARCA'];
$LINEA= $_REQUEST['LINEA'];
$Color = $_REQUEST['Color'];
$Modelo = $_REQUEST['Modelo'];
$Numero_Serie = $_REQUEST['Numero_Serie'];
$Puertas = $_REQUEST['Puertas'];
$Asientos = $_REQUEST['Asientos'];
$Cilindraje = $_REQUEST['Cilindraje'];
$Combustible = $_REQUEST['Combustible'];
$capacidad = $_REQUEST['capacidad'];
$TRASMISION = $_REQUEST['TRASMISION'];
$ORIGEN = $_REQUEST['ORIGEN'];

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

$SQL = "INSERT INTO vehiculos VALUES ('$Placa', '$Marca', '$SUBMARCA', '$LINEA', '$Color', '$Modelo', '$Numero_Serie', '$Puertas', '$Asientos', '$Cilindraje', '$Combustible', '$capacidad', '$TRASMISION', '$ORIGEN');";

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