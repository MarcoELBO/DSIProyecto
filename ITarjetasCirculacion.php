<?php
$ID_TC = $_REQUEST['ID_TC'];
$Vehiculo = $_REQUEST['Vehiculo'];
$Propietario = $_REQUEST['Propietario'];
$Tipo_Servicio = $_REQUEST['Tipo_Servicio'];
$Domicilio = $_REQUEST['Domicilio'];

/*
print ("ID Tarjeta de Circulacion = " . $ID_TC . "<br>");
print ("Vehiculo = " . $Vehiculo . "<br>");
print ("Propietario = " . $Propietario . "<br>");
print ("Tipo de servicio = " . $Tipo_Servicio . "<br>");
print ("Domicilio = " . $Domicilio . "<br>");
*/

$SQL = "INSERT INTO tarjetas_circulacion (ID_TC, Vehiculo, Propietario, Tipo_Servicio, Domicilio) VALUES ('$ID_TC', '$Vehiculo', '$Propietario', '$Tipo_Servicio', '$Domicilio')";

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