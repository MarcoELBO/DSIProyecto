<?php
$ID_Pago = $_POST['ID_Pago'];
$Servicio = $_POST['Servicio'];
$Monto = $_POST['Monto'];
$Fecha = $_POST['Fecha'];
$Hora = $_POST['Hora'];
$Tarjeta_Asociada = $_POST['Tarjeta_Asociada'];

/*
print ("ID_Pago = " . $ID_Pago . "<br>");
print ("Servicio = " . $Servicio . "<br>");
print ("Monto = " . $Monto . "<br>");
print ("Fecha = " . $Fecha . "<br>");
print ("Hora = " . $Hora . "<br>");
print ("Tarjeta asociada = " . $Tarjeta_Asociada . "<br>");
*/

$SQL = "INSERT INTO Pagos (ID_Pago, Servicio, Monto, Fecha, Hora, Tarjeta_Asociada) VALUES ('$ID_Pago', '$Servicio', '$Monto', '$Fecha', '$Hora', '$Tarjeta_Asociada')";

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